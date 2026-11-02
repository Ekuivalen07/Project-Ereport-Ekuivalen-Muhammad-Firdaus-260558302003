<?php

namespace App\Livewire\Warga;

use App\Livewire\WargaPage;
use App\Models\Laporan;
use Illuminate\Contracts\View\View;

class Dashboard extends WargaPage
{
    public function render(): View
    {
        $query = auth()->user()->laporans();

        $counts = (clone $query)
            ->selectRaw('status, count(*) as jumlah')
            ->groupBy('status')
            ->pluck('jumlah', 'status');

        $stats = array_map(
            fn ($status) => (int) ($counts[$status] ?? 0),
            array_combine(array_keys(Laporan::STATUSES), array_keys(Laporan::STATUSES))
        );

        $total = array_sum($stats);
        $recent = $query->latest()->orderByDesc('id')->limit(5)->get();

        return view('livewire.warga.dashboard', compact('stats', 'total', 'recent'))->title('Dashboard Warga');
    }
}
