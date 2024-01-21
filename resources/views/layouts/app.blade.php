<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />
        <link href="{{ asset('css/loading/ball-clip-rotate-multiple.css') }}" rel="stylesheet" />

        <wireui:scripts />

        @livewireStyles

        <!-- Alpine Plugins -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

        <style>[x-cloak] { display: none !important; }</style>
        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('css')
    </head>
    <body class="font-sans antialiased">
        <span class="hidden sm:max-w-sm sm:max-w-md md:max-w-lg sm:max-w-md md:max-w-xl lg:max-w-2xl lg:max-w-3xl xl:max-w-4xl xl:max-w-5xl 2xl:max-w-6xl 2xl:max-w-7xl"></span>
        <x-notifications />
        <x-dialog />
        <div class="min-h-screen bg-gray-100">            
            @include('layouts.navigation')
            
            <main class="bg-grey-200 mt-0 pt-0">                
                {{ $slot }}
            </main>

        </div>
        @livewireScripts
        @livewire('livewire-ui-modal')
        @stack('js')
    </body>
</html>
