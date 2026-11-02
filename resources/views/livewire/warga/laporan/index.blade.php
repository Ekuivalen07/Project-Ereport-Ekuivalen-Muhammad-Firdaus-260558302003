<div>
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Pengaduan Saya</h1>
            <p class="mt-2 text-sm leading-relaxed text-slate-500">Semua pengaduan dan status penanganannya.</p>
        </div>
        <a
            href="{{ route('warga.laporan.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white shadow-sm shadow-blue-200 hover:bg-blue-700"
        >
            <i data-lucide="plus" class="h-4 w-4"></i>
            Buat Pengaduan
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
            <i data-lucide="circle-check" class="h-5 w-5 shrink-0 text-emerald-600"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Search & Filter -->
    <div class="mb-5 flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4 sm:flex-row shadow-xs">
        <div class="relative flex-1">
            <span class="pointer-events-none absolute top-3.5 left-3 text-slate-400">
                <i data-lucide="search" class="h-4 w-4"></i>
            </span>
            <input
                type="search"
                wire:model.live.debounce.350ms="search"
                placeholder="Cari judul pengaduan..."
                class="w-full rounded-xl border border-slate-200 py-2.5 pr-4 pl-10 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50"
            >
        </div>
        <div>
            <select wire:model.live="status" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-600 outline-none sm:w-48">
                <option value="">Semua Status</option>
                @foreach(\App\Models\Laporan::STATUSES as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Tabel Data Laporan -->
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xs">
        @if($laporans->isEmpty())
            <div class="px-6 py-16 text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                    <i data-lucide="inbox" class="h-7 w-7"></i>
                </div>
                <h3 class="font-display text-base font-bold text-slate-800">Belum ada pengaduan ditemukan</h3>
                <p class="mx-auto mt-1 max-w-sm text-xs leading-relaxed text-slate-500">Coba ubah kata kunci pencarian atau buat pengaduan baru.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[700px] text-left text-sm">
                    <thead class="bg-slate-50 text-xs text-slate-400">
                        <tr>
                            <th class="px-6 py-4 font-medium">Judul Pengaduan</th>
                            <th class="px-4 py-4 font-medium">Tanggal Kejadian</th>
                            <th class="px-4 py-4 font-medium">Tanggal Pengajuan</th>
                            <th class="px-4 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($laporans as $laporan)
                            <tr wire:key="laporan-{{ $laporan->id }}" class="hover:bg-slate-50/70">
                                <td class="max-w-xs px-6 py-4">
                                    <p class="text-xs font-bold text-slate-400"># {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</p>
                                    <a href="{{ route('warga.laporan.show', $laporan) }}" class="mt-0.5 block truncate font-semibold text-slate-800 hover:text-blue-600">
                                        {{ $laporan->judul }}
                                    </a>
                                </td>
                                <td class="px-4 py-4 text-xs text-slate-500">{{ $laporan->tanggal->translatedFormat('d M Y') }}</td>
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
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('warga.laporan.show', $laporan) }}" class="rounded-lg border border-slate-200 p-2 text-slate-500 hover:bg-blue-50 hover:text-blue-600" title="Detail">
                                            <i data-lucide="eye" class="h-4 w-4"></i>
                                        </a>
                                        @can('update', $laporan)
                                            <a href="{{ route('warga.laporan.edit', $laporan) }}" class="rounded-lg border border-slate-200 p-2 text-slate-500 hover:bg-blue-50 hover:text-blue-600" title="Edit">
                                                <i data-lucide="pencil" class="h-4 w-4"></i>
                                            </a>
                                            <button
                                                wire:click="delete({{ $laporan->id }})"
                                                wire:confirm="Hapus pengaduan ini? Tindakan ini tidak dapat dibatalkan."
                                                class="rounded-lg border border-slate-200 p-2 text-slate-500 hover:bg-red-50 hover:text-red-600"
                                                title="Hapus"
                                            >
                                                <i data-lucide="trash-2" class="h-4 w-4"></i>
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $laporans->links() }}
            </div>
        @endif
    </div>
</div>
