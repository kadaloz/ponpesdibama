{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PonpesDIBAMA.com</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Optional: Add a subtle background image or pattern for the login page */
        .login-bg {
            background-image: url('https://placehold.co/1920x1080/000000/FFFFFF?text=Login+Background+Ponpes'); /* Ganti dengan gambar latar belakang pondok */
            background-size: cover;
            background-position: center;
        }
        [x-cloak] { display: none !important; } /* Alpine.js directive to hide elements until processed */
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen login-bg">
    <div class="w-full max-w-md bg-white rounded-xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
        <div class="text-center mb-8">
            {{-- Logo Ponpes --}}
            <a href="{{ url('/') }}" class="text-4xl font-extrabold text-teal-700 block mb-2">PonpesDIBAMA<span class="text-2xl text-yellow-500">.com</span></a>
            <p class="text-gray-600 text-lg">Panel Login Admin</p>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        {{-- Add x-data for loading state --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-6" x-data="{ loading: false }" @submit="loading = true">
            @csrf

            {{-- Email Input --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-base">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password Input --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-base">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me & Forgot Password --}}
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-teal-600 shadow-sm focus:ring-teal-500" name="remember">
                    <label for="remember_me" class="ms-2 text-sm text-gray-600">Ingat Saya</label>
                </div>

                @if (Route::has('password.request'))
                    <a class="text-sm text-teal-600 hover:text-teal-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500" href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif
            </div>

            {{-- Login Button with Loading Effect --}}
            <div class="flex items-center justify-end">
                <button type="submit"
                        class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest transition ease-in-out duration-150 shadow-lg"
                        x-bind:class="{ 'bg-teal-600 cursor-not-allowed pointer-events-none': loading, 'bg-teal-700 hover:bg-teal-800 focus:bg-teal-800 active:bg-teal-900 transform hover:scale-105': !loading }"
                        :disabled="loading">
                    <span x-show="!loading">Login Admin</span>
                    <span x-show="loading" x-cloak class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </div>

            {{-- No Register Link --}}
            {{-- <div class="text-center mt-4">
                <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                    Belum punya akun? Daftar
                </a>
            </div> --}}
        </form>
    </div>
</body>
</html>
