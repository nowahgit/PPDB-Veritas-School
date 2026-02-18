<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodeSeleksi;
use Illuminate\Support\Facades\Validator;

class PeriodeSeleksiController extends Controller
{
    /**
     * Store a newly created periode in storage.
     */
    public function index()
    {
        $periodeAktif = PeriodeSeleksi::where('status', 'aktif')->first();
        return view('welcome', compact('periodeAktif')); // view landing page
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_periode' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'batas_lulus' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:draft,aktif,selesai',
            'keterangan' => 'nullable|string' // UBAH dari 'deskripsi' ke 'keterangan'
        ], [
            'nama_periode.required' => 'Nama periode wajib diisi',
            'kuota.required' => 'Kuota wajib diisi',
            'kuota.min' => 'Kuota minimal 1',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi',
            'tanggal_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai',
            'batas_lulus.required' => 'Batas nilai lulus wajib diisi',
            'batas_lulus.min' => 'Batas nilai lulus minimal 0',
            'batas_lulus.max' => 'Batas nilai lulus maksimal 100',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        try {
            // Jika status aktif, nonaktifkan periode lain
            if ($request->status === 'aktif') {
                PeriodeSeleksi::where('status', 'aktif')->update(['status' => 'selesai']);
            }

            // Buat periode baru
            $periode = PeriodeSeleksi::create([
                'nama_periode' => $request->nama_periode,
                'kuota' => $request->kuota,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'batas_lulus' => $request->batas_lulus,
                'status' => $request->status,
                'keterangan' => $request->keterangan // UBAH dari 'deskripsi' ke 'keterangan'
            ]);

            return redirect()->back()->with('success', 'Periode berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan periode: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified periode in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_periode' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'batas_lulus' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:draft,aktif,selesai',
            'keterangan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $periode = PeriodeSeleksi::findOrFail($id);

            // Jika status diubah ke aktif, nonaktifkan periode lain
            if ($request->status === 'aktif' && $periode->status !== 'aktif') {
                PeriodeSeleksi::where('status', 'aktif')->where('id', '!=', $id)->update(['status' => 'selesai']);
            }

            $periode->update($request->all());

            return redirect()->back()->with('success', 'Periode berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate periode: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified periode from storage.
     */
    public function destroy($id)
    {
        try {
            $periode = PeriodeSeleksi::findOrFail($id);

            // Cek apakah periode sedang aktif
            if ($periode->status === 'aktif') {
                return redirect()->back()->with('error', 'Tidak dapat menghapus periode yang sedang aktif!');
            }

            // Cek apakah ada pendaftar
            if ($periode->jumlahPeserta() > 0) {
                return redirect()->back()->with('error', 'Tidak dapat menghapus periode yang sudah memiliki pendaftar!');
            }

            $periode->delete();

            return redirect()->back()->with('success', 'Periode berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus periode: ' . $e->getMessage());
        }
    }

    /**
     * Activate periode
     */
    public function activate($id)
    {
        try {
            // Nonaktifkan semua periode lain
            PeriodeSeleksi::where('status', 'aktif')->update(['status' => 'selesai']);

            // Aktifkan periode yang dipilih
            $periode = PeriodeSeleksi::findOrFail($id);
            $periode->update(['status' => 'aktif']);

            return redirect()->back()->with('success', 'Periode berhasil diaktifkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengaktifkan periode: ' . $e->getMessage());
        }
    }

    public function close($id)
    {
        try {
            $periode = PeriodeSeleksi::findOrFail($id);

            if ($periode->status !== 'aktif') {
                return back()->with('error', 'Hanya periode aktif yang bisa ditutup');
            }

            $periode->update([
                'status' => 'selesai',
                'tanggal_selesai' => now() // optional, kalau mau auto close date
            ]);

            return back()->with('success', 'Periode berhasil ditutup');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menutup periode: ' . $e->getMessage());
        }
    }

}