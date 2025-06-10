<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class CoponController extends Controller
{

    public function get_copon(Request $request)
    {
        

        $copon =DB::table('copons')->where('copon_count',">=",0)->where('copone_expair_date','>', Carbon::today())->get();
     return response()->json([
            'message' => 'copon get successfully ',
            'copon' => $copon
        ], 201);}

    public function chek_copon(Request $request)
    {
        

        $copon =DB::table('copons')->where('copon_code',$request->copon_code)->where('copon_count',">=",0)->where('copone_expair_date','>', Carbon::today())->get();
     return response()->json([
            'message' => 'copon get successfully ',
            'copon' => $copon
        ], 201);}
}
