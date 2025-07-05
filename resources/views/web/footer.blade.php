{{-- resources/views/web/footer.blade.php --}}
<footer class="bg-gradient-to-tr from-teal-800 to-teal-900 text-white py-12 mt-20 rounded-t-3xl shadow-inner">
    <div class="container mx-auto px-6">
        <!-- Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center md:text-left">
            <!-- Brand & Copyright -->
            <div>
                <h4 class="text-2xl font-bold mb-3">Ponpes DIBAMA</h4>
                <p class="text-gray-300 text-sm leading-relaxed">
                    Mendidik Generasi Qur’ani, Berakhlaq Islami, Untuk Membangun Negeri.
                </p>
                <p class="mt-4 text-sm text-gray-400">&copy; {{ date('Y') }}. All rights reserved.</p>
            </div>

            <!-- Menu -->
            <div>
                <h5 class="text-lg font-semibold mb-3">Tautan Penting</h5>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ url('/ppdb') }}" class="hover:underline text-gray-300 hover:text-white transition">Pendaftaran PPDB</a></li>
                    <li><a href="#" class="hover:underline text-gray-300 hover:text-white transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:underline text-gray-300 hover:text-white transition">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            <!-- Social Media -->
            <div>
                <h5 class="text-lg font-semibold mb-3">Ikuti Kami</h5>
                <div class="space-y-3">
                    <a href="https://facebook.com/DiniyahBaitulMakmur" target="_blank" class="flex items-center space-x-2 text-gray-300 hover:text-white transition">
                        <x-icons.facebook class="w-5 h-5" />
                        <span class="text-sm">@DiniyahBaitulMakmur</span>
                    </a>
                    <a href="https://instagram.com/DiniyahBaitulMakmur" target="_blank" class="flex items-center space-x-2 text-gray-300 hover:text-white transition">
                        <x-icons.instagram class="w-5 h-5" />
                        <span class="text-sm">@DiniyahBaitulMakmur</span>
                    </a>
                    <a href="https://youtube.com/@DiniyahBaitulMakmur" target="_blank" class="flex items-center space-x-2 text-gray-300 hover:text-white transition">
                        <x-icons.youtube class="w-5 h-5" />
                        <span class="text-sm">@DiniyahBaitulMakmur</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-teal-700 mt-10 pt-6 text-center text-xs text-teal-300">
            Dibangun oleh Team IT PonpesDibama untuk pendidikan Islam | Laravel + Tailwind CSS
        </div>
    </div>
</footer>
