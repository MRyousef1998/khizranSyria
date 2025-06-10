<?php

namespace App\Http\Controllers;

use App\Models\HomeStatments;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class HomeStatmentsController extends Controller
{
    /**                                                      
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  //return 0;
        
        $diposit = HomeStatments::where('account_statement_types_id','=',1)->where('pay_date','=', Carbon::today())->get();
        $withdrow = HomeStatments::where('account_statement_types_id','=',2)->where('pay_date','=', Carbon::today())->get();
        $externaldiposit = HomeStatments::where('account_statement_types_id','=',3)->where('pay_date','=', Carbon::today())->get();
      
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       

        return view('home_account.show_account',compact('diposit','withdrow','exporter', 'importer','representative','externaldiposit'));
    
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
        //return $request;
       
        HomeStatments::create([
            'purpose' => $request->purpose,
            'account_statement_types_id' => $request->type_id,
            
            'amount' => $request->amount,
            'note' => $request->note,
            'user_id' =>(Auth::user()->id),

            //'palance_after_this' => $fileName,

            'pay_date' =>  Carbon::today(),
  
        ]);
        session()->flash('success', ' تم الاضافة بنجاح');

        return redirect('/today_home_statment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountStatement  $accountStatement
     * @return \Illuminate\Http\Response
     */
    public function show(AccountStatement $accountStatement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountStatement  $accountStatement
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountStatement $accountStatement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountStatement  $accountStatement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $accountStatement = HomeStatments::findOrFail($request->id);

      

        $accountStatement->update([
            'purpose' => $request->purpose,
            'amount' => $request->amount,
            'note' => $request->note,
        ]);
        session()->flash('success', ' تم التعديل بنجاح');

        return redirect('/today_home_statment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountStatement  $accountStatement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        HomeStatments::find($request->event_id)->delete();
        return redirect()->route('today_home_statment.index')->with('success','تم حذف المستخدم بنجاح');
    }
}
