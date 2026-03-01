<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\PeriodeSeleksi;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View|RedirectResponse
    {
        $periodeAktif = PeriodeSeleksi::where('status', 'aktif')->first();

        return view('auth.register', compact('periodeAktif'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $periodeAktif = PeriodeSeleksi::where('status', 'aktif')->first();
        if (!$periodeAktif) {
            return back()->with('error', 'Tidak bisa mendaftar akun dikarenakan tidak ada periode pendaftaran aktif.');
        }

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'no_hp' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->no_hp = $validated['no_hp'];
        $user->password = Hash::make($validated['password']);
        $user->role = 'PENDAFTAR';
        $user->status = 'pending'; // Menunggu Verifikasi - admin yang menentukan

        // Link ke periode aktif jika ada
        $periodeAktif = PeriodeSeleksi::where('status', 'aktif')->first();
        if ($periodeAktif) {
            $user->periode_id = $periodeAktif->id;
        }

        $user->save();

        // Kirim notifikasi email ke admin
        $adminEmail = config('app.admin_email');
        if ($adminEmail) {
            try {
                $namaLengkap = $user->nama_pendaftar ?? $user->username;
                $nisn = $user->nisn_pendaftar ?? '-';
                $asalSekolah = $user->asal_sekolah ?? '-';
                $tanggalDaftar = $user->created_at->format('d F Y, H:i');

                Mail::raw(
                    "Pendaftar Baru PPDB\n\n" .
                    "Nama lengkap: {$namaLengkap}\n" .
                    "NISN: {$nisn}\n" .
                    "Asal sekolah: {$asalSekolah}\n" .
                    "Tanggal daftar: {$tanggalDaftar}\n" .
                    "Username: {$user->username}\n" .
                    "Email: {$user->email}\n",
                    function ($message) use ($adminEmail) {
                        $message->to($adminEmail)
                            ->subject('PPDB - Pendaftar Baru');
                    }
                );
            } catch (\Throwable $e) {
                Log::warning('Gagal mengirim email notifikasi pendaftar baru: ' . $e->getMessage());
            }
        }

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}