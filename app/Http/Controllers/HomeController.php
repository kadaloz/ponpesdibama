<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Program;
use App\Models\Setting;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function index()
    {
        $latestNews = News::whereNotNull('published_at')->orderByDesc('published_at')->limit(2)->get();
        $programs = Program::where('is_active', true)->limit(3)->get();
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        $aboutUsContent = $settings['about_us_content'] ?? 'Pondok Pesantren Diniyah Baitul Makmur Aikmel didirikan dengan visi...';
        $missionQuote = $settings['mission_quote'] ?? '"Membina santri menjadi pribadi yang bertakwa, cerdas, mandiri, dan berakhlakul karimah..."';
        $contactAddress = $settings['contact_address'] ?? 'Jl. Contoh Alamat No. 123, Kota Contoh, Provinsi Contoh';
        $contactPhone = $settings['contact_phone'] ?? '+62 812-3456-7890';
        $contactEmail = $settings['contact_email'] ?? 'info@ponpesdibama.com';

        $pondokPhotos = [];
        if (!empty($settings['pondok_photos'])) {
            $decoded = json_decode($settings['pondok_photos'], true);
            if (is_array($decoded)) {
                $pondokPhotos = $decoded;
            }
        }

        $locationMapUrl = $settings['location_map_url'] ?? 'https://www.google.com/maps/embed?...';
        $isPpdbOpen = filter_var($settings['is_ppdb_open'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $ppdbAcademicYear = $settings['ppdb_academic_year'] ?? date('Y') . '/' . (date('Y') + 1);
        $ctaEnrollmentHeading = $settings['cta_enrollment_heading'] ?? 'Siapkan Masa Depan Putra/Putri Anda Bersama PonpesDIBAMA!';
        $galleries = Gallery::published()->latest()->limit(3)->get();

        return view('home', compact(
            'latestNews', 'programs', 'aboutUsContent', 'missionQuote',
            'contactAddress', 'contactPhone', 'contactEmail', 'pondokPhotos',
            'locationMapUrl', 'isPpdbOpen', 'ppdbAcademicYear',
            'ctaEnrollmentHeading', 'galleries'
        ));
    }
}
