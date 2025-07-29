<?php

namespace App\Console\Commands;

use App\Imports\sshImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class ImpportSSH extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:ssh';

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
        ini_set('memory_limit', '-1');
        $filePath = public_path('excel/ssh.xlsx');

        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan: $filePath");
            return 1;
        }
        try {
            // $reader = new Xlsx();
            // $spreadsheet = $reader->load($filePath);
            // $sheet = $spreadsheet->getActiveSheet()->toArray();

            Excel::import(new sshImport, $filePath);
            $this->info("Data rekening belanja berhasil diimpor dari $filePath");
        } catch (\Exception $e) {
            $this->error("Terjadi kesalahan saat mengimpor file: " . $e->getMessage());
        }

        return 0;
    }
}
