<div>
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Semua Pengaduan</h1>
            <p class="mt-2 text-sm leading-relaxed text-slate-500">Tinjau dan tindak lanjuti pengaduan yang disampaikan warga.</p>
        </div>
    </div>
    {{-- Pencarian dan filter pengaduan --}}
    <div class="mb-5 flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4 sm:flex-row">
        <div class="relative flex-1">
            <label for="search" class="sr-only">Cari pengaduan</label>
            <span class="pointer-events-none absolute top-3.5 left-3 text-slate-400">
                <i data-lucide="search" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
            </span>
            <input
                id="search"
                type="search"
                wire:model.live.debounce.350ms="search"
                placeholder="Cari judul atau nama pelapor…"
                class="w-full rounded-xl border border-slate-200 py-3 pr-4 pl-10 text-sm"
            >
        </div>
        <div>
            <label for="status" class="sr-only">Filter status</label>
            <select id="status" wire:model.live="status" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-600 sm:w-48">
                <option value="">Semua status</option>
                @foreach(\App\Models\Laporan::STATUSES as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="sort" class="sr-only">Urutan pengaduan</label>
            <select id="sort" wire:model.live="sort" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-600 sm:w-36">
                <option value="newest">Terbaru</option>
                <option value="oldest">Terlama</option>
            </select>
        </div>
        <span wire:loading role="status" class="self-center text-xs text-blue-600">Memuat…</span>
    </div>
    {{-- Tabel pengaduan dan pagination --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
        @if($laporans->isEmpty())
            <div class="px-6 py-16 text-center">
                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                    <i data-lucide="inbox" aria-hidden="true" class="h-8 w-8 shrink-0"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-slate-800">Belum ada pengaduan yang ditemukan</h3>
                <p class="mx-auto mt-2 max-w-sm text-sm leading-relaxed text-slate-500">Coba kata kunci atau filter lain. Pengaduan yang sesuai akan tampil di sini.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] text-left text-sm">
                    <thead class="bg-slate-50 text-xs text-slate-500">
                        <tr>
                            <th class="px-6 py-4 font-medium">ID / Judul Pengaduan</th>
                            <th class="px-4 py-4 font-medium">Pelapor</th>
                            <th class="px-4 py-4 font-medium">Tanggal Pengajuan</th>
                            <th class="px-4 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($laporans as $laporan)
                            <tr wire:key="laporan-{{ $laporan->id }}" class="hover:bg-slate-50/70">
                                <td class="max-w-xs px-6 py-5">
                                    <p class="text-[10px] font-bold tracking-wider text-slate-400"># {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</p>
                                    <a
                                        href="{{ route('admin.laporan.show', $laporan) }}"
                                        class="mt-1 block truncate font-semibold text-slate-800 hover:text-blue-600"
                                    >{{ $laporan->judul }}</a>
                                </td>
                                <td class="px-4 py-5 text-xs text-slate-500">{{ $laporan->pelapor->name }}</td>
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
                                <td class="px-6 py-5">
                                    <div class="flex justify-end gap-2">
                                        <a
                                            href="{{ route('admin.laporan.show', $laporan) }}"
                                            aria-label="Detail {{ $laporan->judul }}"
                                            title="Detail"
                                            class="rounded-lg border border-slate-200 p-2 text-slate-500 hover:bg-blue-50 hover:text-blue-600"
                                        >
                                            <i data-lucide="eye" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-100 px-6 py-4">
                @if($laporans->hasPages())
                    <nav role="navigation" aria-label="Halaman pengaduan" class="flex flex-wrap items-center justify-between gap-4 text-xs">
                        <p class="text-slate-500">Menampilkan {{ $laporans->firstItem() }} – {{ $laporans->lastItem() }} dari {{ $laporans->total() }} pengaduan</p>
                        <div class="flex items-center gap-3">
                            <button
                                type="button"
                                wire:click="previousPage('{{ $laporans->getPageName() }}')"
                                wire:loading.attr="disabled"
                                @disabled($laporans->onFirstPage())
                                class="rounded-lg border border-slate-200 px-3 py-2 text-slate-600 disabled:opacity-40"
                            >Sebelumnya</button>
                            <span class="font-bold text-blue-600">{{ $laporans->currentPage() }} / {{ $laporans->lastPage() }}</span>
                            <button
                                type="button"
                                wire:click="nextPage('{{ $laporans->getPageName() }}')"
                                wire:loading.attr="disabled"
                                @disabled(!$laporans->hasMorePages())
                                class="rounded-lg border border-slate-200 px-3 py-2 text-slate-600 disabled:opacity-40"
                            >Berikutnya</button>
                        </div>
                    </nav>
                @else
                    <p class="text-xs text-slate-400">{{ $laporans->total() }} pengaduan</p>
                @endif
            </div>
        @endif
    </div>
</div>
