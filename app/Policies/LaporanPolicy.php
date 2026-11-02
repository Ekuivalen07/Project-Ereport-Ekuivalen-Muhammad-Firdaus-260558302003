<?php

namespace App\Policies;

use App\Models\Laporan;
use App\Models\User;

class LaporanPolicy
{
    public function view(User $user, Laporan $laporan): bool
    {
        return $user->role === 'admin' || ($user->role === 'warga' && $user->id === $laporan->pelapor_id);
    }

    public function create(User $user): bool
    {
        return $user->role === 'warga';
    }

    public function update(User $user, Laporan $laporan): bool
    {
        return $user->role === 'warga'
            && $user->id === $laporan->pelapor_id
            && $laporan->status === 'pending';
    }

    public function delete(User $user, Laporan $laporan): bool
    {
        return $this->update($user, $laporan);
    }

    public function changeStatus(User $user, Laporan $laporan): bool
    {
        return $user->role === 'admin';
    }
}
