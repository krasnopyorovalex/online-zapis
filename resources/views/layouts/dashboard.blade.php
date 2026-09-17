<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <title>{{ $title ?? 'Админка' }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="h-full bg-gray-50 text-gray-800 antialiased">
    <div x-data="{ sidebarOpen: false }" class="min-h-full flex">

        {{-- Sidebar --}}
        <x-dashboard.sidebar />

        {{-- Content wrapper --}}
        <div class="flex-1 flex flex-col min-w-0 lg:pl-64">

            {{-- Topbar (mobile) --}}
            <header
                class="lg:hidden sticky top-0 z-30 flex items-center gap-3 h-14 px-4 bg-white/80 backdrop-blur border-b border-gray-200">
                <button @click="sidebarOpen = true" class="p-2 -ml-2 rounded-md hover:bg-gray-100" aria-label="Открыть меню">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                </button>
                <span class="font-semibold">{{ $title ?? 'Админка' }}</span>
            </header>

            {{-- Main content --}}
            <main class="flex-1 px-4 sm:px-6 lg:px-10 py-6 lg:py-10">
                <div class="max-w-7xl mx-auto">
                    <div class="fixed top-4 right-4 z-60 w-full max-w-sm space-y-2 pointer-events-none">
                        @foreach (['success', 'error', 'warning', 'info'] as $type)
                            @if (session()->has($type))
                                <x-dashboard.flash :type="$type">
                                    {{ session($type) }}
                                </x-dashboard.flash>
                            @endif
                        @endforeach
                    </div>
                    {{ $slot }}
                </div>
            </main>

            {{-- Footer --}}
            <footer class="border-t border-gray-200 bg-white p-1">
                <div
                    class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-gray-500">
                    <span>&copy; {{ date('Y') }} {{ config('app.name') }}</span>
                    <span>v{{ config('app.version', '1.0.0') }}</span>
                </div>
            </footer>
        </div>
    </div>
    @vite('resources/js/app.js')
    @livewireScripts
</body>
</html>
