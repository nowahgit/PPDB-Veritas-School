<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function index()
    {
        // Get statistics
        $totalAdmins = User::where('role', 'ADMIN')->count();
        $totalPendaftar = User::where('role', 'PENDAFTAR')->count();
        
        // Get all pendaftar with their latest data
        $pendaftar = User::where('role', 'PENDAFTAR')
            ->with(['berkas', 'periode'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate additional statistics
        $stats = [
            'pending' => $pendaftar->where('status_seleksi', 'Belum Diseleksi')->count(),
            'approved' => $pendaftar->where('status_seleksi', 'Diterima')->count(),
            'rejected' => $pendaftar->where('status_seleksi', 'Ditolak')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalAdmins', 
            'totalPendaftar', 
            'pendaftar',
            'stats'
        ));
    }

    /**
     * Select/Approve a user
     */
    public function selectUser($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Update user selection status
            $user->status_seleksi = 'Diterima';
            $user->tanggal_seleksi = now();
            $user->save();
            
            return redirect()->route('admin.dashboard')
                ->with('success', 'Pendaftar berhasil diseleksi dan diterima!');
                
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Gagal memproses seleksi: ' . $e->getMessage());
        }
    }

    /**
     * Reject a user
     */
    public function rejectUser($id)
    {
        try {
            $user = User::findOrFail($id);
            
            $user->status_seleksi = 'Ditolak';
            $user->tanggal_seleksi = now();
            $user->save();
            
            return redirect()->route('admin.dashboard')
                ->with('success', 'Pendaftar telah ditolak.');
                
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Gagal memproses penolakan: ' . $e->getMessage());
        }
    }

    /**
     * Update user selection status with notes
     */
    public function updateSelectionStatus(Request $request, $id)
    {
        $request->validate([
            'status_seleksi' => 'required|in:Diterima,Ditolak,Belum Diseleksi',
            'catatan_seleksi' => 'nullable|string|max:500'
        ]);

        try {
            $user = User::findOrFail($id);
            
            $user->status_seleksi = $request->status_seleksi;
            $user->catatan_seleksi = $request->catatan_seleksi;
            $user->tanggal_seleksi = now();
            $user->admin_selector_id = Auth::id();
            $user->save();
            
            return redirect()->back()
                ->with('success', 'Status seleksi berhasil diperbarui!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    /**
     * Get user details for editing
     */
    public function getUserDetails($id)
    {
        try {
            $user = User::with('berkas')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $user
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Export data to Excel/CSV
     */
    public function exportData(Request $request)
    {
        $type = $request->input('type', 'csv'); // csv or excel
        $status = $request->input('status', 'all'); // all, approved, rejected, pending

        $query = User::where('role', 'PENDAFTAR');

        if ($status !== 'all') {
            $statusMap = [
                'approved' => 'Diterima',
                'rejected' => 'Ditolak',
                'pending' => 'Belum Diseleksi'
            ];
            $query->where('status_seleksi', $statusMap[$status]);
        }

        $pendaftar = $query->with('berkas')->get();

        // You can use Laravel Excel or similar package for export
        // This is a simple example
        
        return response()->json([
            'success' => true,
            'message' => 'Export feature will be implemented with Laravel Excel package'
        ]);
    }

    /**
     * Get dashboard statistics for API/AJAX calls
     */
    public function getStatistics()
    {
        $stats = [
            'total_admins' => User::where('role', 'ADMIN')->count(),
            'total_pendaftar' => User::where('role', 'PENDAFTAR')->count(),
            'pending' => User::where('role', 'PENDAFTAR')
                ->where('status_seleksi', 'Belum Diseleksi')->count(),
            'approved' => User::where('role', 'PENDAFTAR')
                ->where('status_seleksi', 'Diterima')->count(),
            'rejected' => User::where('role', 'PENDAFTAR')
                ->where('status_seleksi', 'Ditolak')->count(),
            'recent_registrations' => User::where('role', 'PENDAFTAR')
                ->where('created_at', '>=', now()->subDays(7))
                ->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Bulk selection action
     */
    public function bulkSelection(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'action' => 'required|in:approve,reject'
        ]);

        try {
            $status = $request->action === 'approve' ? 'Diterima' : 'Ditolak';
            
            User::whereIn('id', $request->user_ids)
                ->update([
                    'status_seleksi' => $status,
                    'tanggal_seleksi' => now(),
                    'admin_selector_id' => Auth::id()
                ]);

            $count = count($request->user_ids);
            $message = $request->action === 'approve' 
                ? "$count pendaftar berhasil diterima" 
                : "$count pendaftar berhasil ditolak";

            return redirect()->back()
                ->with('success', $message);
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memproses seleksi: ' . $e->getMessage());
        }
    }
}