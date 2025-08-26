<?php

namespace App\Imports;

use Log;
use App\Models\SSH;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class sshImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // // Debug isi baris pertama
        // Ambil baris ke-2 sampai ke-10292 (index dimulai dari 0)
        $rows = $rows->slice(1, 10291);

        // Jika sudah oke, lanjut simpan:
        foreach ($rows as $index => $row) {
            try {
                SSH::create([
                    'kode'   => $row['kode_barang'] ?? null,
                    'uraian' => $row['uraian_barang'] ?? null,
                    'spesifikasi'   => $row['spesifikasi'] ?? null,
                    'satuan'        => $row['satuan'] ?? null,
                    'harga'  => $row['harga_satuan'] ?? null,
                    'kode_rekening' => isset($row['kode_rekening'])
                        ? trim(explode(',', $row['kode_rekening'])[0])
                        : null,
                    'jenis'  => $row['jenis'] ?? null,
                ]);
            } catch (\Throwable $e) {
                Log::warning("Baris ke-" . ($index + 1) . " gagal diimpor: " . $e->getMessage());
                // Atau tampilkan di CLI (jika ingin kelihatan saat proses)
                echo "Gagal baris " . ($index + 1) . ": " . $e->getMessage() . "\n";
                continue;
            }
        }
    }
}
