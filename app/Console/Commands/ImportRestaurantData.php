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
        $length = count($lines);
        $index = 1;
        foreach($lines as $line) {
            $columns = str_getcsv($line);
            if(count($columns) <= 1)
                continue;
            $inspection = new Inspection();
            $inspection->EstablishmentID = (int)$columns[0];
            $inspection->InspectionID = (int)$columns[1];
            $inspection->EstablishmentName = $columns[2];
            $inspection->Address = $columns[4];
            $inspection->City = $columns[6];
            $inspection->State = $columns[7];
            $inspection->Zip = $columns[8];
            $inspection->TypeDescription = $columns[9];
            $inspection->Latitude = $columns[10];
            $inspection->Longitude = $columns[11];
            $inspection->InspectionDate = $columns[12];
            $inspection->Score = $columns[13];
            $inspection->Grade = $columns[14];
            $inspection->NameSearch = $columns[15];
            $inspection->save();
            $this->info("imported line " . $index . " of " . $length);
            $index++;
        }

    }
}
