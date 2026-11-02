<?php

namespace App\Livewire\Admin;

use App\Livewire\AdminPage;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Contracts\View\View;

class Dashboard extends AdminPage
{
    public function render(): View
    {
        $counts = Laporan::query()->selectRaw('status, count(*) as jumlah')->groupBy('status')->pluck('jumlah', 'status');
        $stats = array_map(fn ($status) => (int) ($counts[$status] ?? 0), array_combine(array_keys(Laporan::STATUSES), array_keys(Laporan::STATUSES)));
        $total = array_sum($stats);
        $citizens = User::where('role', 'warga')->count();
        $recent = Laporan::with('pelapor')->latest()->orderByDesc('id')->limit(5)->get();

        return view('livewire.admin.dashboard', compact('stats', 'total', 'citizens', 'recent'))->title('Dashboard Admin');
    }
}
