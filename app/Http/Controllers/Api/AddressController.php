<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        
        $address=  Address::create([
            'user_id' => $request->user_id,
            'address_name' => $request->address_name,
            'address_city' => $request->address_city,
            'address_street' => $request->address_street,
            'address_building_name' => $request->address_building_name,
            'address_note' => $request->address_note,
            'address_lat' => $request->address_lat,
            'address_long' => $request->address_long,
            
        ]);

        return response()->json([
            'message' => 'address successfully added',
            'address' => $address
        ], 201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $address= Address::where('user_id',$request->user_id)->get();
        return response()->json([
            'message' => 'successfully',
            'address' => $address
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
        $address= Address::find($request->id)->delete();
        return response()->json([
            'message' => 'address successfully removed',
            'isDeleted' => $address
        ], 201);
    }
}
