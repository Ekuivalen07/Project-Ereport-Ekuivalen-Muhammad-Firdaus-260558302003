<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#2563eb">
        <title>Akses Dibatasi · Suara Warga, Langkah Perubahan</title>
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
    <body class="flex min-h-screen items-center justify-center bg-slate-50 px-6 font-sans text-slate-900">
        <main class="max-w-md text-center">
            <div class="mb-10">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 font-display text-xl font-extrabold tracking-tight text-slate-900">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white">
                        <i data-lucide="messages-square" aria-hidden="true" class="h-6 w-6 shrink-0"></i>
                    </span>
                    <span>
                        E-Report<span class="text-blue-600">.</span>
                    </span>
                </a>
            </div>
            <p class="font-display text-7xl font-extrabold text-blue-200">403</p>
            <h1 class="mt-6 font-display text-2xl font-bold">Akses halaman dibatasi</h1>
            <p class="mt-4 text-sm leading-7 text-slate-500">Anda tidak memiliki izin untuk mengakses atau mengubah informasi ini.</p>
            <a
                href="{{ auth()->check() ? route(auth()->user()->dashboardRoute()) : route('home') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-bold transition bg-blue-600 text-white shadow-sm shadow-blue-200 hover:bg-blue-700 mt-8"
            >Kembali ke {{ auth()->check() ? 'Dashboard' : 'Beranda' }}</a>
        </main>
    </body>
</html>
