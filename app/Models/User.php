<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'no_whatsapp', 'alamat', 'foto'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    // /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Nilai default atribut saat instansiasi model.
     */
    protected $attributes = [
        'role' => 'warga',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function laporans(): HasMany
    {
        return $this->hasMany(Laporan::class, 'pelapor_id');
    }

    public function dashboardRoute(): string
    {
        return $this->role === 'admin' ? 'admin.dashboard' : 'warga.dashboard';
    }
}
