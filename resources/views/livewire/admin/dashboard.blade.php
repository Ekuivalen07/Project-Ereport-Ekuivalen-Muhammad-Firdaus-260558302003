<div wire:poll.30s>
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Dashboard Administrator</h1>
            <p class="mt-2 text-sm leading-relaxed text-slate-500">Pantau pengaduan dan tindak lanjuti kebutuhan warga.</p>
        </div>
        <a
            href="{{ route('admin.laporan.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-bold transition bg-blue-600 text-white shadow-sm shadow-blue-200 hover:bg-blue-700"
        >
            Kelola Pengaduan
            <i data-lucide="arrow-right" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
        </a>
    </div>
    {{-- Ringkasan dari data yang dikirim oleh class Livewire --}}
    <div class="mb-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
        <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-slate-500">Total Pengaduan</span>
                <span class="rounded-xl p-2.5 bg-slate-100 text-slate-600">
                    <i data-lucide="files" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-bold tracking-tight">{{ number_format($total) }}</p>
            <p class="mt-2 text-xs text-slate-400">Pengaduan tercatat</p>
        </div>
        <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-slate-500">Menunggu</span>
                <span class="rounded-xl p-2.5 bg-amber-50 text-amber-600">
                    <i data-lucide="clock-3" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-bold tracking-tight">{{ number_format($stats['pending']) }}</p>
            <p class="mt-2 text-xs text-slate-400">Pengaduan tercatat</p>
        </div>
        <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-slate-500">Sedang Diproses</span>
                <span class="rounded-xl p-2.5 bg-blue-50 text-blue-600">
                    <i data-lucide="loader-circle" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-bold tracking-tight">{{ number_format($stats['proses']) }}</p>
            <p class="mt-2 text-xs text-slate-400">Pengaduan tercatat</p>
        </div>
        <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-slate-500">Selesai</span>
                <span class="rounded-xl p-2.5 bg-emerald-50 text-emerald-600">
                    <i data-lucide="circle-check" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-bold tracking-tight">{{ number_format($stats['selesai']) }}</p>
            <p class="mt-2 text-xs text-slate-400">Pengaduan tercatat</p>
        </div>
        <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-slate-500">Warga Terdaftar</span>
                <span class="rounded-xl p-2.5 bg-violet-50 text-violet-600">
                    <i data-lucide="users" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-bold tracking-tight">{{ number_format($citizens) }}</p>
            <p class="mt-2 text-xs text-slate-400">Akun warga aktif</p>
        </div>
    </div>
    <div class="mb-8 grid gap-6 lg:grid-cols-[1.4fr_1fr]">
        <section class="rounded-2xl border border-slate-200 bg-white p-6">
            <h2 class="font-display font-bold">Ringkasan Status Pengaduan</h2>
            <p class="mt-1 text-xs text-slate-400">Distribusi seluruh pengaduan yang masuk</p>
            <div class="mt-7 space-y-6">
                @foreach(\App\Models\Laporan::STATUSES as $status => $label)
                    <div>
                        <div class="mb-2 flex justify-between text-xs">
                            <span class="text-slate-500">{{ $label }}</span>
                            <span class="font-bold">
                                {{ $stats[$status] }}
                                <span class="ml-2 font-normal text-slate-400">( {{ $total ? round($stats[$status] / $total * 100) : 0 }} %)</span>
                            </span>
                        </div>
                        <div class="h-2.5 overflow-hidden rounded-full bg-slate-100" role="meter" aria-label="{{ $label }}" aria-valuenow="{{ $stats[$status] }}" aria-valuemin="0" aria-valuemax="{{ max(1, $total) }}">
                            <div @class(['h-full rounded-full', 'bg-amber-400' => $status === 'pending', 'bg-blue-500' => $status === 'proses', 'bg-emerald-500' => $status === 'selesai']) style="width: {{ $total ? $stats[$status] / $total * 100 : 0 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="flex flex-col justify-between rounded-2xl bg-blue-950 p-7 text-white">
            <span class="mb-5 inline-flex w-fit rounded-xl bg-white/10 p-3 text-blue-200">
                <i data-lucide="clipboard-list" aria-hidden="true" class="h-7 w-7 shrink-0"></i>
            </span>
            <div>
                <p class="font-display text-xl font-bold">{{ $stats['pending'] }} pengaduan menunggu</p>
                <p class="mt-3 text-sm leading-7 text-blue-200">Tinjau laporan yang masuk dan mulai penanganan untuk membantu warga.</p>
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-white">
                Tinjau pengaduan
                <i data-lucide="arrow-right" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
            </a>
        </section>
    </div>
    {{-- Pengaduan terbaru --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xs">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-6 py-5">
            <div>
                <h2 class="font-display font-bold">Pengaduan Terbaru</h2>
                <p class="mt-1 text-xs text-slate-400">Perkembangan terbaru dari pengaduan warga</p>
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-blue-600">
                Lihat semua
                <i data-lucide="arrow-right" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
            </a>
        </div>
        @if($recent->isEmpty())
            <div class="px-6 py-16 text-center">
                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                    <i data-lucide="inbox" aria-hidden="true" class="h-8 w-8 shrink-0"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-slate-800">Belum ada pengaduan</h3>
                <p class="mx-auto mt-2 max-w-sm text-sm leading-relaxed text-slate-500">Pengaduan dari warga akan muncul di sini.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[580px] text-left text-sm">
                    <thead class="bg-slate-50/70 text-xs text-slate-400">
                        <tr>
                            <th class="px-6 py-3 font-medium">Pengaduan</th>
                            <th class="px-4 py-3 font-medium">Pelapor</th>
                            <th class="px-4 py-3 font-medium">Tanggal Pengajuan</th>
                            <th class="px-4 py-3 font-medium">Status</th>
                            <th class="px-6 py-3 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($recent as $laporan)
                            <tr class="hover:bg-slate-50/60">
                                <td class="max-w-xs px-6 py-5">
                                    <p class="truncate font-semibold text-slate-800">{{ $laporan->judul }}</p>
                                    <p class="mt-1 text-xs text-slate-400"># {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</p>
                                </td>
                                <td class="px-4 py-5 text-slate-500">{{ $laporan->pelapor->name }}</td>
                                <td class="px-4 py-5 text-xs text-slate-500">{{ $laporan->created_at->translatedFormat('d M Y') }}</td>
                                <td class="px-4 py-5">
                                    <span @class([
                                    'inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-3 py-1.5 text-xs font-semibold',
                                    'bg-amber-50 text-amber-800 ring-1 ring-inset ring-amber-200' => $laporan->status === 'pending',
                                    'bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-200' => $laporan->status === 'proses',
                                    'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-200' => $laporan->status === 'selesai',
                                    ])>
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ \App\Models\Laporan::STATUSES[$laporan->status] ?? $laporan->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <a
                                        href="{{ route('admin.laporan.show', $laporan) }}"
                                        class="inline-flex items-center gap-1 text-xs font-bold text-blue-600"
                                    >
                                        Detail
                                        <i data-lucide="arrow-up-right" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
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
