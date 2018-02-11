<?php

namespace App\Console\Commands;

use App\Models\HeatMapPoint;
use App\Models\Inspection;
use App\Models\PolygonModel;
use Illuminate\Console\Command;

class GeneratePolygonMapRatings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:polygon-map-ratings';

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
        PolygonModel::truncate();
        $step = 0.003;
        // start top left of louisville
        $startLat = 38.4674222;
        $startLng = -85.9473245;

        // end with bottom right of louisville
        $endLat = 38.0318861;
        $endLng = -85.3424749;
        // top -> down
        // start from a higher number and move down
        for($lat = $startLat; $lat >= $endLat; $lat -= $step) {
            // left -> right
            for($lng = $startLng; $lng <= $endLng; $lng += $step) {
                $score = Inspection::query()
                    ->where('Latitude', '<=', $lat)
                    ->where('Latitude', '>=', $lat - $step)
                    ->where('Longitude', '>=', $lng)
                    ->where('Longitude', '<=', $lng + $step)
                ->avg('Score');

                if($score === null)
                    continue;

                $point = new PolygonModel();
                $point->TopLeftLat = $lat;
                $point->BottomRightLat = $lat - $step;
                $point->TopLeftLng = $lng;
                $point->BottomRightLng = $lng + $step;

                $point->Rating = $score;
                $point->Step = $step;
                $point->save();
            }
        }




        //@38.4674222,-85.9473245,20.42z
        // to @38.0318861,-85.3424749,19.04z
    }
}
