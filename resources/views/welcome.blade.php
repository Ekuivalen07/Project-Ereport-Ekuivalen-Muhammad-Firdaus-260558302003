<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#2563eb">
        <title>Beranda · Suara Warga, Langkah Perubahan</title>
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
        <meta name="description" content="E-Report membantu warga menyampaikan pengaduan lingkungan dengan mudah dan memantau penanganannya secara transparan.">
    </head>
    <body class="bg-white font-sans text-slate-900 antialiased">
        <header class="border-b border-slate-100">
            <nav class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-6 py-5 lg:px-10" aria-label="Navigasi beranda">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 font-display text-xl font-extrabold tracking-tight text-slate-900">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white">
                        <i data-lucide="messages-square" aria-hidden="true" class="h-6 w-6 shrink-0"></i>
                    </span>
                    <span>
                        E-Report<span class="text-blue-600">.</span>
                    </span>
                </a>
                <div class="hidden items-center gap-8 text-sm text-slate-500 md:flex">
                    <a href="#tentang" class="hover:text-blue-600">Tentang E-Report</a>
                    <a href="#cara-kerja" class="hover:text-blue-600">Cara Melapor</a>
                    <a href="#status" class="hover:text-blue-600">Status Pengaduan</a>
                </div>
                <div class="flex items-center gap-3">
                    @auth
                        <a
                            href="{{ route(auth()->user()->dashboardRoute()) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-bold transition bg-blue-600 text-white shadow-sm shadow-blue-200 hover:bg-blue-700"
                        >
                            Dashboard
                            <i data-lucide="arrow-up-right" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-2 text-sm font-bold text-slate-600">Masuk</a>
                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-bold transition bg-blue-600 text-white shadow-sm shadow-blue-200 hover:bg-blue-700"
                        >
                            Daftar
                            <i data-lucide="arrow-up-right" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                        </a>
                    @endauth
                </div>
            </nav>
        </header>
        <main>
            <section class="relative overflow-hidden bg-slate-50/70">
                <div class="mx-auto grid max-w-7xl items-center gap-12 px-6 py-16 lg:grid-cols-[1.05fr_1fr] lg:gap-16 lg:px-10 lg:py-24">
                    <div>
                        <div class="mb-7 inline-flex items-center gap-2 rounded-full border border-blue-100 bg-blue-50 px-4 py-2 text-xs font-semibold text-blue-700">
                            <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                            RUANG ASPIRASI & PENGADUAN WARGA
                        </div>
                        <h1 class="font-display text-4xl leading-[1.17] font-extrabold tracking-tight sm:text-6xl">
                            Suara Warga,
                            <br>
                            Langkah
                            <span class="text-blue-600">Perubahan.</span>
                        </h1>
                        <p class="mt-6 max-w-lg text-base leading-8 text-slate-500">Laporkan permasalahan di lingkungan sekitar dengan mudah, cepat, dan transparan melalui E-Report.</p>
                        <div class="mt-9 flex flex-wrap gap-3">
                            <a
                                href="{{ auth()->check() ? route(auth()->user()->dashboardRoute()) : route('register') }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-bold transition bg-blue-600 text-white shadow-sm shadow-blue-200 hover:bg-blue-700 px-6 py-3.5"
                            >
                                Mulai Buat Pengaduan
                                <i data-lucide="arrow-right" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                            </a>
                            <a
                                href="#cara-kerja"
                                class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-bold transition border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 py-3.5"
                            >Pelajari Cara Kerjanya</a>
                        </div>
                        <div class="mt-8 flex items-center gap-2 text-xs text-slate-500">
                            <i data-lucide="shield-check" aria-hidden="true" class="h-4 w-4 shrink-0 text-emerald-600"></i>
                            Akses pengaduan terbatas untuk Anda dan pengelola.
                        </div>
                    </div>
                    <div class="relative mx-auto w-full max-w-lg pb-7 lg:pl-5" aria-label="Ilustrasi alur pengaduan">
                        <div class="absolute inset-5 rounded-[32px] bg-blue-100/70"></div>
                        <div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-blue-950/5">
                            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
                                <div class="flex items-center gap-2 text-sm font-bold">
                                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-600 text-white">
                                        <i data-lucide="messages-square" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                                    </span>
                                    Pengaduan Lingkungan
                                </div>
                                <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-semibold text-slate-500">ILUSTRASI</span>
                            </div>
                            <div class="p-6">
                                <div class="relative mb-5 flex h-44 items-center justify-center overflow-hidden rounded-2xl bg-blue-50">
                                    <svg viewBox="0 0 400 180" class="h-full w-full" role="img" aria-label="Ilustrasi lingkungan perkotaan">
                                        <rect width="400" height="180" fill="#eff6ff"/>
                                        <circle cx="326" cy="35" r="20" fill="#fde68a"/>
                                        <rect y="140" width="400" height="40" fill="#dbeafe"/>
                                        <path d="M0 160h400" stroke="#93c5fd" stroke-width="2"/>
                                        <path d="M0 176h400" stroke="#fff" stroke-width="3" stroke-dasharray="28 18"/>
                                        <path d="M55 140V67h58v73M131 140V42h66v98M215 140V82h56v58" fill="#bfdbfe" stroke="#60a5fa" stroke-width="2"/>
                                        <path d="M65 81h12m15 0h12M65 102h12m15 0h12M65 122h12m15 0h12M143 57h14m14 0h14M143 78h14m14 0h14M143 99h14m14 0h14M143 120h14m14 0h14M227 96h12m12 0h12M227 117h12m12 0h12" stroke="#60a5fa" stroke-width="5"/>
                                        <path d="M310 140V99m0-12V60h29" stroke="#475569" stroke-width="4" fill="none"/>
                                        <path d="M330 60h17" stroke="#fbbf24" stroke-width="7" stroke-linecap="round"/>
                                        <path d="M35 140v-30m0-8V85" stroke="#059669" stroke-width="5"/>
                                        <circle cx="35" cy="92" r="17" fill="#6ee7b7"/>
                                        <path d="M365 140v-30" stroke="#059669" stroke-width="5"/>
                                        <circle cx="365" cy="99" r="21" fill="#6ee7b7"/>
                                    </svg>
                                </div>
                                <p class="text-[10px] font-bold tracking-widest text-blue-600">CONTOH PENGADUAN</p>
                                <h2 class="mt-2 font-display text-lg font-bold">Lampu jalan perlu perbaikan</h2>
                                <p class="mt-2 text-xs leading-6 text-slate-500">Laporan sederhana. Dampak nyata untuk lingkungan.</p>
                                <div class="mt-5 space-y-4 border-t border-slate-100 pt-5">
                                    @foreach([['circle-check','Pengaduan diterima','Informasi tercatat dengan baik','text-emerald-600 bg-emerald-50'],['loader-circle','Dalam penanganan','Pengelola menindaklanjuti laporan','text-blue-600 bg-blue-50'],['check','Lingkungan lebih nyaman','Perubahan dimulai dari kepedulian','text-slate-400 bg-slate-100']] as [$icon,$title,$desc,$color])
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full {{ $color }}">
                                                <i data-lucide="{{ $icon }}" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                                            </span>
                                            <div>
                                                <p class="text-xs font-bold">{{ $title }}</p>
                                                <p class="mt-1 text-[11px] text-slate-400">{{ $desc }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="absolute -bottom-1 right-2 flex items-center gap-3 rounded-2xl border border-emerald-100 bg-white px-5 py-4 shadow-lg shadow-slate-950/5 sm:-right-4">
                            <span class="rounded-full bg-emerald-50 p-2 text-emerald-600">
                                <i data-lucide="heart-handshake" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                            </span>
                            <div>
                                <p class="text-xs font-bold">Kepedulian Anda berarti</p>
                                <p class="mt-1 text-[10px] text-slate-400">Bersama, kita bisa membuat perubahan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="tentang" class="mx-auto max-w-7xl px-6 py-20 lg:px-10">
                <div class="grid gap-8 lg:grid-cols-2">
                    <div>
                        <p class="text-xs font-bold tracking-widest text-blue-600">TENTANG E-REPORT</p>
                        <h2 class="mt-4 max-w-lg font-display text-3xl leading-snug font-bold tracking-tight">
                            Lingkungan yang lebih baik,
                            <br>
                            dimulai dari kita.
                        </h2>
                    </div>
                    <p class="max-w-xl text-base leading-8 text-slate-500">E-Report menjadi jembatan antara warga dan pengelola untuk menangani permasalahan publik. Mulai dari jalan rusak hingga sampah menumpuk, sampaikan masalah di sekitar Anda agar dapat ditindaklanjuti.</p>
                </div>
                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    @foreach([['send','Mudah disampaikan','Buat pengaduan dalam beberapa langkah. Sertakan deskripsi dan foto agar masalah lebih mudah dipahami.'],['scan-eye','Transparan dipantau','Ikuti status penanganan pengaduan Anda, mulai dari menunggu peninjauan sampai selesai ditangani.'],['handshake','Berdampak bersama','Bantu pengelola mengenali masalah dan membangun lingkungan yang lebih aman serta nyaman.']] as [$icon,$title,$desc])
                        <div class="rounded-2xl border border-slate-200 p-7">
                            <span class="mb-5 inline-flex rounded-xl bg-blue-50 p-3 text-blue-600">
                                <i data-lucide="{{ $icon }}" aria-hidden="true" class="h-6 w-6 shrink-0"></i>
                            </span>
                            <h3 class="font-display text-lg font-bold">{{ $title }}</h3>
                            <p class="mt-3 text-sm leading-7 text-slate-500">{{ $desc }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
            <section id="cara-kerja" class="bg-slate-50 px-6 py-20">
                <div class="mx-auto max-w-6xl">
                    <div class="text-center">
                        <p class="text-xs font-bold tracking-widest text-blue-600">CARA MELAPOR</p>
                        <h2 class="mt-4 font-display text-3xl font-bold tracking-tight">Sampaikan dalam tiga langkah.</h2>
                        <p class="mt-4 text-sm text-slate-500">Mudah untuk Anda, berarti untuk lingkungan.</p>
                    </div>
                    <div class="mt-14 grid gap-10 md:grid-cols-3">
                        @foreach([['Buat akun warga','Daftarkan diri menggunakan email dan lengkapi informasi kontak Anda.'],['Sampaikan pengaduan','Tuliskan masalah, tanggal kejadian, dan tambahkan foto bukti bila tersedia.'],['Pantau perkembangannya','Buka dashboard untuk melihat tindak lanjut pengaduan Anda.']] as [$title,$desc])
                            <div class="text-center">
                                <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-200 bg-white font-display text-lg font-bold text-blue-600">0 {{ $loop->iteration }}</span>
                                <h3 class="mt-6 font-display font-bold">{{ $title }}</h3>
                                <p class="mx-auto mt-3 max-w-xs text-sm leading-7 text-slate-500">{{ $desc }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <section id="status" class="mx-auto max-w-7xl px-6 py-20 lg:px-10">
                <div class="text-center">
                    <p class="text-xs font-bold tracking-widest text-blue-600">STATUS PENGADUAN</p>
                    <h2 class="mt-4 font-display text-3xl font-bold tracking-tight">Jelas di setiap tahap.</h2>
                    <p class="mt-4 text-sm text-slate-500">Ketahui apa yang sedang terjadi pada pengaduan Anda.</p>
                </div>
                <div class="mt-10 grid gap-5 md:grid-cols-3">
                    @foreach(['pending' => 'Pengaduan menunggu peninjauan admin.', 'proses' => 'Pengaduan sedang ditindaklanjuti.', 'selesai' => 'Pengaduan telah selesai ditangani.'] as $status => $desc)
                        <div class="rounded-2xl border border-slate-200 p-7">
                            <span @class([
                            'inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-3 py-1.5 text-xs font-semibold',
                            'bg-amber-50 text-amber-800 ring-1 ring-inset ring-amber-200' => $status === 'pending',
                            'bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-200' => $status === 'proses',
                            'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-200' => $status === 'selesai',
                            ])>
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                {{ \App\Models\Laporan::STATUSES[$status] ?? $status }}
                            </span>
                            <p class="mt-5 text-sm leading-7 text-slate-500">{{ $desc }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-20 flex flex-col items-start justify-between gap-7 rounded-3xl bg-blue-950 p-8 text-white sm:p-12 md:flex-row md:items-center">
                    <div>
                        <h2 class="font-display text-2xl font-bold sm:text-3xl">Punya kepedulian? Sampaikan.</h2>
                        <p class="mt-3 max-w-xl text-sm leading-7 text-blue-200">Jadilah bagian dari perubahan untuk lingkungan kita.</p>
                    </div>
                    <a
                        href="{{ auth()->check() ? route(auth()->user()->dashboardRoute()) : route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-bold transition bg-blue-600 text-white shadow-sm shadow-blue-200 hover:bg-blue-700 shrink-0 bg-white text-blue-950 shadow-none hover:bg-blue-50"
                    >
                        Mulai Sekarang
                        <i data-lucide="arrow-right" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                    </a>
                </div>
            </section>
        </main>
        <footer class="border-t border-slate-100">
            <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-6 px-6 py-8 lg:px-10">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 font-display text-xl font-extrabold tracking-tight text-slate-900">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white">
                        <i data-lucide="messages-square" aria-hidden="true" class="h-6 w-6 shrink-0"></i>
                    </span>
                    <span>
                        E-Report<span class="text-blue-600">.</span>
                    </span>
                </a>
                <p class="text-xs text-slate-400">© {{ date('Y') }} E-Report. Suara Warga, Langkah Perubahan.</p>
                <a href="#cara-kerja" class="text-xs text-slate-500 hover:text-blue-600">Panduan Pengaduan</a>
            </div>
        </footer>
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
