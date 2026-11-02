<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#2563eb">
        <title>{{ $title ?? 'Selamat Datang' }} · Suara Warga, Langkah Perubahan</title>
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <style type="text/tailwindcss">
            @theme {
                --font-sans: 'DM Sans', sans-serif;
                --font-display: 'Plus Jakarta Sans', sans-serif;
            }

            @layer base {
                button, a, input, textarea, select {
                    @apply focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-blue-600;
                }

                button:not(:disabled), select {
                    @apply cursor-pointer;
                }

                button:disabled {
                    @apply cursor-wait opacity-60;
                }
            }
        </style>
        <style>[x-cloak] { display: none !important; }</style>
        @livewireStyles
    </head>
    <body class="bg-white font-sans text-slate-900 antialiased">
        <div class="grid min-h-screen lg:grid-cols-2">
            <aside class="relative hidden overflow-hidden bg-blue-950 p-12 text-white lg:flex lg:flex-col lg:justify-between xl:p-16">
                <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center gap-2.5 font-display text-xl font-extrabold tracking-tight text-white">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white">
                        <i data-lucide="messages-square" aria-hidden="true" class="h-6 w-6 shrink-0"></i>
                    </span>
                    <span>
                        E-Report<span class="text-blue-600">.</span>
                    </span>
                </a>
                <div class="relative z-10 max-w-lg">
                    <span class="mb-7 inline-flex items-center gap-2 rounded-full border border-blue-400/30 bg-blue-900 px-4 py-2 text-xs font-medium text-blue-100">
                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                        Bersama membangun lingkungan lebih baik
                    </span>
                    <h1 class="font-display text-5xl leading-tight font-bold tracking-tight">
                        Perubahan dimulai
                        <br>
                        dari suara Anda
                        <span class="text-blue-400">.</span>
                    </h1>
                    <p class="mt-6 max-w-md text-base leading-8 text-blue-200">Sampaikan pengaduan, pantau perkembangannya, dan jadilah bagian dari solusi untuk lingkungan kita.</p>
                    <div class="mt-10 space-y-5">
                        @foreach(['Sampaikan pengaduan dengan mudah', 'Pantau proses secara transparan', 'Terhubung langsung dengan pengelola'] as $benefit)
                            <div class="flex items-center gap-3 text-sm text-blue-100">
                                <i data-lucide="circle-check" aria-hidden="true" class="h-5 w-5 shrink-0 text-blue-400"></i>
                                {{ $benefit }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <p class="text-xs text-blue-300">E-Report · Suara Warga, Langkah Perubahan.</p>
                <div class="pointer-events-none absolute -right-44 -bottom-44 h-[500px] w-[500px] rounded-full border-[65px] border-blue-900/60"></div>
            </aside>
            <main class="flex items-center justify-center px-6 py-10 sm:px-12">
                <div class="w-full max-w-md">
                    <div class="mb-10 lg:hidden">
                        <a
                            href="{{ route('home') }}"
                            wire:navigate
                            class="inline-flex items-center gap-2.5 font-display text-xl font-extrabold tracking-tight text-slate-900"
                        >
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white">
                                <i data-lucide="messages-square" aria-hidden="true" class="h-6 w-6 shrink-0"></i>
                            </span>
                            <span>
                                E-Report<span class="text-blue-600">.</span>
                            </span>
                        </a>
                    </div>
                    <a href="{{ route('home') }}" wire:navigate class="mb-8 inline-flex items-center gap-2 text-sm text-slate-500 hover:text-blue-600">
                        <i data-lucide="arrow-left" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                        Kembali ke beranda
                    </a>
                    {{ $slot }}
                    <p class="mt-10 text-center text-xs leading-6 text-slate-400">© {{ date('Y') }} E-Report. Untuk lingkungan yang lebih baik.</p>
                </div>
            </main>
        </div>
        @livewireScripts
        <script src="https://unpkg.com/lucide@0.468.0/dist/umd/lucide.min.js"></script>
        <script>
            function renderIcons() {
                if (window.lucide) {
                    window.lucide.createIcons();
                }
            }

            renderIcons();
            document.addEventListener('livewire:navigated', renderIcons);
            document.addEventListener('livewire:init', () => {
                Livewire.hook('morphed', renderIcons);
            });
        </script>
    </body>
