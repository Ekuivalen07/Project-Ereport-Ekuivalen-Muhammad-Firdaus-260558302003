<div>
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Profil Saya</h1>
            <p class="mt-2 text-sm leading-relaxed text-slate-500">Kelola identitas diri dan pengaturan keamanan akun.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
            <i data-lucide="circle-check" class="h-5 w-5 shrink-0 text-emerald-600"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid items-start gap-6 lg:grid-cols-[280px_1fr]">
        <!-- Kartu Identitas Ringkas -->
        <aside class="rounded-2xl border border-slate-200 bg-white p-7 text-center shadow-xs">
            @if(auth()->user()->foto)
                <img src="{{ Storage::disk('public')->url(auth()->user()->foto) }}" alt="Foto profil" class="mx-auto h-24 w-24 rounded-full object-cover border border-slate-100">
            @else
                <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-blue-50 font-display text-3xl font-bold text-blue-600">
                    {{ mb_substr(auth()->user()->name, 0, 1) }}
                </div>
            @endif

            <h2 class="mt-4 font-display font-bold text-slate-900 break-words">{{ auth()->user()->name }}</h2>
            <p class="mt-1 text-xs text-slate-400 break-words">{{ auth()->user()->email }}</p>
            <span class="mt-3 inline-flex rounded-full bg-blue-50 px-3.5 py-1 text-xs font-bold text-blue-700">Warga Terverifikasi</span>

            <dl class="mt-6 space-y-3.5 border-t border-slate-100 pt-5 text-left text-xs">
                <div>
                    <dt class="text-slate-400">Nomor WhatsApp</dt>
                    <dd class="mt-1 font-semibold text-slate-700">{{ auth()->user()->no_whatsapp ?: 'Belum diisi' }}</dd>
                </div>
                <div>
                    <dt class="text-slate-400">Alamat</dt>
                    <dd class="mt-1 font-semibold text-slate-700 break-words leading-relaxed">{{ auth()->user()->alamat ?: 'Belum diisi' }}</dd>
                </div>
            </dl>
        </aside>

        <!-- Formulir Perubahan Data -->
        <div class="space-y-6">
            <!-- Form Biodata -->
            <form wire:submit="updateProfile" class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xs">
                <h2 class="font-display text-base font-bold text-slate-900">Informasi Pribadi</h2>
                <div class="mt-5 space-y-5">
                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Nama Lengkap</label>
                        <input type="text" id="name" wire:model="name" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50">
                        @error('name') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                            <input type="email" value="{{ auth()->user()->email }}" disabled class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-400 cursor-not-allowed">
                            <p class="mt-1 text-[11px] text-slate-400">Alamat email bersifat permanen.</p>
                        </div>
                        <div>
                            <label for="no_whatsapp" class="mb-2 block text-sm font-semibold text-slate-700">Nomor WhatsApp</label>
                            <input type="tel" id="no_whatsapp" wire:model="no_whatsapp" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50">
                            @error('no_whatsapp') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="alamat" class="mb-2 block text-sm font-semibold text-slate-700">Alamat Domisili</label>
                        <textarea id="alamat" wire:model="alamat" rows="2" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50"></textarea>
                        @error('alamat') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="foto" class="mb-2 block text-sm font-semibold text-slate-700">Foto Profil (Opsional)</label>
                        <input type="file" id="foto" wire:model="foto" accept="image/jpeg,image/png,image/webp" class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-blue-50 file:px-3 file:py-1 file:text-xs file:font-semibold file:text-blue-700">
                        <div wire:loading wire:target="foto" class="mt-2 text-xs text-blue-600 font-semibold">Mengunggah foto...</div>
                        @error('foto') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end border-t border-slate-100 pt-5">
                    <button type="submit" wire:loading.attr="disabled" class="rounded-xl bg-blue-600 px-5 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-blue-700 disabled:opacity-60">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

            <!-- Form Ubah Password -->
            <form wire:submit="updatePassword" class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xs">
                <h2 class="font-display text-base font-bold text-slate-900">Ubah Password</h2>
                <p class="mt-1 text-xs text-slate-400">Gunakan kombinasi minimal 8 karakter dengan huruf dan angka.</p>

                @if(session('success_password'))
                    <div class="mt-4 flex items-center gap-2 rounded-xl bg-emerald-50 p-3 text-xs text-emerald-800">
                        <i data-lucide="circle-check" class="h-4 w-4 shrink-0 text-emerald-600"></i>
                        <span>{{ session('success_password') }}</span>
                    </div>
                @endif

                <div class="mt-5 space-y-4">
                    <div>
                        <label for="current_password" class="mb-1.5 block text-xs font-semibold text-slate-700">Password Saat Ini</label>
                        <input type="password" id="current_password" wire:model="current_password" required class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50">
                        @error('current_password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="password" class="mb-1.5 block text-xs font-semibold text-slate-700">Password Baru</label>
                            <input type="password" id="password" wire:model="password" required class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50">
                            @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="mb-1.5 block text-xs font-semibold text-slate-700">Konfirmasi Password Baru</label>
                            <input type="password" id="password_confirmation" wire:model="password_confirmation" required class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50">
                            @error('password_confirmation') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end border-t border-slate-100 pt-5">
                    <button type="submit" wire:loading.attr="disabled" class="rounded-xl bg-slate-900 px-5 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-slate-800 disabled:opacity-60">
                        Perbarui Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
