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

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        animation: {
                            blob: "blob 7s infinite",
                        },
                        keyframes: {
                            blob: {
                                "0%": { transform: "translate(0px, 0px) scale(1)" },
                                "33%": { transform: "translate(30px, -50px) scale(1.1)" },
                                "66%": { transform: "translate(-20px, 20px) scale(0.9)" },
                                "100%": { transform: "translate(0px, 0px) scale(1)" },
                            }
                        }
                    }
                }
            }
        </script>
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-indigo-900 via-blue-800 to-indigo-900 min-h-screen relative overflow-hidden">
        
        <!-- Decorative background elements -->
        <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-2xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-2xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-2xl opacity-20 animate-blob animation-delay-4000"></div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            <div class="mb-8 transform hover:scale-105 transition-transform duration-300">
                <a href="/">
                    <img src="{{ asset('logo.png.png') }}" alt="ONPF Logo" class="h-28 w-auto drop-shadow-2xl" />
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-10 bg-white/95 backdrop-blur-sm shadow-2xl overflow-hidden sm:rounded-2xl border border-white/20">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-white/60 text-sm">
                &copy; {{ date('Y') }} Office National. Tous droits réservés.
            </div>
        </div>
    </body>
</html>
