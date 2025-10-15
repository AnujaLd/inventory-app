<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Inverntry') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Tailwind CSS here (same as original) */
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
                /* ... styles omitted for brevity, keep as in original ... */
            </style>
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

        <main class="flex-1 flex flex-col items-center justify-center w-full">
            <div class="text-center max-w-[448px] w-full py-12 bg-white dark:bg-[#161615] rounded-lg shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)]">
                <h1 class="text-4xl font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">
                    Welcome to Inverntry
                </h1>
                <p class="text-lg text-[#706f6c] dark:text-[#A1A09A] mb-6">
                    The smart way to manage your inventory.
                </p>
                <div class="flex justify-center gap-4">
                    <a
                        href="{{ route('login') }}"
                        class="px-5 py-2 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#1C1C1A] rounded-sm font-medium transition-all hover:bg-black dark:hover:bg-white"
                    >
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="px-5 py-2 border border-[#19140035] dark:border-[#3E3E3A] text-[#1b1b18] dark:text-[#EDEDEC] rounded-sm font-medium transition-all hover:border-black dark:hover:border-white"
                        >
                            Register
                        </a>
                    @endif
                </div>
            </div>
        </main>
    </body>
</html>