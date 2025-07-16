<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditTrail;
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
    
    public function index()
    {
        $logs = AuditTrail::latest()->paginate(20);

        return view('admin.audit-trails.index', compact('logs'));
    }
}