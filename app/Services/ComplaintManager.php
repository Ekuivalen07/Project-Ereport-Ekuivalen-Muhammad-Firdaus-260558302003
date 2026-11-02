<?php

namespace App\Services;

use App\Models\Laporan;
use App\Support\StoredImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class ComplaintManager
{
    public function update(int $id, array $data): Laporan
    {
        $oldPhoto = null;
        try {
            $laporan = DB::transaction(function () use ($id, $data, &$oldPhoto): Laporan {
                $laporan = Laporan::query()->lockForUpdate()->findOrFail($id);
                Gate::authorize('update', $laporan);
                $oldPhoto = $laporan->foto;
                $laporan->update($data);

                return $laporan;
            });
        } catch (\Throwable $exception) {
            if (isset($data['foto'])) {
                StoredImage::delete($data['foto'], 'laporan');
            }
            throw $exception;
        }

        if (isset($data['foto']) && $oldPhoto !== $data['foto']) {
            StoredImage::delete($oldPhoto, 'laporan');
        }

        return $laporan;
    }

    public function delete(int $id): void
    {
        $photo = DB::transaction(function () use ($id): ?string {
            $laporan = Laporan::query()->lockForUpdate()->findOrFail($id);
            Gate::authorize('delete', $laporan);
            $photo = $laporan->foto;
            $laporan->delete();

            return $photo;
        });

        StoredImage::delete($photo, 'laporan');
    }

    public function transition(int $id, string $status): void
    {
        DB::transaction(function () use ($id, $status): void {
            $laporan = Laporan::query()->lockForUpdate()->findOrFail($id);
            Gate::authorize('changeStatus', $laporan);

            $next = match ($laporan->status) {
                'pending' => 'proses',
                'proses'  => 'selesai',
                default   => null,
            };

            if ($next === null || $status !== $next) {
                throw ValidationException::withMessages([
                    'status' => 'Perubahan status tidak diizinkan. Ikuti urutan penanganan pengaduan.',
                ]);
            }

            $laporan->status = $status;
            $laporan->save();
        });
    }
}
