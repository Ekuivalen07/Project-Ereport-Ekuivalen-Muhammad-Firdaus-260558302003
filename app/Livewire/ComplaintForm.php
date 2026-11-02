<?php

namespace App\Livewire;

use Livewire\WithFileUploads;

abstract class ComplaintForm extends WargaPage
{
    use WithFileUploads;

    public string $judul = '';
    public string $detail = '';
    public string $tanggal = '';
    public $foto;

    protected function validatedData(): array
    {
        $data = $this->validate([
            'judul'   => 'required|string|max:255',
            'detail'  => 'required|string|max:10000',
            'tanggal' => 'required|date_format:Y-m-d|before_or_equal:today',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        unset($data['foto']);

        // Simpan foto ke disk 'public' di dalam direktori 'laporan'
        if ($this->foto) {
            $data['foto'] = $this->foto->store('laporan', 'public');
        }

        return $data;
    }
}
