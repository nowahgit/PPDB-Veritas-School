<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Seleksi;
use App\Models\PeriodeSeleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class SeleksiController extends Controller
{
    public function exportPdf()
    {
        $periodeAktif = PeriodeSeleksi::aktif()->first();

        if (!$periodeAktif) {
            return back()->with('error', 'Tidak ada periode aktif yang ditemukan.');
        }

        $pendaftar = User::with([
            'prestasis',
            'seleksi' => function ($q) use ($periodeAktif) {
                $q->where('periode_id', $periodeAktif->id);
            }
        ])
            ->where('role', 'PENDAFTAR')
            ->where('periode_id', $periodeAktif->id)
            ->get()
            ->map(function (User $user) {
                $user->avg = $user->getAverageScore();
                $user->poin_prestasi = $this->hitungPoinPrestasi($user->prestasis);
                $user->nilai_total = optional($user->seleksi)->nilai_total ?? ($user->avg + $user->poin_prestasi);
                $user->status_seleksi = optional($user->seleksi)->status ?? 'Belum Diseleksi';
                return $user;
            });

        if ($pendaftar->isEmpty()) {
            return back()->with('error', 'Tidak ada data pendaftar untuk diekspor.');
        }

        $nomor_surat = "PPDB/" . date('Y') . "/" . str_pad($periodeAktif->id, 3, '0', STR_PAD_LEFT);

        $pdf = Pdf::loadView('admin.seleksi_pdf', [
            'pendaftar' => $pendaftar,
            'periodeAktif' => $periodeAktif,
            'nomor_surat' => $nomor_surat
        ]);

        return $pdf->stream('Hasil_Seleksi_' . str_replace(' ', '_', $periodeAktif->nama_periode) . '.pdf');
    }

    /**
     * =========================
     * HALAMAN SELEKSI ADMIN
     * =========================
     */
    public function index(Request $request)
    {
        $periodeAktif = PeriodeSeleksi::aktif()->first();

        if (!$periodeAktif) {
            return view('admin.dashboard', [
                'periodeAktif' => null,
                'pendaftar' => collect(),
                'totalPendaftar' => 0,
                'lulus' => 0,
                'tidakLulus' => 0,
                'belumDiproses' => 0,
                'admins' => collect(),
                'totalAdmins' => 0,
                'periodes' => collect(),
            ]);
        }

        $pendaftar = User::with([
            'prestasis',
            'seleksi' => function ($q) use ($periodeAktif) {
                $q->where('periode_id', $periodeAktif->id);
            }
        ])
            ->where('role', 'PENDAFTAR')
            ->where('periode_id', $periodeAktif->id)
            ->get()
            ->map(function ($user) {
                $user->status_seleksi_view = optional($user->seleksi)->status ?? 'Belum Diseleksi';
                return $user;
            });

        $totalPendaftar = $pendaftar->count();

        $lulus = $pendaftar->where('status_seleksi_view', 'Lulus')->count();
        $tidakLulus = $pendaftar->where('status_seleksi_view', 'Tidak Lulus')->count();
        $belumDiproses = $pendaftar->where('status_seleksi_view', 'Belum Diseleksi')->count();

        $admins = User::where('role', 'ADMIN')->get();
        $totalAdmins = $admins->count();
        $periodes = PeriodeSeleksi::orderByDesc('tanggal_mulai')->get();

        return view('admin.dashboard', compact(
            'periodeAktif',
            'pendaftar',
            'totalPendaftar',
            'lulus',
            'tidakLulus',
            'belumDiproses',
            'admins',
            'totalAdmins',
            'periodes'
        ));
    }

    /**
     * =========================
     * SELEKSI OTOMATIS
     * =========================
     */
    public function prosesSeleksiOtomatis(Request $request)
    {
        $request->validate([
            'periode_id' => 'required|exists:periode_seleksi,id'
        ]);

        $periode = PeriodeSeleksi::findOrFail($request->periode_id);

        if (!$periode->isAktif()) {
            return back()->with('error', 'Periode seleksi tidak aktif.');
        }

        $batasLulus = $request->input('batas_lulus', $periode->batas_lulus);
        $kuota = $request->input('kuota', $periode->kuota);

        // Ambil semua pendaftar di periode ini (termasuk yang periode_id NULL untuk backward compatibility)
        $allPendaftar = User::with('prestasis')
            ->where('role', 'PENDAFTAR')
            ->where(function ($query) use ($periode) {
                $query->where('periode_id', $periode->id)
                    ->orWhereNull('periode_id');
            })
            ->get();

        // Filter yang punya nilai lengkap (bisa 0, tapi tidak boleh null)
        $pendaftar = $allPendaftar->filter(function ($user) {
            return $user->nilai_smt1 !== null
                && $user->nilai_smt2 !== null
                && $user->nilai_smt3 !== null
                && $user->nilai_smt4 !== null
                && $user->nilai_smt5 !== null;
        })
            ->map(function ($user) {
                $avg = round(
                    ($user->nilai_smt1 + $user->nilai_smt2 + $user->nilai_smt3 +
                        $user->nilai_smt4 + $user->nilai_smt5) / 5,
                    2
                );

                $poin = $this->hitungPoinPrestasi($user->prestasis);
                $user->nilai_total = $avg + $poin;

                return $user;
            })
            ->sortByDesc('nilai_total')
            ->values();

        // Debug info
        $totalDiperiode = $allPendaftar->count();
        $totalDenganNilai = $pendaftar->count();

        $lulusCount = 0;

        DB::transaction(function () use ($pendaftar, $periode, $batasLulus, $kuota, &$lulusCount) {
            foreach ($pendaftar as $user) {
                if ($lulusCount < $kuota && $user->nilai_total >= $batasLulus) {
                    $status = 'Lulus';
                    $catatan = 'Lulus seleksi otomatis';
                    $lulusCount++;
                } else {
                    $status = 'Tidak Lulus';
                    $catatan = 'Tidak memenuhi kriteria / kuota penuh';
                }

                Seleksi::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'periode_id' => $periode->id,
                    ],
                    [
                        'nilai_total' => $user->nilai_total,
                        'status' => $status,
                        'catatan' => $catatan,
                        'updated_by' => Auth::id(),
                    ]
                );

                // Reload user model untuk update status_seleksi
                User::where('id', $user->id)->update([
                    'status_seleksi' => $status
                ]);
            }
        });

        if ($totalDiperiode == 0) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tidak ada pendaftar di periode ini.');
        }

        if ($totalDenganNilai == 0) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', "Dari {$totalDiperiode} pendaftar, tidak ada yang memiliki nilai lengkap (semester 1-5).");
        }

        $message = "Seleksi selesai! {$lulusCount} dari {$totalDenganNilai} siswa lulus. ";
        $message .= "Kriteria: Nilai ≥ {$batasLulus}, Kuota {$kuota}. ";
        $message .= "({$totalDiperiode} total pendaftar di periode ini)";

        return redirect()
            ->route('admin.dashboard')
            ->with('success', $message);
    }

    /**
     * =========================
     * UPDATE STATUS MANUAL
     * =========================
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Lulus,Tidak Lulus,Dipertimbangkan',
            'catatan' => 'nullable|string|max:500',
            'periode_id' => 'required|exists:periode_seleksi,id',
        ]);

        $user = User::with('prestasis')->findOrFail($id);

        $avg = round(
            ($user->nilai_smt1 + $user->nilai_smt2 + $user->nilai_smt3 +
                $user->nilai_smt4 + $user->nilai_smt5) / 5,
            2
        );

        $nilaiTotal = $avg + $this->hitungPoinPrestasi($user->prestasis);

        Seleksi::updateOrCreate(
            [
                'user_id' => $user->id,
                'periode_id' => $request->periode_id
            ],
            [
                'nilai_total' => $nilaiTotal,
                'status' => $request->status,
                'catatan' => $request->catatan,
                'updated_by' => Auth::id(),
            ]
        );

        $user->refresh();        // ⬅️ penting
        $user->load('seleksi'); // ⬅️ penting


        return back()->with('success', 'Status seleksi berhasil diperbarui.');
    }

    /**
     * =========================
     * HITUNG POIN PRESTASI
     * =========================
     */
    private function hitungPoinPrestasi($prestasis)
    {
        return $prestasis->sum(function ($prestasi) {
            return match (strtolower($prestasi->tingkat)) {
                'internasional' => 10,
                'nasional' => 7,
                'provinsi' => 5,
                'kota', 'kabupaten' => 3,
                'sekolah' => 1,
                default => 0,
            };
        });
    }

    /**
     * =========================
     * RESET SELEKSI
     * =========================
     */
    public function resetSeleksi(Request $request)
    {
        $request->validate([
            'periode_id' => 'required|exists:periode_seleksi,id'
        ]);

        DB::transaction(function () use ($request) {
            Seleksi::where('periode_id', $request->periode_id)->delete();

            User::where('role', 'PENDAFTAR')
                ->where('periode_id', $request->periode_id)
                ->update(['status_seleksi' => 'Belum Diseleksi']);
        });

        return back()->with('success', 'Hasil seleksi berhasil direset.');
    }
}
