<?php

namespace App\Models;

// use Database\Factories\LaporanFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['judul', 'detail', 'tanggal', 'foto'])]
class Laporan extends Model
{
    // /** @use HasFactory<LaporanFactory> */
    use HasFactory;

    public const STATUSES = [
        'pending' => 'Menunggu',
        'proses'  => 'Sedang Diproses',
        'selesai' => 'Selesai',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }

    public function statusDescription(): string
    {
        return match ($this->status) {
            'proses'  => 'Pengaduan sedang ditindaklanjuti.',
            'selesai' => 'Pengaduan telah selesai ditangani.',
            default   => 'Pengaduan menunggu peninjauan admin.',
        };
    }
}
