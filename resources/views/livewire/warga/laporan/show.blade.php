<div wire:poll.15s>
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Detail Pengaduan</h1>
            <p class="mt-2 text-sm leading-relaxed text-slate-500">Pantau proses tindak lanjut penanganan laporan Anda.</p>
        </div>
        <a href="{{ route('warga.laporan.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
            <i data-lucide="arrow-left" class="h-4 w-4"></i>
            Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
            <i data-lucide="circle-check" class="h-5 w-5 shrink-0 text-emerald-600"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid items-start gap-6 lg:grid-cols-[1fr_310px]">
        <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xs">
            <div class="border-b border-slate-100 p-6 sm:p-8">
                <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                    <span class="text-xs font-bold tracking-wider text-slate-400">PENGADUAN # {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</span>
                    <span @class([
                        'inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-3 py-1.5 text-xs font-semibold',
                        'bg-amber-50 text-amber-800 ring-1 ring-inset ring-amber-200' => $laporan->status === 'pending',
                        'bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-200' => $laporan->status === 'proses',
                        'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-200' => $laporan->status === 'selesai',
                    ])>
                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                        {{ \App\Models\Laporan::STATUSES[$laporan->status] ?? $laporan->status }}
                    </span>
                </div>
                <h2 class="font-display text-2xl font-bold text-slate-900 break-words">{{ $laporan->judul }}</h2>
                <div class="mt-4 flex flex-wrap gap-6 text-xs text-slate-500">
                    <span class="flex items-center gap-1.5">
                        <i data-lucide="calendar" class="h-4 w-4 text-slate-400"></i>
                        Kejadian: <strong>{{ $laporan->tanggal->translatedFormat('d F Y') }}</strong>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <i data-lucide="clock" class="h-4 w-4 text-slate-400"></i>
                        Diajukan: {{ $laporan->created_at->translatedFormat('d M Y, H:i') }}
                    </span>
                </div>
            </div>
            <div class="p-6 sm:p-8 space-y-6">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 mb-2">Deskripsi Pengaduan</h3>
                    <p class="text-sm leading-7 text-slate-600 whitespace-pre-line">{{ $laporan->detail }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Foto Bukti</h3>
                    @if($laporan->foto)
                        <a href="{{ Storage::disk('public')->url($laporan->foto) }}" target="_blank" rel="noopener">
                            <img src="{{ Storage::disk('public')->url($laporan->foto) }}" class="max-h-96 rounded-xl border border-slate-100 object-contain">
                        </a>
                        <p class="mt-1 text-xs text-slate-400">Klik gambar untuk melihat resolusi penuh.</p>
                    @else
                        <div class="rounded-xl bg-slate-50 p-4 text-xs text-slate-400 flex items-center gap-2">
                            <i data-lucide="image" class="h-4 w-4"></i>
                            Tidak ada foto bukti yang dilampirkan.
                        </div>
                    @endif
                </div>
            </div>
        </article>

        <!-- Sidebar Status & Tindakan -->
        <aside class="space-y-5">
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xs">
                <h3 class="font-display font-bold text-slate-900 mb-4">Progres Penanganan</h3>
                <div class="space-y-5">
                    @foreach(['pending' => ['clock-3', 'Menunggu Peninjauan'], 'proses' => ['loader-circle', 'Sedang Diproses'], 'selesai' => ['circle-check', 'Selesai Ditangani']] as $status => [$icon, $label])
                        @php $reached = array_search($laporan->status, ['pending','proses','selesai']) >= $loop->index; @endphp
                        <div class="flex items-center gap-3">
                            <span @class(['flex h-8 w-8 shrink-0 items-center justify-center rounded-full', 'bg-blue-50 text-blue-600' => $reached, 'bg-slate-50 text-slate-300' => !$reached])>
                                <i data-lucide="{{ $icon }}" class="h-4 w-4"></i>
                            </span>
                            <div>
                                <p @class(['text-xs font-semibold', 'text-slate-800' => $reached, 'text-slate-400' => !$reached])>{{ $label }}</p>
                                @if($laporan->status === $status)
                                    <span class="text-[10px] font-bold text-blue-600">Tahap saat ini</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <p class="mt-5 rounded-xl bg-slate-50 p-3.5 text-xs text-slate-500 leading-relaxed">{{ $laporan->statusDescription() }}</p>
            </section>

            @can('update', $laporan)
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xs space-y-3">
                    <h3 class="font-display text-sm font-bold text-slate-900">Kelola Laporan</h3>
                    <p class="text-xs text-slate-400">Pengaduan masih berstatus menunggu dan dapat diperbarui atau dibatalkan.</p>
                    <a href="{{ route('warga.laporan.edit', $laporan) }}" class="flex items-center justify-center gap-2 w-full rounded-xl border border-slate-200 bg-white py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-50">
                        <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
                        Edit Pengaduan
                    </a>
                    <button
                        wire:click="delete"
                        wire:confirm="Hapus pengaduan beserta foto buktinya? Tindakan ini tidak dapat dibatalkan."
                        class="flex items-center justify-center gap-2 w-full rounded-xl border border-red-200 bg-red-50 py-2.5 text-xs font-bold text-red-700 hover:bg-red-100"
                    >
                        <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                        Hapus Pengaduan
                    </button>
                </section>
            @endcan
        </aside>
    </div>
</div>
