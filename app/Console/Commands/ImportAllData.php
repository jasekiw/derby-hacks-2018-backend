<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;
use Symfony\Component\Console\Output\BufferedOutput;

class ImportAllData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:all';

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

        Artisan::call('migrate:refresh', [
            '--force' => true
        ]);

        Artisan::call('import:restaurant-inspections', [
            'file' => 'data/restaurant-inspection-data/FoodServiceInspections.csv'
        ]);

        Artisan::call('import:businesses', [
            'file' => 'data/yelp-data/businesses.csv'
        ]);

        Artisan::call('import:inspection-violations', [
            'file' => 'data/yelp-data/violations.csv'
        ]);

        Artisan::call('generate:heat-map-ratings');
    }
}
