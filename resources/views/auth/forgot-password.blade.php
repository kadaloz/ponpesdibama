<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - PonpesDIBAMA.com</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .login-bg {
            background-color:rgb(5, 99, 91); /* teal-700 */
            background-size: cover;
            background-position: center;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen login-bg">
    <div class="w-full max-w-md bg-white rounded-xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
        <div class="text-center mb-8">
            {{-- Logo Ponpes --}}
            <a href="{{ url('/') }}" class="text-4xl font-extrabold text-teal-700 block mb-2">PonpesDIBAMA<span class="text-2xl text-yellow-500">.com</span></a>
            <p class="text-gray-600 text-lg">Lupa Password Admin</p>
        </div>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-6 text-sm text-gray-600">
            Lupa password Anda? Jangan khawatir. Cukup masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang password baru.
        </div>

<form method="POST" action="{{ route('password.email') }}" class="space-y-6" x-data="{ loading: false }" @submit="loading = true">
    @csrf

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-base">
        @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
        <button type="submit"
                class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest transition ease-in-out duration-150 shadow-lg"
                x-bind:class="{ 'bg-teal-600 cursor-not-allowed pointer-events-none': loading, 'bg-teal-700 hover:bg-teal-800 focus:bg-teal-800 active:bg-teal-900 transform hover:scale-105': !loading }"
                :disabled="loading">
            <span x-show="!loading">Kirim Tautan Atur Ulang Password</span>
            <span x-show="loading" x-cloak class="flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses...
            </span>
        </button>
    </div>
</form>
    </div>
</body>
</html>