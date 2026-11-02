<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('ereport.admin_email');
        $password = config('ereport.admin_password');

        Validator::make(
            compact('email', 'password'),
            [
                'email'    => 'required|email',
                'password' => ['required', 'string', Password::min(12)->letters()->mixedCase()->numbers()->symbols()],
            ],
            ['password.required' => 'Isi ADMIN_PASSWORD pada .env sebelum menjalankan seeder admin.']
        )->validate();

        if (User::where('email', $email)->exists()) {
            $this->command?->warn('Email admin sudah terdaftar. Seeder dilewati.');
            return;
        }

        $user = new User([
            'name'        => 'Administrator E-Report',
            'email'       => $email,
            'password'    => $password,
            'no_whatsapp' => '081234567890',
            'alamat'      => 'Kantor Pengelola E-Report',
        ]);
        $user->role = 'admin';
        $user->save();
    }
}
