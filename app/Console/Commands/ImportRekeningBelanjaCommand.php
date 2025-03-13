<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RekeningBelanjaImport;

class ImportRekeningBelanjaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importrekeningbelanja';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filePath = public_path('excel/rekeningbelanja2.xlsx');

        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan: $filePath");
            return 1;
        }

        try {
            Excel::import(new RekeningBelanjaImport, $filePath);
            $this->info("Data rekening belanja berhasil diimpor dari $filePath");
        } catch (\Exception $e) {
            $this->error("Terjadi kesalahan saat mengimpor file: " . $e->getMessage());
        }

        return 0;
    }
}
