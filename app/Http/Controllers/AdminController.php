<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\PeriodeSeleksi;

class AdminController extends Controller
{
    /**
     * Dashboard Admin
     */
    /**
     * Dashboard Admin
     */
    public function dashboard()
    {
        // ✅ Load relasi admin untuk mendapatkan nama_panitia
        // Ubah dari get() atau all() menjadi paginate()
        $admins = User::where('role', 'ADMIN')
            ->with('admin')
            ->paginate(10);

        $pendaftar = User::where('role', 'PENDAFTAR')
            ->with(['berkas', 'prestasis'])
            ->get();

        $totalAdmins = User::where('role', 'ADMIN')->count();
        $totalPendaftar = User::where('role', 'PENDAFTAR')->count();

        $periodes = PeriodeSeleksi::orderBy('tanggal_mulai', 'desc')->get();
        $periodeAktif = PeriodeSeleksi::where('status', 'aktif')->first();

        return view('admin.dashboard', compact(
            'admins',
            'pendaftar',
            'totalAdmins',
            'totalPendaftar',
            'periodes',
            'periodeAktif'
        ));
    }
    /**
     * Approve Pendaftar
     */
    public function approvePendaftar($id)
    {
        $pendaftar = User::findOrFail($id);

        if ($pendaftar->role !== 'PENDAFTAR') {
            return redirect()->back()->with('error', 'Invalid user role');
        }

        $pendaftar->status = 'approved';
        $pendaftar->save();

        return redirect()->back()->with('success', 'Pendaftar berhasil diterima');
    }

    /**
     * Reject Pendaftar
     */
    public function rejectPendaftar($id)
    {
        $pendaftar = User::findOrFail($id);

        if ($pendaftar->role !== 'PENDAFTAR') {
            return redirect()->back()->with('error', 'Invalid user role');
        }

        $pendaftar->status = 'rejected';
        $pendaftar->save();

        return redirect()->back()->with('success', 'Pendaftar berhasil ditolak');
    }

    /**
     * Update Profil Admin
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diupdate');
    }

    /**
     * Simpan Pendaftar Baru
     */
    public function storePendaftar(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'nama_pendaftar' => 'required|string|max:255',
            'nisn_pendaftar' => 'required|string|max:20',
            'tanggallahir_pendaftar' => 'required|date',
            'alamat_pendaftar' => 'required|string',
            'agama' => 'required|string|max:50',
            'nama_ortu' => 'required|string|max:255',
            'pekerjaan_ortu' => 'required|string|max:100',
            'no_hp_ortu' => 'required|string|max:20',
            'nilai_smt1' => 'required|numeric|min:0|max:100',
            'nilai_smt2' => 'required|numeric|min:0|max:100',
            'nilai_smt3' => 'required|numeric|min:0|max:100',
            'nilai_smt4' => 'required|numeric|min:0|max:100',
            'nilai_smt5' => 'required|numeric|min:0|max:100',
        ]);

        // Buat user pendaftar baru
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'PENDAFTAR',
            'status' => 'pending',
            'nama_pendaftar' => $request->nama_pendaftar,
            'nisn_pendaftar' => $request->nisn_pendaftar,
            'tanggallahir_pendaftar' => $request->tanggallahir_pendaftar,
            'alamat_pendaftar' => $request->alamat_pendaftar,
            'agama' => $request->agama,
            'nama_ortu' => $request->nama_ortu,
            'pekerjaan_ortu' => $request->pekerjaan_ortu,
            'no_hp_ortu' => $request->no_hp_ortu,
            'nilai_smt1' => $request->nilai_smt1,
            'nilai_smt2' => $request->nilai_smt2,
            'nilai_smt3' => $request->nilai_smt3,
            'nilai_smt4' => $request->nilai_smt4,
            'nilai_smt5' => $request->nilai_smt5,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pendaftar baru berhasil ditambahkan'
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Pendaftar baru berhasil ditambahkan');
    }
    /**
     * Update Password Admin
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah');
    }

    /**
     * Edit Pendaftar
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_pendaftar', compact('user'));
    }



    /**
     * Delete Pendaftar
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Data pendaftar berhasil dihapus.');
    }

    /**
     * Tampilkan Form Tambah Admin
     */
    public function create()
    {
        return view('admin.create_admin');
    }

    /**
     * Simpan Admin Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'nama_panitia' => 'required|string|max:50', // input tambahan untuk admin
        ]);

        // Buat user dulu
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'ADMIN',
        ]);

        // Buat record di tabel admin
        Admin::create([
            'user_id' => $user->id,
            'nama_panitia' => $request->nama_panitia,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Admin baru berhasil ditambahkan');
    }

    /**
     * Edit Admin
     */
    public function editAdmin($id)
    {
        $admin = User::where('role', 'ADMIN')->findOrFail($id);
        return view('admin.edit_admin', compact('admin'));
    }

    /**
     * Update Admin
     */
    public function updateAdmin(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:100|unique:users,username,' . $id,
            'email' => 'nullable|email|max:150|unique:users,email,' . $id,
            'nama_panitia' => 'nullable|string|max:50', // ✅ Sesuaikan dengan kolom yang ada
        ]);

        // Update user
        $user = \App\Models\User::findOrFail($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        // Update admin (jika ada field nama_panitia)
        $admin = \App\Models\Admin::where('user_id', $id)->first();
        if ($admin && $request->has('nama_panitia')) {
            $admin->nama_panitia = $request->nama_panitia;
            $admin->save();
        }

        return redirect()->route('admin.dashboard')->with('success', 'Data admin berhasil diperbarui!');
    }


    // Tambahkan method ini ke AdminController.php

    /**
     * Get pendaftar data for edit (JSON)
     */
    public function editJson($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'nama_pendaftar' => $user->nama_pendaftar,
            'nisn_pendaftar' => $user->nisn_pendaftar,
            'tanggallahir_pendaftar' => $user->tanggallahir_pendaftar,
            'alamat_pendaftar' => $user->alamat_pendaftar,
            'agama' => $user->agama,
            'nama_ortu' => $user->nama_ortu,
            'pekerjaan_ortu' => $user->pekerjaan_ortu,
            'no_hp_ortu' => $user->no_hp_ortu,
        ]);
    }

    public function getBerkas($id)
    {
        $user = User::with('berkas')->findOrFail($id);

        if (!$user->berkas) {
            return response()->json(['berkas' => null]);
        }

        return response()->json([
            'berkas' => [
                'kartu_keluarga' => $user->berkas->kk ? asset('storage/' . $user->berkas->kk) : null,
                'akta_kelahiran' => $user->berkas->akta_kelahiran ? asset('storage/' . $user->berkas->akta_kelahiran) : null,
                'ijazah' => $user->berkas->ijazah_skhun ? asset('storage/' . $user->berkas->ijazah_skhun) : null,
            ]
        ]);
    }

    /**
     * Update Pendaftar (with AJAX support)
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->only([
            'nama_pendaftar',
            'nisn_pendaftar',
            'tanggallahir_pendaftar',
            'alamat_pendaftar',
            'agama',
            'nama_ortu',
            'pekerjaan_ortu',
            'no_hp_ortu',
        ]));

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data pendaftar berhasil diperbarui'
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Data pendaftar berhasil diperbarui.');
    }

    /**
     * Delete Admin
     */
    public function destroyAdmin($id)
    {
        $admin = User::where('role', 'ADMIN')->findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Admin berhasil dihapus');
    }




}







