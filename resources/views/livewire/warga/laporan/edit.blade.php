<div>
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Edit Pengaduan</h1>
            <p class="mt-2 text-sm leading-relaxed text-slate-500">Perubahan hanya dapat disimpan selama laporan belum diproses oleh petugas.</p>
        </div>
    </div>

    <form wire:submit="save" class="max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xs">
        <div class="space-y-6">
            <div>
                <label for="judul" class="mb-2 block text-sm font-semibold text-slate-700">Judul Pengaduan</label>
                <input
                    type="text"
                    id="judul"
                    wire:model="judul"
                    required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50"
                >
                @error('judul') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="detail" class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi Lengkap</label>
                <textarea
                    id="detail"
                    wire:model="detail"
                    rows="6"
                    required
                    class="min-h-32 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50"
                ></textarea>
                @error('detail') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="tanggal" class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Kejadian</label>
                <input
                    type="date"
                    id="tanggal"
                    wire:model="tanggal"
                    max="{{ today()->format('Y-m-d') }}"
                    required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50"
                >
                @error('tanggal') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-5">
                <label for="foto" class="mb-2 block text-sm font-semibold text-slate-700">Ganti Foto Bukti (Opsional)</label>
                <input
                    type="file"
                    id="foto"
                    wire:model="foto"
                    accept="image/jpeg,image/png,image/webp"
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-blue-50 file:px-3 file:py-1.5 file:font-medium file:text-blue-700"
                >
                @if($laporan->foto)
                    <div class="mt-3">
                        <p class="text-xs text-slate-400 mb-1">Foto saat ini:</p>
                        <img src="{{ Storage::disk('public')->url($laporan->foto) }}" class="h-28 rounded-lg object-cover border border-slate-200">
                    </div>
                @endif
                @error('foto') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3 border-t border-slate-100 pt-6">
            <a href="{{ route('warga.laporan.show', $laporan) }}" class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50">Batal</a>
            <button
                type="submit"
                wire:loading.attr="disabled"
                class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-blue-700 disabled:opacity-60"
            >
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
