<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="apple-touch-icon" sizes="57x57" href="/images/app-icons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/images/app-icons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/images/app-icons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/images/app-icons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/images/app-icons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/images/app-icons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/images/app-icons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/images/app-icons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/app-icons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/images/app-icons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/app-icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/images/app-icons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/app-icons/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#000000">
        <meta name="msapplication-TileImage" content="/images/app-icons/ms-icon-144x144.png">
        <meta name="theme-color" content="#000000">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <style>
            {!! Vite::content('resources/css/dotd-template.css') !!}
        </style>
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
