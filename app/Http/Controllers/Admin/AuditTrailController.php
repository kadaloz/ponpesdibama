<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditTrail;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;


class AuditTrailController extends Controller
{
    /**
     * Display a listing of the audit logs.
     *
     * @return \Illuminate\View\View
     */

    public function __construct()
    {
        // Middleware untuk melindungi seluruh controller berdasarkan izin
        $this->middleware('permission:view audit logs');
    }
    
    public function index(Request $request)
    {
        $query = AuditTrail::query();

        // Pencarian berdasarkan 'search'
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('action', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('user_name', 'like', '%' . $search . '%'); // Sesuaikan jika Anda punya kolom user_name
                // Jika Anda punya relasi user, bisa tambahkan:
                // ->orWhereHas('user', function ($uq) use ($search) {
                //     $uq->where('name', 'like', '%' . $search . '%');
                // });
            });
        }

        // Filter berdasarkan User
        if ($request->filled('user')) {
            $query->where('user_id', $request->input('user')); // Pastikan user_id ada di model AuditLog
        }

        // Filter berdasarkan Aksi
        if ($request->filled('action')) {
            $query->where('action', $request->input('action'));
        }

        // Filter berdasarkan Rentang Tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->input('start_date'));
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->input('end_date'));
        }

        $logs = $query->orderBy('created_at', 'desc')->paginate(10); // Sesuaikan jumlah per halaman

        // Dapatkan daftar user unik untuk filter dropdown
        $users = User::orderBy('name')->get(['id', 'name']); // Ambil semua user untuk dropdown filter

        // Dapatkan daftar aksi unik untuk filter dropdown
        $actions = AuditTrail::select('action')->distinct()->pluck('action');


        return view('admin.audit-trails.index', compact('logs', 'users', 'actions'));
    }

    public function purge(Request $request)
    {
        $request->validate([
            'purge_date' => 'required|date',
        ]);

        $dateToPurge = Carbon::parse($request->input('purge_date'));

        // Hapus log yang lebih tua dari tanggal yang ditentukan
        $deletedCount = AuditTrail::where('created_at', '<', $dateToPurge)->delete();

        return redirect()->route('admin.audit-trails.index')
                         ->with('success', "{$deletedCount} log audit trail berhasil dihapus yang lebih tua dari {$dateToPurge->format('d F Y')}.");
    }
}
