@extends('web.apps') {{-- Ini memberitahu Blade untuk menggunakan apps.blade.php sebagai layout --}}

@section('title', 'Beranda - Pondok Pesantren DIBAMA')
@section('meta_description', 'Website resmi Pondok Pesantren Diniyah Baitul Makmur Aikmel. Tempat mencetak generasi Qurani dan berakhlak Islami.')
@section('meta_keywords', 'pondok pesantren, dibama, aikmel, pendidikan islam, ppdb online')
@section('meta_image', asset('storage/images/logo/pondok.png')) {{-- Pastikan path ini benar --}}

@section('main_content')
    {{-- Isi semua konten spesifik halaman beranda Anda di sini --}}

    <section id="beranda" class="py-20 bg-teal-600 text-white text-center">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold mb-4">Selamat Datang di Pondok Pesantren DIBAMA</h1>
            <p class="text-xl">Mendidik Generasi Qur'ani, Berakhlak Islami, untuk Membangun Negeri.</p>
            <a href="#program" class="mt-8 inline-block bg-white text-teal-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100">Lihat Program Kami</a>
        </div>
    </section>

    <section id="tentang" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-teal-700 mb-12">Tentang Kami</h2>
            <div class="text-gray-700 leading-relaxed">
                <p>Pondok Pesantren Diniyah Baitul Makmur Aikmel adalah lembaga pendidikan Islam yang berkomitmen mencetak generasi unggul...</p>
                {{-- Anda bisa menambahkan konten dari variabel PHP di sini --}}
                <p>{!! $aboutUsContent ?? 'Konten tentang kami akan muncul di sini.' !!}</p>
                <blockquote class="mt-4 italic border-l-4 border-teal-500 pl-4 text-teal-800">
                    {{ $missionQuote ?? 'Motto atau kutipan akan muncul di sini.' }}
                </blockquote>
            </div>
        </div>
    </section>

    <section id="program" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-teal-700 mb-12">Program Pendidikan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Contoh Loop untuk Program --}}
                @forelse ($programs as $program)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-2xl font-bold text-teal-700 mb-2">{{ $program->title }}</h3>
                        <p class="text-gray-600">{{ Str::limit($program->description, 100) }}</p>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-600">Belum ada program pendidikan yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section id="nasihat-harian" class="py-20 bg-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-center text-teal-700 mb-12">Nasihat Harian</h2>
            <div id="dailyAdviceOutput" class="bg-gray-100 p-8 rounded-lg min-h-[100px] flex items-center justify-center text-gray-700 italic">
                Klik tombol di bawah untuk mendapatkan nasihat.
            </div>
            <button id="getDailyAdviceBtn" class="mt-8 bg-teal-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-teal-700">Dapatkan Nasihat ✨</button>
            <div id="dailyAdviceSpinner" class="hidden mt-4 text-teal-600">Loading...</div>
        </div>
    </section>

    <section id="berita" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-teal-700 mb-12">Berita Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse ($latestNews as $newsItem)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-2xl font-bold text-teal-700 mb-2">{{ $newsItem->title }}</h3>
                        <p class="text-gray-600">{{ Str::limit(strip_tags($newsItem->content), 150) }}</p>
                        <a href="{{ route('news.show', $newsItem->slug) }}" class="text-teal-600 hover:underline mt-2 inline-block">Baca Selengkapnya</a>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-600">Belum ada berita terbaru.</p>
                @endforelse
            </div>
            <div class="text-center mt-12">
                <a href="{{ url('/berita') }}" class="inline-block bg-teal-600 text-white px-8 py-4 rounded-full font-semibold hover:bg-teal-700">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <section id="pendaftaran" class="py-20 bg-teal-600 text-white text-center">
        <div class="container mx-auto px-4">
            @if ($isPpdbOpen)
                <h2 class="text-4xl font-bold mb-4">Pendaftaran Santri Baru Dibuka!</h2>
                <p class="text-xl">Segera daftar untuk tahun ajaran {{ $ppdbAcademicYear ?? 'mendatang' }}.</p>
                <a href="{{ route('ppdb.create') }}" class="mt-8 inline-block bg-white text-teal-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100">Daftar Sekarang!</a>
            @else
                <h2 class="text-4xl font-bold mb-4">Pendaftaran Santri Baru Telah Ditutup</h2>
                <p class="text-xl">Nantikan informasi pendaftaran selanjutnya.</p>
                <a href="#kontak" class="mt-8 inline-block bg-white text-teal-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100">Hubungi Kami</a>
            @endif
        </div>
    </section>

    <section id="galeri" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-teal-700 mb-12">Galeri Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($galleries as $gallery)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <img src="{{ $gallery->cover_image ? asset('storage/' . $gallery->cover_image) : 'https://via.placeholder.com/400x250' }}" alt="{{ $gallery->title }}" class="w-full h-48 object-cover rounded-md mb-4">
                        <h3 class="text-2xl font-bold text-teal-700 mb-2">{{ $gallery->title }}</h3>
                        <a href="{{ route('public.galleries.show', $gallery->slug) }}" class="text-teal-600 hover:underline">Lihat Album</a>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-600">Belum ada galeri yang dipublikasi.</p>
                @endforelse
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('public.galleries.index') }}" class="inline-block bg-teal-600 text-white px-8 py-4 rounded-full font-semibold hover:bg-teal-700">Lihat Semua Galeri</a>
            </div>
        </div>
    </section>

    <section id="kontak" class="py-20 bg-teal-700 text-white text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold mb-4">Kontak Kami</h2>
            <p class="text-xl">Kami siap membantu Anda.</p>
            <div class="mt-8">
                <p>Alamat: {{ $contactAddress ?? 'Alamat akan muncul di sini' }}</p>
                <p>Telepon: {{ $contactPhone ?? 'Telepon akan muncul di sini' }}</p>
                <p>Email: {{ $contactEmail ?? 'Email akan muncul di sini' }}</p>
                <a href="https://wa.me/6281916577540?text=Assalamu'alaikum%2C%20saya%20ingin%20bertanya%20tentang%20PonpesDIBAMA" target="_blank" class="mt-4 inline-flex items-center bg-green-500 text-white px-6 py-3 rounded-full font-semibold hover:bg-green-600">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2C6.59 2 2.11 6.47 2.11 11.92c0 1.7.45 3.32 1.25 4.77l-1.36 4.96 5.12-1.34c1.37.75 2.91 1.15 4.09 1.15h.01c5.44 0 9.92-4.47 9.92-9.92S17.49 2 12.04 2zm3.39 12.87c-.16.27-.64.57-.87.64-.23.07-.46.09-.69.02-.23-.07-.54-.15-1.04-.42-.51-.27-1.21-.67-2.31-1.49-.85-.64-1.42-1.2-1.59-1.46-.16-.27-.02-.42.12-.55.12-.12.27-.3.38-.45.1-.14.15-.27.23-.42.08-.14.04-.27-.02-.38-.07-.12-.69-1.66-.95-2.27-.23-.55-.47-.46-.64-.46-.16 0-.34-.02-.51-.02-.18 0-.47.07-.72.32-.23.23-.88.86-.88 2.1c0 1.24.9 2.45 1.02 2.61.12.16 1.76 2.68 4.27 3.73 1.04.42 1.87.66 2.51.84.14.04.28.06.4.08.38.07.72.04 1-.02.26-.07.78-.32 1.03-.64.23-.32.23-.6.16-.72z"/></svg>
                    WhatsApp Kami
                </a>
            </div>
            <div class="mt-8 w-full h-64 bg-gray-200 rounded-lg">
                {{-- Placeholder Peta --}}
                @if ($locationMapUrl)
                    <iframe src="{{ $locationMapUrl }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                @else
                    <div class="flex items-center justify-center h-full text-gray-600">
                        <p>Peta lokasi akan ditampilkan di sini.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // === DOM ELEMENTS ===
        const getDailyAdviceBtn = document.getElementById('getDailyAdviceBtn');
        const dailyAdviceOutput = document.getElementById('dailyAdviceOutput');
        const dailyAdviceSpinner = document.getElementById('dailyAdviceSpinner');

        // === SMOOTH SCROLLING FOR INTERNAL LINKS ===
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                // Dapatkan tinggi header dan floating nav jika ada
                const header = document.querySelector('header');
                const floatingNav = document.querySelector('nav.sticky');
                let offset = 0;
                if (header) {
                    offset += header.offsetHeight;
                }
                if (floatingNav) {
                    offset += floatingNav.offsetHeight;
                }
                // Tambahkan sedikit padding ekstra
                offset += 30; 

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - offset,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // === SCROLLSPY: Highlight Active Navigation Link ===
        // Mengamati bagian-bagian (sections) saat scroll dan mengaktifkan link navigasi yang sesuai
        const sections = document.querySelectorAll("section[id]");
        const navLinks = document.querySelectorAll(".nav-link");

        function activateLink() {
            const scrollY = window.pageYOffset; // Posisi scroll vertikal saat ini

            sections.forEach((section) => {
                // Posisi atas bagian dikurangi offset agar link aktif lebih awal
                const sectionTop = section.offsetTop - 160; 
                const sectionHeight = section.offsetHeight;
                const sectionId = section.getAttribute("id");

                if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                    navLinks.forEach((link) => {
                        link.classList.remove("active"); // Hapus kelas active dari semua link
                        if (link.getAttribute("href") === `#${sectionId}`) {
                            link.classList.add("active"); // Tambahkan kelas active ke link yang sesuai
                        }
                    });
                }
            });
        }
        window.addEventListener("scroll", activateLink); // Panggil fungsi saat scroll
        activateLink(); // Panggil sekali saat load untuk mengatur status awal

        // === DAILY ADVICE FEATURE (Menggunakan Gemini API) ===
        getDailyAdviceBtn?.addEventListener('click', async () => {
            dailyAdviceOutput.textContent = ''; // Bersihkan output sebelumnya
            dailyAdviceSpinner.classList.remove('hidden'); // Tampilkan spinner
            getDailyAdviceBtn.disabled = true; // Nonaktifkan tombol

            try {
                const prompt = "Berikan satu nasihat singkat Islami atau kutipan Al-Quran/Hadits beserta terjemahan/maknanya dalam bahasa Indonesia. Batasi hingga 500 karakter.";
                const chatHistory = [{ role: "user", parts: [{ text: prompt }] }];
                const payload = { contents: chatHistory };
                // Pastikan API Key Anda ADA dan BENAR!
                const apiKey = "AIzaSyDxC3Qv2HIKFtg3wVI5Cbr9jVZacVwI7YI"; // GANTI DENGAN API KEY ASLI ANDA
                const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;

                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(`Error API: ${response.status} - ${errorData.error?.message || 'Unknown error'}`);
                }

                const result = await response.json();
                const text = result?.candidates?.[0]?.content?.parts?.[0]?.text;

                if (text) {
                    dailyAdviceOutput.textContent = text;
                } else {
                    dailyAdviceOutput.textContent = 'Gagal mendapatkan nasihat. Silakan coba lagi.';
                    console.error('Unexpected API response structure:', result);
                }
            } catch (error) {
                console.error('Error generating daily advice:', error);
                dailyAdviceOutput.textContent = 'Terjadi kesalahan saat mengambil nasihat: ' + error.message;
            } finally {
                dailyAdviceSpinner.classList.add('hidden'); // Sembunyikan spinner
                getDailyAdviceBtn.disabled = false; // Aktifkan kembali tombol
            }
        });
    });
</script>
@endpush