<div>
    <span class="text-xs font-bold tracking-widest text-blue-600">SELAMAT DATANG KEMBALI</span>
    <h1 class="mt-3 font-display text-3xl font-bold tracking-tight">Masuk ke E-Report</h1>
    <p class="mt-3 text-sm text-slate-500">Lanjutkan langkah kecil untuk perubahan lingkungan.</p>

    <form wire:submit="login" class="mt-8 space-y-5">
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
            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
            <input
                type="password"
                id="password"
                wire:model="password"
                placeholder="Masukkan password"
                required
                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-50"
            >
            @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <label class="flex items-center gap-2.5 text-sm text-slate-600">
            <input type="checkbox" wire:model="remember" class="h-4 w-4 rounded accent-blue-600">
            Ingat saya di perangkat ini
        </label>

        <button
            type="submit"
            wire:loading.attr="disabled"
            class="w-full rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white shadow-sm shadow-blue-200 hover:bg-blue-700 disabled:opacity-60"
        >
            <span wire:loading.remove wire:target="login">Masuk ke Akun →</span>
            <span wire:loading wire:target="login">Memeriksa data...</span>
        </button>
    </form>

    <p class="mt-7 text-center text-sm text-slate-500">
        Belum punya akun?
        <a href="{{ route('register') }}" wire:navigate class="font-bold text-blue-600 hover:underline">Daftar sekarang</a>
    </p>
</div>
