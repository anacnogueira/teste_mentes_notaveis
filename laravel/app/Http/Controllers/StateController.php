<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Http\Requests\StateRequest;

class StateController extends Controller
{
    
    protected $state;

    public function __construct(State $state)
    {
        $this->state = $state;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = $this->state->all();

        return response()->json($states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request)
    {
        $state = $this->state->create($request->all());
 
        return response()->json($state);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        $state = $this->state->findOrFail($state->id);

        return response()->json($state);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(StateRequest $request, State $state)
    {
        $input = $request->all();
        $state->name = $input['name'];
        $state->uf = $input['uf'];
        $state->save();

        return response()->json($state);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();

        return response()->json($state);
    }

    /**
     * Return Users by State
     *
     * @return \Illuminate\Http\Response
     */
    public function usersByState()
    {
       $states = $this->state
        ->select(['name'])
        ->selectRaw("(SELECT 
            COUNT(*)
            FROM users
            WHERE id IN (SELECT user_id FROM user_addresses WHERE state_id = states.id AND user_id = users.id )) usuarios")
        ->get();

       return response()->json($states);
    }
}
