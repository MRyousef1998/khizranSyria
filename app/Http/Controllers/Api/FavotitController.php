<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\favotit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavotitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\favotit  $favotit
     * @return \Illuminate\Http\Response
     */
    public function show(favotit $favotit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\favotit  $favotit
     * @return \Illuminate\Http\Response
     */
    public function edit(favotit $favotit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\favotit  $favotit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, favotit $favotit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\favotit  $favotit
     * @return \Illuminate\Http\Response
     */
    public function destroy(favotit $favotit)
    {
        //
    }
    public function add_favorite(Request $request)
    {
        $favotit=  favotit::create([
            'user_id' => $request->user_id,
            'product_details_id' => $request->product_details_id,

            
        ]);
        return response()->json([
            'message' => 'favorite successfully added',
            'favorite' => $favotit
        ], 201);

    }
    public function remove_favorite(Request $request)
    {
        $favotit= favotit::where('user_id',$request->user_id)->where('product_details_id',$request->product_details_id)->delete();
        return response()->json([
            'message' => 'favorite successfully removed',
            'favorite' => $favotit
        ], 201);
    }


    public function favorite_product(Request $request)
    {

        $favotit =DB::table('favotits')->where('user_id',$request->user_id)-> Join('product_details', 'product_details.id', '=', 'favotits.product_details_id')
        ->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->selectRaw('product_details.id as product_detailes_id,company_name,product_name,group_name,country_of_manufacture,product_details.image_name,product_details.rate')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name','product_details.rate')->get();
     return response()->json([
            'message' => 'favorite get successfully ',
            'favorite' => $favotit
        ], 201);
    }
}
