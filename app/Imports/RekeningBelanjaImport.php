<?php

namespace App\Imports;

use App\Models\RekeningBelanja;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class RekeningBelanjaImport implements ToModel, WithCalculatedFormulas, WithStartRow
{
    /**
     * @param Collection $collection
     */
    public function startRow(): int
    {
        return 2; // Mulai dari baris ke-10
    }

    public function model(array $row)
    {
        dd('d');
        if (empty($row[4])) {
            return null; // Melewati data kosong
        }

        try {
            return new RekeningBelanja([
                'tahun'             => $row[1] ?? null,
                'kode_skpd'         => $row[4] ?? null, // Sesuaikan dengan urutan kolom dalam Excel
                'kode_program'      => $row[10] ?? null,
                'nama_program'      => $row[11] ?? null,
                'kode_kegiatan'     => $row[12] ?? null,
                'nama_kegiatan'     => $row[13] ?? null,
                'kode_subkegiatan'  => $row[14] ?? null,
                'nama_subkegiatan'  => $row[15] ?? null,
                'kode_rekening'     => $row[18] ?? null,
                'nama_rekening'     => $row[19] ?? null,
                'kode_ssh'          => $row[20] ?? null,
                'nama_ssh'          => $row[21] ?? null,
                'pagu'              => $row[22] ?? null,
            ]);
        } catch (\Throwable $e) {
            // Log error dan tampilkan informasi baris yang bermasalah
            Log::error("Error pada baris: " . json_encode($row) . " | Pesan: " . $e->getMessage());
            return null; // Melewati data yang error
        }
    }
}
