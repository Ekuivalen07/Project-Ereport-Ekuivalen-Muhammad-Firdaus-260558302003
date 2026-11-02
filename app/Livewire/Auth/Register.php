<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth')]
class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $no_whatsapp = '';
    public string $alamat = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        // Proteksi spam pendaftaran: maks 10 percobaan per IP per jam
        $throttleKey = 'register:' . request()->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 10)) {
            throw ValidationException::withMessages([
                'email' => 'Terlalu banyak pendaftaran dari perangkat ini. Silakan coba lagi nanti.',
            ]);
        }

        $this->email = Str::lower(trim($this->email));

        $validated = $this->validate([
            'name'        => 'required|string|max:100',
            'email'       => 'required|email|max:255|unique:users,email',
            'no_whatsapp' => ['required', 'regex:/^\+?[0-9]{9,15}$/'],
            'alamat'      => 'required|string|max:2000',
            'password'    => ['required', 'string', 'max:255', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        RateLimiter::hit($throttleKey, 3600);

        // Pengunjung yang mendaftar selalu ditetapkan memiliki peran warga
        $user = new User($validated);
        $user->role = 'warga';
        $user->save();

        Auth::login($user);
        session()->regenerate();

        $this->redirectRoute('warga.dashboard');
    }

    public function render(): View
    {
        return view('livewire.auth.register')->title('Daftar Akun Warga');
    }
}
