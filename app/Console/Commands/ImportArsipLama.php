<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ArsipLamaImport;

class ImportArsipLama extends Command
{
    protected $signature = 'import:arsip-lama {file}';

    protected $description = 'Import the Arsip Lama data from an Excel file';

    public function handle()
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("The file '{$file}' does not exist.");
            return 1;
        }

        Excel::import(new ArsipLamaImport, $file);

        $this->info('File imported successfully.');
    }
}
