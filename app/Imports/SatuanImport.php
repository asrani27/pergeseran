<?php

namespace App\Imports;

use App\Models\Satuan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SatuanImport implements ToModel, WithStartRow
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
        try {
            $check = Satuan::where('nama', $row[1])->first();
            if ($check == null) {
                return new Satuan([
                    'nama'             => $row[1] ?? null,
                ]);
            }
        } catch (\Throwable $e) {
            Log::error("Error pada baris: " . json_encode($row) . " | Pesan: " . $e->getMessage());
            return null; // Melewati data yang error
        }
    }
}
