<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Http\Requests\CityRequest;

class CityController extends Controller
{
    protected $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = $this->city->all();

        return response()->json($cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $city = $this->city->create($request->all());
 
        return response()->json($city);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        $city = $this->city->findOrFail($city->id);

        return response()->json($city); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        $input = $request->all();
        $city->name = $input['name'];
        $city->state_id = $input['state_id'];
        $city->save();

        return response()->json($city);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();

        return response()->json($city);
    }

    /**
     * Return Users by City
     *
     * @return \Illuminate\Http\Response
     */
    public function usersByCity()
    {
       $cities = $this->city
        ->select(['name'])
        ->selectRaw("(SELECT 
            COUNT(*)
            FROM users
            WHERE id IN (SELECT user_id FROM user_addresses WHERE city_id = cities.id AND user_id = users.id )) usuarios")
        ->get();

       return response()->json($cities);
    }
}
