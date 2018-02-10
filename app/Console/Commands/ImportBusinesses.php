<?php

namespace App\Console\Commands;

use App\Business;
use Illuminate\Console\Command;
use PhpParser\Node\Scalar\String_;

class ImportBusinesses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:businesses {file}';

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
            $business = new Business();
            $business->business_id = (int)$columns[0];
            $business->name = (String)$columns[1];
            $business->address = (String)$columns[2];
            $business->city = (String)$columns[3];
            $business->state = (String)$columns[4];
            $business->postal_code = (int)$columns[5];
            $business->latitude = (double)$columns[6];
            $business->longitude = (double)$columns[7];
            $business->phone_number = (String)$columns[8];

            $business->save();
            $this->info("imported line " . $index . " of " . $length);
            $index++;
        }
    }
}
