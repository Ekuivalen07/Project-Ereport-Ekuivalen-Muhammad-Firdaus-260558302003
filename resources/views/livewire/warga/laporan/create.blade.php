<div>
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Buat Pengaduan</h1>
            <p class="mt-2 text-sm leading-relaxed text-slate-500">Sampaikan permasalahan di lingkungan sekitar Anda secara transparan.</p>
        </div>
    </div>

    <div class="grid items-start gap-6 lg:grid-cols-[1fr_320px]">
        <form wire:submit="save" class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xs">
            <h2 class="mb-6 font-display text-lg font-bold text-slate-900">Informasi Pengaduan</h2>

            <div class="space-y-6">
                <div>
                    <label for="judul" class="mb-2 block text-sm font-semibold text-slate-700">Judul Pengaduan</label>
                    <input
                        type="text"
                        id="judul"
                        wire:model="judul"
                        placeholder="Contoh: Lampu penerangan jalan mati di RW 04"
                        maxlength="255"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50"
                    >
                    <p class="mt-1.5 text-xs text-slate-400">Tulis ringkasan singkat inti masalah.</p>
                    @error('judul') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="detail" class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi Lengkap</label>
                    <textarea
                        id="detail"
                        wire:model="detail"
                        rows="5"
                        placeholder="Ceritakan kendala, patokan lokasi spesifik, dan dampaknya bagi warga..."
                        maxlength="10000"
                        required
                        class="min-h-32 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50"
                    ></textarea>
                    <p class="mt-1.5 text-xs text-slate-400">Jelaskan sedetail mungkin agar mudah ditindaklanjuti.</p>
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
                    <label for="foto" class="mb-2 block text-sm font-semibold text-slate-700">Foto Bukti (Opsional)</label>
                    <input
                        type="file"
                        id="foto"
                        wire:model="foto"
                        accept="image/jpeg,image/png,image/webp"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-blue-50 file:px-3 file:py-1.5 file:font-medium file:text-blue-700"
                    >
                    <p class="mt-2 text-xs text-slate-400">Format: JPG, PNG, atau WebP (Maksimal 2 MB).</p>

                    <div wire:loading wire:target="foto" class="mt-3 flex items-center gap-2 text-xs font-semibold text-blue-600">
                        <i data-lucide="loader" class="h-4 w-4 animate-spin"></i>
                        Mengunggah pratinjau gambar...
                    </div>

                    @if ($foto)
                        <div class="mt-4">
                            <p class="text-xs font-medium text-slate-500 mb-2">Pratinjau Foto:</p>
                            <img src="{{ $foto->temporaryUrl() }}" class="h-36 rounded-lg object-cover border border-slate-200">
                        </div>
                    @endif

                    @error('foto') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-8 flex flex-wrap justify-end gap-3 border-t border-slate-100 pt-6">
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="save,foto"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white shadow-sm shadow-blue-200 hover:bg-blue-700 disabled:opacity-60"
                >
                    <span wire:loading.remove wire:target="save">Kirim Pengaduan →</span>
                    <span wire:loading wire:target="save">Menyimpan laporan...</span>
                </button>
            </div>
        </form>

        <aside class="rounded-2xl border border-blue-100 bg-blue-50/60 p-6">
            <h3 class="font-display font-bold text-blue-950 flex items-center gap-2">
                <i data-lucide="lightbulb" class="h-5 w-5 text-blue-600"></i>
                Panduan Pengaduan
            </h3>
            <ul class="mt-4 space-y-3.5 text-xs leading-5 text-slate-600">
                <li class="flex items-start gap-2">
                    <span class="text-blue-600 font-bold">•</span>
                    <span>Tuliskan alamat dan titik lokasi spesifik agar mudah disurvei.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-blue-600 font-bold">•</span>
                    <span>Sertakan foto bukti yang jelas untuk mempercepat proses verifikasi petugas.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-blue-600 font-bold">•</span>
                    <span>Gunakan kalimat yang sopan dan tidak mengandung unsur provokasi.</span>
                </li>
            </ul>
        </aside>
    </div>
</div>
