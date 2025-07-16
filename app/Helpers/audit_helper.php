<?php

use App\Models\AuditTrail;

if (!function_exists('record_audit')) {
    function record_audit($action, $description, $user = null, $ip_address = null, $user_agent = null)
{
    AuditTrail::create([
        'action'       => $action,
        'description'  => $description,
        'user'         => $user ?? (auth()->user()->name ?? 'Guest'),
        'ip_address'   => $ip_address ?? request()->ip(),
        'user_agent'   => $user_agent ?? request()->userAgent(),
    ]);
}
}
