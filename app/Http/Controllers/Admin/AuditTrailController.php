<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditTrail;

class AuditTrailController extends Controller
{
    public function index()
    {
        $logs = AuditTrail::latest()->paginate(20);

        return view('admin.audit_trails.index', compact('logs'));
    }
}