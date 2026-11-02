<div wire:poll.30s>
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Selamat Datang, {{ auth()->user()->name }}!
            </h1>
            <p class="mt-2 text-sm leading-relaxed text-slate-500">Terima kasih telah peduli. Mari wujudkan lingkungan yang lebih baik.</p>
        </div>
        <a
            href="{{ route('warga.laporan.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white shadow-sm shadow-blue-200 hover:bg-blue-700"
        >
            <i data-lucide="plus" class="h-4 w-4"></i>
            Buat Pengaduan
        </a>
    </div>

    <!-- Ringkasan Statistik Status -->
    <div class="mb-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-slate-500">Total Pengaduan</span>
                <span class="rounded-xl bg-slate-100 p-2.5 text-slate-600">
                    <i data-lucide="files" class="h-5 w-5"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-bold tracking-tight">{{ number_format($total) }}</p>
            <p class="mt-2 text-xs text-slate-400">Pengaduan tercatat</p>
        </div>

        <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-slate-500">Menunggu</span>
                <span class="rounded-xl bg-amber-50 p-2.5 text-amber-600">
                    <i data-lucide="clock-3" class="h-5 w-5"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-bold tracking-tight">{{ number_format($stats['pending']) }}</p>
            <p class="mt-2 text-xs text-slate-400">Pengaduan diajukan</p>
        </div>

        <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-slate-500">Sedang Diproses</span>
                <span class="rounded-xl bg-blue-50 p-2.5 text-blue-600">
                    <i data-lucide="loader-circle" class="h-5 w-5"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-bold tracking-tight">{{ number_format($stats['proses']) }}</p>
            <p class="mt-2 text-xs text-slate-400">Dalam penanganan</p>
        </div>

        <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-slate-500">Selesai</span>
                <span class="rounded-xl bg-emerald-50 p-2.5 text-emerald-600">
                    <i data-lucide="circle-check" class="h-5 w-5"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-bold tracking-tight">{{ number_format($stats['selesai']) }}</p>
            <p class="mt-2 text-xs text-slate-400">Laporan diselesaikan</p>
        </div>
    </div>

    <!-- Banner Aksi Cepat -->
    <div class="mb-8 flex flex-col gap-6 rounded-2xl border border-blue-100 bg-blue-50/70 p-6 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-start gap-4">
            <span class="hidden rounded-xl bg-white p-3 text-blue-600 sm:inline-flex shadow-xs">
                <i data-lucide="megaphone" class="h-7 w-7"></i>
            </span>
            <div>
                <h2 class="font-display font-bold text-blue-950">Lihat masalah di sekitar Anda?</h2>
                <p class="mt-2 max-w-xl text-sm leading-6 text-blue-800/70">Jalan rusak, fasilitas umum rusak, atau sampah menumpuk. Laporkan segera agar petugas dapat bertindak.</p>
            </div>
        </div>
        <a href="{{ route('warga.laporan.create') }}" class="inline-flex shrink-0 items-center gap-2 text-sm font-bold text-blue-600 hover:underline">
            Sampaikan sekarang
            <i data-lucide="arrow-right" class="h-4 w-4"></i>
        </a>
    </div>

    <!-- Riwayat Pengaduan Terbaru -->
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xs">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-6 py-5">
            <div>
                <h2 class="font-display font-bold text-slate-900">Pengaduan Terbaru</h2>
                <p class="mt-1 text-xs text-slate-400">Perkembangan terbaru dari pengaduan Anda</p>
            </div>
            <a href="{{ route('warga.laporan.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:underline">
                Lihat semua
                <i data-lucide="arrow-right" class="h-3.5 w-3.5"></i>
            </a>
        </div>

        @if($recent->isEmpty())
            <div class="px-6 py-16 text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                    <i data-lucide="inbox" class="h-7 w-7"></i>
                </div>
                <h3 class="font-display text-base font-bold text-slate-800">Belum ada pengaduan</h3>
                <p class="mx-auto mt-1 max-w-sm text-xs leading-relaxed text-slate-500">Ada masalah di lingkungan sekitar? Sampaikan pengaduan pertama Anda.</p>
                <div class="mt-5">
                    <a
                        href="{{ route('warga.laporan.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-blue-700"
                    >
                        <i data-lucide="plus" class="h-3.5 w-3.5"></i>
                        Buat Pengaduan
                    </a>
                </div>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[580px] text-left text-sm">
                    <thead class="bg-slate-50/70 text-xs text-slate-400">
                        <tr>
                            <th class="px-6 py-3.5 font-medium">Pengaduan</th>
                            <th class="px-4 py-3.5 font-medium">Tanggal Pengajuan</th>
                            <th class="px-4 py-3.5 font-medium">Status</th>
                            <th class="px-6 py-3.5 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($recent as $laporan)
                            <tr class="hover:bg-slate-50/60">
                                <td class="max-w-xs px-6 py-4">
                                    <p class="truncate font-semibold text-slate-800">{{ $laporan->judul }}</p>
                                    <p class="mt-0.5 text-xs text-slate-400"># {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</p>
                                </td>
                                <td class="px-4 py-4 text-xs text-slate-500">{{ $laporan->created_at->translatedFormat('d M Y') }}</td>
                                <td class="px-4 py-4">
                                    <span @class([
                                        'inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-2.5 py-1 text-xs font-semibold',
                                        'bg-amber-50 text-amber-800 ring-1 ring-inset ring-amber-200' => $laporan->status === 'pending',
                                        'bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-200' => $laporan->status === 'proses',
                                        'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-200' => $laporan->status === 'selesai',
                                    ])>
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ \App\Models\Laporan::STATUSES[$laporan->status] ?? $laporan->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a
                                        href="{{ route('warga.laporan.show', $laporan) }}"
                                        class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:underline"
                                    >
                                        Detail
                                        <i data-lucide="arrow-up-right" class="h-3.5 w-3.5"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
