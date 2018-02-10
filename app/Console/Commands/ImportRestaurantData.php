<?php

namespace App\Console\Commands;

use App\Inspection;
use Illuminate\Console\Command;

class ImportRestaurantData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:restaurant-inspections {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports restaurant inspections';

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
     * @return mixed
     */
    public function handle()
    {
        $csvFileLocation = $this->argument('file');
        $this->info($csvFileLocation);
        $contents = file_get_contents($csvFileLocation);
        $lines = explode("\r\n", $contents);
        array_shift($lines);
        foreach($lines as $line) {
            $columns = str_getcsv($line);
            $inspection = new Inspection();
            $inspection->EstablishmentID = (int)$columns[0];

            var_dump($columns);
        }

    }
}
