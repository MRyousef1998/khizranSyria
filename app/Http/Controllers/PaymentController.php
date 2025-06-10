<?php

namespace App\Http\Controllers;

use App\Models\AccountStatement;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class PaymentController extends Controller
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
    public function create(Request $request)
    {
       return 0;
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
     
        Payment::create([
           
            'amount' => $request->amount_payments,
            'note' => $request->note,
            'orders_id' =>$request->order_id,
            'representative_id' =>$request->representative_id	,
            //'palance_after_this' => $fileName,

            'pay_date' =>  Carbon::today(),
   
        ]);
        $userName=User::find($request->representative_id)->name;
        AccountStatement::create([
            'purpose' =>" دفعة للعميل".$userName,
            'account_statement_types_id' => 1,
            
            'amount' => $request->amount_payments,
            'note' => $request->note,
            'user_id' =>(Auth::user()->id),

            //'palance_after_this' => $fileName,

            'pay_date' =>  Carbon::today(),
  
        ]);
        session()->flash('success', ' تم اضافة الدفعة  بنجاح');

        return redirect("user_profile/".$request->representative_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return $request;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
    public function payment_continer(Request $request)
    {
       
        Payment::create([
           
            'amount' => $request->amount_payments,
            'note' => $request->note,
            'orders_id' =>$request->order_id,
         
            //'palance_after_this' => $fileName,

            'pay_date' =>  Carbon::today(),
   
        ]);
        $order=Order::find($request->order_id)->importer->name;
        AccountStatement::create([
            'purpose' =>"مصروف کونتینر".$order,
            'account_statement_types_id' => 1,
            
            'amount' => $request->amount_payments,
            'note' => $request->note,
            'user_id' =>(Auth::user()->id),

            //'palance_after_this' => $fileName,

            'pay_date' =>  Carbon::today(),
  
        ]);
        session()->flash('success', ' تم اضافة الدفعة  بنجاح');

        return redirect("order_report/".$request->order_id);
    }
}
