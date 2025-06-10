<?php

namespace App\Http\Controllers;

use App\Models\BankAccountStatements;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class BankAccountStatementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diposit = BankAccountStatements::where('account_statement_types_id','=',1)->where('pay_date','=', Carbon::today())->get();
        $withdrow = BankAccountStatements::where('account_statement_types_id','=',2)->where('pay_date','=', Carbon::today())->get();
        $externaldiposit = BankAccountStatements::where('account_statement_types_id','=',3)->where('pay_date','=', Carbon::today())->get();
      
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       

        return view('bank_account.show_account',compact('diposit','withdrow','exporter', 'importer','representative','externaldiposit'));
    
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        BankAccountStatements::create([
            'purpose' => $request->purpose,
            'account_statement_types_id' => $request->type_id,
            
            'amount' => $request->amount,
            'note' => $request->note,
            'user_id' =>(Auth::user()->id),

            //'palance_after_this' => $fileName,

            'pay_date' =>  Carbon::today(),
  
        ]);
        session()->flash('success', ' تم الاضافة بنجاح');

        return redirect('/today_bank_statment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAccountStatements  $bankAccountStatements
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccountStatements $bankAccountStatements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankAccountStatements  $bankAccountStatements
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccountStatements $bankAccountStatements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankAccountStatements  $bankAccountStatements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankAccountStatements $bankAccountStatements)
    {
        $accountStatement = BankAccountStatements::findOrFail($request->id);

      

        $accountStatement->update([
            'purpose' => $request->purpose,
            'amount' => $request->amount,
            'note' => $request->note,
        ]);
        session()->flash('success', ' تم التعديل بنجاح');

        return redirect('/today_bank_statment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankAccountStatements  $bankAccountStatements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        BankAccountStatements::find($request->event_id)->delete();
        return redirect()->route('today_bank_statment.index')->with('success','تم حذف المستخدم بنجاح');
   
    }
}
