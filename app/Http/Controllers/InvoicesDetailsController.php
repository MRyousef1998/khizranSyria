<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoices_Details;
use App\Models\InvoicesDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Invoices_Detailstails;
use App\Models\User;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 0;
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
     * @param  \App\Models\Invoices_Details  $invoices_Details
     * @return \Illuminate\Http\Response
     */
    public function show(Invoices_Details $invoices_Details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices_Details  $invoices_Details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = Invoice::where('id',$id)->first();
        $details  = InvoicesDetails::where('invoices_id',$id)->get();
     //   $attachments  = invoice_attachments::where('invoice_id',$id)->get();
     $exporter = User::where('role_id','=',1)->get();
     $importer = User::where('role_id','=',2)->get();
     $representative = User::where('role_id','=',3)->get();
  
        return view('invoices.details_invoice',compact('invoices','details','exporter', 'importer','representative'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices_Details  $invoices_Details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoices_Details $invoices_Details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices_Details  $invoices_Details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoices_Details $invoices_Details)
    {
        //
    }
}
