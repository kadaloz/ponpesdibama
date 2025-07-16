<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Seo extends Component
{
    public string $title;
    public string $description;
    public string $keywords;
    public string $image;
    public string $url;

    public function __construct(
        string $title = 'Pondok Pesantren Dibama - Pendidikan Islam Unggul',
        string $description = 'Website resmi Pondok Pesantren Diniyah Baitul Makmur Aikmel, lembaga pendidikan Islam yang mencetak generasi Qur’ani dan berakhlak.',
        string $keywords = 'pondok pesantren, dibama, pesantren aikmel, pendidikan islam, ppdb online',
        string $image = '',
        string $url = ''
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->image = $image ?: asset('images/og-default.jpg');
        $this->url = $url ?: url()->current();
    }

    public function render()
    {
        return view('components.seo');
    }
}
