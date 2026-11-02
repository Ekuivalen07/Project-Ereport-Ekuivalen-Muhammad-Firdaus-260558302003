<?php

namespace App\Livewire\Warga\Laporan;

use App\Livewire\WargaPage;
use App\Models\Laporan;
use App\Services\ComplaintManager;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Locked;

class Show extends WargaPage
{
    #[Locked]
    public int $laporanId;

    public function mount(Laporan $laporan): void
    {
        $this->authorize('view', $laporan);
        $this->laporanId = $laporan->id;
    }

    public function delete(): void
    {
        app(ComplaintManager::class)->delete($this->laporanId);
        session()->flash('success', 'Pengaduan berhasil dihapus.');
        $this->redirectRoute('warga.laporan.index');
    }

    public function render(): View
    {
        $laporan = Laporan::findOrFail($this->laporanId);
        $this->authorize('view', $laporan);

        return view('livewire.warga.laporan.show', compact('laporan'))->title('Detail Pengaduan');
    }
}
