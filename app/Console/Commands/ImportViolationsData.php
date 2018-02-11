<?php

namespace App\Console\Commands;

use App\Models\Violation;
use Illuminate\Console\Command;

class ImportViolationsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:inspection-violations {file}';

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
            $violation = new Violation();
            $violation->business_id = (int)$columns[0];
            $violation->date = (int)$columns[1];

            $violation->description = (string)$columns[3];
            $violation->save();
            $this->info("imported line " . $index . " of " . $length);
            $index++;
        }

    }
}
