<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Books Store</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F9D5E5] font-sans antialiased flex items-center justify-center p-4">

    <div class="w-full max-w-sm">

        {{-- Logo dan nama toko --}}
        <div class="text-center mb-6">
            <img src="{{ asset('images/dino-books.svg') }}" alt="Logo Books " class="mx-auto h-36 w-36">
            <h1 class="mt-2 text-2xl font-extrabold tracking-wide text-gray-800">Books </h1>
        </div>

        {{-- Kartu form login --}}
        <div class="bg-white/80 rounded-2xl shadow-lg p-6">

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Username (di Breeze berupa email) --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Username (Email)</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           required autofocus autocomplete="username"
                           placeholder="Masukkan username"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#4C9A2A] focus:ring-[#4C9A2A]">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Password --}}
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password"
                           required autocomplete="current-password"
                           placeholder="Masukkan password"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#4C9A2A] focus:ring-[#4C9A2A]">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Lupa password --}}
                <div class="mt-3 text-right">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-600 underline hover:text-gray-900">
                            Lupa password?
                        </a>
                    @endif
                </div>

                {{-- Tombol login hijau daun --}}
                <button type="submit"
                        class="mt-5 w-full rounded-lg bg-[#4C9A2A] px-4 py-2.5 font-semibold text-white shadow hover:bg-[#3F8422] focus:outline-none focus:ring-2 focus:ring-[#4C9A2A] focus:ring-offset-2">
                    Login
                </button>

                <p class="mt-4 text-center text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-[#3F8422] underline">Daftar</a>
                </p>
            </form>
        </div>
    </div>

</body>
</html>