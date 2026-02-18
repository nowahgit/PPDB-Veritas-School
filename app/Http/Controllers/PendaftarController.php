<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Berkas;
use App\Models\Prestasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\Storage;


class PendaftarController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load(['seleksi', 'periode']);
        $berkas = Berkas::where('user_id', $user->id)->first();
        $prestasis = Prestasi::where('user_id', $user->id)->get();

        return view('pendaftar.dashboard', compact('user', 'berkas', 'prestasis'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Cek apakah identitas sudah dikunci
        if ($user->identitas_locked) {
            return redirect()->back()->with('error', 'Data identitas sudah terkunci dan tidak dapat diubah. Jika ada kesalahan, silakan hubungi operator.');
        }

        $request->validate([
            'nisn_pendaftar' => 'required|string|max:20',
            'nama_pendaftar' => 'required|string|max:50',
            'tanggallahir_pendaftar' => 'required|date',
            'alamat_pendaftar' => 'required|string',
            'agama' => 'required|string|max:20',
            'nama_ortu' => 'required|string|max:50',
            'pekerjaan_ortu' => 'required|string|max:50',
            'no_hp_ortu' => 'required|string|max:15',
            'alamat_ortu' => 'required|string',
            'nilai_smt1' => 'required|numeric',
            'nilai_smt2' => 'required|numeric',
            'nilai_smt3' => 'required|numeric',
            'nilai_smt4' => 'required|numeric',
            'nilai_smt5' => 'required|numeric',
        ]);

        $user->update($request->only([
            'nisn_pendaftar',
            'nama_pendaftar',
            'tanggallahir_pendaftar',
            'alamat_pendaftar',
            'agama',
            'nama_ortu',
            'pekerjaan_ortu',
            'no_hp_ortu',
            'alamat_ortu',
            'nilai_smt1',
            'nilai_smt2',
            'nilai_smt3',
            'nilai_smt4',
            'nilai_smt5',
        ]));

        // Kunci identitas setelah submit pertama kali
        $user->identitas_locked = true;
        $user->identitas_submitted_at = now();
        $user->save();

        return redirect()->route('pendaftar.dashboard')->with('success', 'Data pendaftar berhasil diperbarui.');
    }

    public function uploadBerkas(Request $request)
    {

        $request->validate([
            'ijazah_skhun' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'akta_kelahiran' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pas_foto' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        // Cek apakah berkas sudah dikunci
        if ($user->berkas_locked) {
            return redirect()->back()->with('error', 'Berkas sudah terkunci dan tidak dapat diubah. Jika ada kesalahan, silakan hubungi operator.');
        }


        $berkas = Berkas::updateOrCreate(
            ['user_id' => $user->id],
            [
                'ijazah_skhun' => $request->file('ijazah_skhun')->store('berkas', 'public'),
                'akta_kelahiran' => $request->file('akta_kelahiran')->store('berkas', 'public'),
                'kk' => $request->file('kk')->store('berkas', 'public'),
                'pas_foto' => $request->file('pas_foto')->store('berkas', 'public'),
            ]
        );

        // Kunci berkas setelah upload
        $user->berkas_locked = true;
        $user->berkas_submitted_at = now();
        $user->save();

        return redirect()->route('pendaftar.dashboard')->with('success', 'Semua berkas berhasil diupload.');
    }

    public function uploadPrestasi(Request $request)
    {
        $user = Auth::user();

        // Cek apakah prestasi sudah dikunci
        if ($user->prestasi_locked) {
            return redirect()->back()->with('error', 'Data prestasi sudah terkunci dan tidak dapat diubah. Jika ada kesalahan, silakan hubungi operator.');
        }

        $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'tingkat' => 'required|string',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'foto_prestasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('foto_prestasi')) {
            $path = $request->file('foto_prestasi')->store('prestasi', 'public');
        }

        \App\Models\Prestasi::create([
            'user_id' => auth()->id(),
            'nama_prestasi' => $request->nama_prestasi,
            'tingkat' => $request->tingkat,
            'tahun' => $request->tahun,
            'foto_prestasi' => $path,
        ]);

        return redirect()->back()->with('success', 'Prestasi berhasil diupload.');
    }

    public function lockPrestasi()
    {
        $user = Auth::user();

        if ($user->prestasi_locked) {
            return redirect()->back()->with('error', 'Data prestasi sudah terkunci.');
        }

        // Cek apakah ada minimal 1 prestasi atau user memilih tidak ada prestasi
        if ($user->prestasis->count() == 0) {
            return redirect()->back()->with('error', 'Mohon tambahkan minimal 1 prestasi atau centang "Tidak ada prestasi" sebelum mengunci data.');
        }

        $user->prestasi_locked = true;
        $user->prestasi_submitted_at = now();
        $user->save();

        return redirect()->back()->with('success', 'Data prestasi berhasil dikunci. Data tidak dapat diubah lagi.');
    }


    public function exportPdf()
    {
        $user = Auth::user();
        $berkas = Berkas::where('user_id', $user->id)->first();
        $prestasis = Prestasi::where('user_id', $user->id)->get();

        $pdf = Pdf::loadView('pendaftar.dashboard_pdf', compact('user', 'berkas', 'prestasis'));

        // Download PDF 
        return $pdf->download('dashboard_' . $user->username . '.pdf');
    }

    public function terms()
    {
        return view('pendaftar.terms'); // nanti buat file resources/views/pendaftar/terms.blade.php
    }

    public function seleksi()
    {
        // Ambil semua user yang punya nilai, lalu hitung rata-rata
        $pendaftar = \App\Models\User::whereNotNull('nilai_smt1')
            ->get()
            ->map(function ($user) {
                $user->avg = round(
                    ($user->nilai_smt1 +
                        $user->nilai_smt2 +
                        $user->nilai_smt3 +
                        $user->nilai_smt4 +
                        $user->nilai_smt5) / 5,
                    2
                );
                return $user;
            })
            ->sortByDesc('avg'); // nilai tertinggi ke terendah

        return view('seleksi', compact('pendaftar'));
    }


    public function hapusPrestasi($id)
    {
        $user = Auth::user();
        $prestasi = Prestasi::findOrFail($id);

        // Cek apakah prestasi sudah dikunci
        if ($user->prestasi_locked) {
            return redirect()->back()->with('error', 'Data prestasi sudah terkunci dan tidak dapat dihapus.');
        }

        // Hapus foto dari storage jika ada
        if ($prestasi->foto_prestasi && Storage::exists($prestasi->foto_prestasi)) {
            Storage::delete($prestasi->foto_prestasi);
        }

        // Hapus data dari database
        $prestasi->delete();

        return back()->with('success', 'Prestasi berhasil dihapus.');
    }

    public function hapusBerkas($jenis)
    {
        $user = Auth::user();
        // Cek apakah berkas sudah dikunci
        if ($user->berkas_locked) {
            return redirect()->back()->with('error', 'Berkas sudah terkunci dan tidak dapat dihapus.');
        }

        // $pendaftar = auth()->user()->pendaftar; // Salah, user tidak punya relasi pendaftar ke dirinya sendiri
        $berkas = $user->berkas;

        if ($berkas && $berkas->$jenis) {
            // Hapus file fisik
            Storage::delete('public/' . $berkas->$jenis);

            // Kosongkan field di database
            $berkas->update([$jenis => null]);

            return back()->with('success', 'Berkas berhasil dihapus.');
        }

        return back()->with('error', 'Berkas tidak ditemukan.');
    }

    public function editProfile()
    {
        $user = Auth::user()->load('prestasis');
        $berkas = Berkas::where('user_id', $user->id)->first();
        $prestasis = $user->prestasis ?? collect();

        return view('pendaftar.dashboard', compact('user', 'berkas', 'prestasis'));
    }


    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->username = $data['username'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('pendaftar.editProfile')->with('success', 'Profil berhasil diperbarui.');
    }


}
