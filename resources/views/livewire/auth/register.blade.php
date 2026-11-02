<div>
    <span class="text-xs font-bold tracking-widest text-blue-600">MULAI PERUBAHAN DARI SINI</span>
    <h1 class="mt-3 font-display text-3xl font-bold tracking-tight">Buat akun warga</h1>
    <p class="mt-3 text-sm text-slate-500">Satu akun untuk menyampaikan dan memantau pengaduan.</p>

    <form wire:submit="register" class="mt-7 space-y-4">
        <div>
            <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Nama lengkap</label>
            <input
                type="text"
                id="name"
                wire:model="name"
                placeholder="Nama sesuai identitas"
                required
                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50"
            >
            @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                <input
                    type="email"
                    id="email"
                    wire:model="email"
                    placeholder="nama@email.com"
                    required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50"
                >
                @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="no_whatsapp" class="mb-2 block text-sm font-semibold text-slate-700">Nomor WhatsApp</label>
                <input
                    type="tel"
                    id="no_whatsapp"
                    wire:model="no_whatsapp"
                    placeholder="08xxxxxxxxxx"
                    required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50"
                >
                @error('no_whatsapp') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="alamat" class="mb-2 block text-sm font-semibold text-slate-700">Alamat</label>
            <textarea
                id="alamat"
                wire:model="alamat"
                placeholder="Alamat domisili lengkap..."
                rows="2"
                required
                class="min-h-24 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50"
            ></textarea>
            @error('alamat') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
            <input
                type="password"
                id="password"
                wire:model="password"
                required
                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50"
            >
            <p class="mt-1 text-xs text-slate-400">Minimal 8 karakter, mengandung huruf dan angka.</p>
            @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">Konfirmasi password</label>
            <input
                type="password"
                id="password_confirmation"
                wire:model="password_confirmation"
                required
                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50"
            >
            @error('password_confirmation') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button
            type="submit"
            wire:loading.attr="disabled"
            class="w-full rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white shadow-sm shadow-blue-200 hover:bg-blue-700 disabled:opacity-60"
        >
            <span wire:loading.remove wire:target="register">Daftar & Mulai Melapor →</span>
            <span wire:loading wire:target="register">Mendaftarkan akun...</span>
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        Sudah punya akun?
        <a href="{{ route('login') }}" wire:navigate class="font-bold text-blue-600 hover:underline">Masuk di sini</a>
    </p>
</div>
