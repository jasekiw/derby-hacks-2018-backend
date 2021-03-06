<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('inspections','InspectionsController');
Route::resource('businesses','BusinessesController');
Route::resource('heat-map-points','HeatMapPointsController');
Route::resource('polygon-map-points','PolygonMapPointsController');
Route::resource('violation', 'ViolationController');
Route::resource('picture', 'PictureController');