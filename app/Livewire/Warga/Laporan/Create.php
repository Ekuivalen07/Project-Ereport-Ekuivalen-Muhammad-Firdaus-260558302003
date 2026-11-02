<?php

namespace App\Livewire\Warga\Laporan;

use App\Livewire\ComplaintForm;
use App\Models\Laporan;
use App\Support\StoredImage;
use Illuminate\Contracts\View\View;

class Create extends ComplaintForm
{
    public function mount(): void
    {
        // Tanggal default hari ini
        $this->tanggal = today()->format('Y-m-d');
    }

    public function save(): void
    {
        $this->authorize('create', Laporan::class);

        $data = $this->validatedData();

        try {
            $laporan = new Laporan($data);
            $laporan->pelapor()->associate(auth()->user());
            $laporan->status = 'pending';
            $laporan->save();
        } catch (\Throwable $e) {
            // Bersihkan file yang sempat terunggah jika penyimpanan database gagal
            StoredImage::delete($data['foto'] ?? null, 'laporan');
            throw $e;
        }

        session()->flash('success', 'Pengaduan berhasil dikirim dan menunggu peninjauan.');

        // Sementara rute index/show disiapkan di part selanjutnya, redirect ke dashboard/index warga
        $this->redirectRoute('warga.laporan.index');
    }

    public function render(): View
    {
        return view('livewire.warga.laporan.create')->title('Buat Pengaduan Baru');
    }
}
