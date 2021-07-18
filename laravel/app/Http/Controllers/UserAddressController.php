<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAddress;
use App\Http\Requests\UserAddressRequest;

use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    protected $user;
    protected $userAddress;

    public function __construct(User $user, UserAddress $userAddress)
    {
        $this->user = $user;
        $this->userAddress = $userAddress;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $addresses = $this->user->find($user->id)->addresses;

        return response()->json($addresses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, UserAddressRequest $request)
    {
        $address = $user->addresses()->create($request->all());
 
        return response()->json($address);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $id)
    {
        $address = $this->userAddress->findOrFail($id);

        return response()->json($address); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function update(UserAddressRequest $request, User $user, $userAddress)
    {
        $address = $this->userAddress->find($userAddress);
        $input = $request->all();
        $address->name = $input['name'];
        $address->address = $input['address'];
        $address->state_id = $input['state_id'];
        $address->city_id = $input['city_id'];
        $address->save();

        return response()->json($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAddress $userAddress)
    {
        //
    }
}
