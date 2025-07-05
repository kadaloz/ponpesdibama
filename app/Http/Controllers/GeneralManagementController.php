<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralManagementController extends Controller
{
    /**
     * Display the dashboard for general management modules.
     */
    public function index()
    {
        // Di sini Anda bisa mengambil data ringkasan atau statistik umum untuk modul-modul ini
        // (misalnya jumlah pendaftar, total transaksi keuangan, dll.)
        // Kemudian teruskan ke view.

        return view('admin.general.dashboard');
    }

    // Anda akan menambahkan metode lain di sini ketika Anda membangun CRUD untuk sub-modul ini, contoh:
    // public function applicantsIndex() { /* ... */ }
    // public function financeIndex() { /* ... */ }
    // public function teachersIndex() { /* ... */ }
    // public function dormitoriesIndex() { /* ... */ }
    // public function usersIndex() { /* ... */ }
    // public function reportsIndex() { /* ... */ }
    // public function eventsIndex() { /* ... */ }
}
