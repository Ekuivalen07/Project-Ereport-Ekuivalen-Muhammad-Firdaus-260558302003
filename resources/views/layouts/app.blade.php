<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#2563eb">
        <title>{{ $title ?? 'Dashboard' }} · Suara Warga, Langkah Perubahan</title>
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
    <body class="bg-slate-50 font-sans text-slate-900 antialiased" x-data="{ menuOpen: false, desktop: window.innerWidth >= 1024 }" @resize.window="desktop = window.innerWidth >= 1024" @keydown.escape.window="menuOpen = false">
        <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-50 focus:rounded-lg focus:bg-white focus:p-3">Langsung ke konten</a>
        <div x-show="menuOpen" x-cloak @click="menuOpen = false" class="fixed inset-0 z-30 bg-slate-950/40 lg:hidden"></div>
        {{-- Sidebar: navigasi bersama untuk dashboard warga dan administrator --}}
        <aside :inert="!menuOpen && !desktop" :class="menuOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-40 flex w-64 flex-col border-r border-slate-200 bg-white transition-transform lg:translate-x-0">
            <div class="flex h-23 shrink-0 items-center justify-between px-7">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 font-display text-xl font-extrabold tracking-tight text-slate-900">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white">
                        <i data-lucide="messages-square" aria-hidden="true" class="h-6 w-6 shrink-0"></i>
                    </span>
                    <span>
                        E-Report<span class="text-blue-600">.</span>
                    </span>
                </a>
                <button @click="menuOpen = false" class="lg:hidden" aria-label="Tutup navigasi">
                    <i data-lucide="x" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                </button>
            </div>
            <div class="px-4 pt-5">
                <p class="mb-4 px-4 text-[10px] font-bold tracking-[.18em] text-slate-400">MENU {{ auth()->user()->role === 'admin' ? 'ADMINISTRATOR' : 'WARGA' }}</p>
                <nav aria-label="Navigasi utama" class="space-y-1.5">
                    {{-- Menu ditampilkan sesuai peran pengguna yang sedang masuk --}}
                    @if(auth()->user()->role === 'admin')
                        <a
                            href="{{ route('admin.dashboard') }}"
                            aria-current="{{ request()->routeIs('admin.dashboard') ? 'page' : 'false' }}"
                            @class([
                                'flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition',
                                'bg-blue-50 text-blue-700' => request()->routeIs('admin.dashboard'),
                                'text-slate-500 hover:bg-slate-50 hover:text-slate-900' => ! request()->routeIs('admin.dashboard'),
                            ])
                        >
                            <i data-lucide="layout-dashboard" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                            Dashboard
                        </a>
                        <a
                            href="{{ route('admin.laporan.index') }}"
                            aria-current="{{ request()->routeIs('admin.laporan.*') ? 'page' : 'false' }}"
                            @class([
                                'flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition',
                                'bg-blue-50 text-blue-700' => request()->routeIs('admin.laporan.*'),
                                'text-slate-500 hover:bg-slate-50 hover:text-slate-900' => ! request()->routeIs('admin.laporan.*'),
                            ])
                        >
                            <i data-lucide="files" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                            Semua Pengaduan
                        </a>
                    @else
                        <a
                            href="{{ route('warga.dashboard') }}"
                            aria-current="{{ request()->routeIs('warga.dashboard') ? 'page' : 'false' }}"
                            @class([
                                'flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition',
                                'bg-blue-50 text-blue-700' => request()->routeIs('warga.dashboard'),
                                'text-slate-500 hover:bg-slate-50 hover:text-slate-900' => ! request()->routeIs('warga.dashboard'),
                            ])
                        >
                            <i data-lucide="layout-dashboard" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                            Dashboard
                        </a>
                        <a
                            href="{{ route('warga.laporan.index') }}"
                            aria-current="{{ request()->routeIs('warga.laporan.index', 'warga.laporan.show', 'warga.laporan.edit') ? 'page' : 'false' }}"
                            @class([
                                'flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition',
                                'bg-blue-50 text-blue-700' => request()->routeIs('warga.laporan.index', 'warga.laporan.show', 'warga.laporan.edit'),
                                'text-slate-500 hover:bg-slate-50 hover:text-slate-900' => ! request()->routeIs('warga.laporan.index', 'warga.laporan.show', 'warga.laporan.edit'),
                            ])
                        >
                            <i data-lucide="files" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                            Pengaduan Saya
                        </a>
                        <a
                            href="{{ route('warga.laporan.create') }}"
                            aria-current="{{ request()->routeIs('warga.laporan.create') ? 'page' : 'false' }}"
                            @class([
                                'flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition',
                                'bg-blue-50 text-blue-700' => request()->routeIs('warga.laporan.create'),
                                'text-slate-500 hover:bg-slate-50 hover:text-slate-900' => ! request()->routeIs('warga.laporan.create'),
                            ])
                        >
                            <i data-lucide="circle-plus" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                            Buat Pengaduan
                        </a>
                        <a
                            href="{{ route('warga.profile') }}"
                            aria-current="{{ request()->routeIs('warga.profile') ? 'page' : 'false' }}"
                            @class([
                                'flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition',
                                'bg-blue-50 text-blue-700' => request()->routeIs('warga.profile'),
                                'text-slate-500 hover:bg-slate-50 hover:text-slate-900' => ! request()->routeIs('warga.profile'),
                            ])
                        >
                            <i data-lucide="user-round" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                            Profil Saya
                        </a>
                    @endif
                </nav>
            </div>
            <div class="mx-5 mt-auto mb-5 rounded-2xl bg-slate-50 p-4">
                <span class="mb-3 flex h-9 w-9 items-center justify-center rounded-xl bg-white text-blue-600 shadow-xs">
                    <i data-lucide="heart-handshake" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                </span>
                <p class="text-sm font-bold">Setiap suara berarti.</p>
                <p class="mt-2 text-xs leading-5 text-slate-500">Bersama wujudkan lingkungan yang nyaman untuk semua.</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-100 p-4">
                @csrf
                <button class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-500 hover:bg-red-50 hover:text-red-600">
                    <i data-lucide="log-out" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                    Keluar
                </button>
            </form>
        </aside>
        <div class="lg:pl-64">
            <header class="flex h-23 items-center justify-between gap-4 border-b border-slate-200/80 bg-white px-5 sm:px-9">
                <div class="flex items-center gap-4">
                    <button @click="menuOpen = true" aria-label="Buka navigasi" :aria-expanded="menuOpen" class="rounded-lg p-2 text-slate-600 lg:hidden">
                        <i data-lucide="menu" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                    </button>
                    <div>
                        <p class="text-sm font-semibold">{{ $title ?? 'Dashboard' }}</p>
                        <p class="mt-1 hidden text-xs text-slate-400 sm:block">Layanan pengaduan masyarakat</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="hidden rounded-lg border border-slate-200 px-3 py-2 text-xs text-slate-500 md:inline-flex">{{ now()->locale('id')->translatedFormat('d F Y') }}</span>
                    <span class="mx-2 hidden h-8 w-px bg-slate-100 md:block"></span>
                    @if(auth()->user()->foto)
                        <img src="{{ Storage::disk('public')->url(auth()->user()->foto) }}" alt="Foto profil" class="h-10 w-10 rounded-full object-cover">
                    @else
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-700">{{ mb_substr(auth()->user()->name, 0, 1) }}</span>
                    @endif
                    <div class="hidden sm:block">
                        <p class="max-w-40 truncate text-sm font-bold">{{ auth()->user()->name }}</p>
                        <p class="mt-0.5 text-xs text-slate-500">{{ auth()->user()->role === 'admin' ? 'Administrator' : 'Warga' }}</p>
                    </div>
                </div>
            </header>
            {{-- Isi halaman Livewire ditampilkan melalui slot ini --}}
            <main id="main-content" class="mx-auto min-h-[calc(100vh-156px)] max-w-7xl px-5 py-8 sm:px-9 sm:py-10">{{ $slot }}</main>
            <footer class="flex flex-wrap justify-between gap-2 border-t border-slate-200 px-5 py-5 text-xs text-slate-400 sm:px-9">
                <p>© {{ date('Y') }} E-Report</p>
                <p>Suara Warga, Langkah Perubahan.</p>
            </footer>
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
</html>
