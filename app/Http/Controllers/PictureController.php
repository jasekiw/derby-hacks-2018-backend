<?php

namespace App\Http\Controllers;


use App\Models\Violation;
use Illuminate\Http\Request;



class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $address = $request->get('address');
        $city = $request->get('city');
        $state = $request->get('state');
        $name = $request->get('name');
        $location = $address . " " . $city . " " . $state . " " . $name;
        $url = 'https://maps.googleapis.com/maps/api/place/textsearch/json?query=' . urlencode($location) . '&key=AIzaSyAOYeMz6EHVT95i5lvY5fA-_AoZ2qB_wQE';
        //$url = 'https://google.com';
        $client = new \GuzzleHttp\Client();

        $res = $client->request('GET', $url);
        $photoReference = $res->getBody()->getContents();

        $array = json_decode($photoReference, true);
        $results = $array['results'];
        $arr = $results[0];
        $photos = $arr['photos'];
        if(count($photos) > 0){
            $photos_arr = $photos[0];
            $photo_ref = $photos_arr['photo_reference'];
            $url = 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&maxheight=400&photoreference=' . $photo_ref . '&key=AIzaSyAOYeMz6EHVT95i5lvY5fA-_AoZ2qB_wQE';
            $res = $client->request('GET', $url);
            $photoDetails = $res->getBody()->getContents();
            return response([ 'image' => base64_encode($photoDetails) ]);
        }else {
            return response("No photos found :(",404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
