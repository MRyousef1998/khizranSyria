<?php

namespace App\Http\Controllers;

use App\Models\AccountStatement;
use App\Models\Invoice;

use App\Models\InvoiceCategory;

use App\Models\InvoicesDetails;
use App\Models\Order;
use App\Models\User;
use App\Models\BankAccountStatements;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $PaidFromUSInvoices = Invoice::where('invoice_categories_id',1)->get();
        // $PaidForUSInvoices = Invoice::where('invoice_categories_id',2)->get();
        $invoiceType = InvoiceCategory::all();
        $exporter = User::where('role_id','=',1)->get();
 $importer = User::where('role_id','=',2)->get();
 $representative = User::where('role_id','=',3)->get();

        return view('invoices.invoices', compact('invoiceType','exporter','importer','representative'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 1;

    }

    public function createInvoice($category_id,$order_id)
    {
       // return $category_id;
       $invoice_category=InvoiceCategory::find($category_id);
       $order=Order::find($order_id);
       
$invoice=Invoice::where('orders_id',$order_id)->first();

        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       

        return view('invoices.add_invoice',compact('invoice_category','invoice','order','exporter', 'importer','representative'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { $newInvoice=Invoice::where('orders_id',  $request->clint_id)->first();
        
 if($newInvoice==null){
    $newInvoice =  Invoice::create([
        'invoice_Date' => $request->invoice_Date,
        'orders_id' => $request->clint_id,
        
        'invoice_categories_id' => $request->invoice_category,
        
        'Amount_collection' =>$request->Amount_collection ,
        'Discount' =>$request->Discount ,
        'Total' =>$request->Total ,
        'Value_Status' =>3 ,
      
        'note' =>$request->note ,



    ]);
 }
 else{
    $newInvoice = $newInvoice->update([
        'invoice_Date' => $request->invoice_Date,
        'orders_id' => $request->clint_id,
        
        'invoice_categories_id' => $request->invoice_category,
        
        'Amount_collection' =>($request->Amount_collection) ,
        'Discount' =>($request->Discount) ,
        'Total' =>($request->Total ),
        'Value_Status' =>$newInvoice->Value_Status ,
      
        'note' =>$request->note ,



    ]);
    $newInvoice=Invoice::where('orders_id',  $request->clint_id)->first();
    
 }
        
      
        $invoiceId = $newInvoice->id;
        
        $order = Order::where('id',  $newInvoice->orders_id)->first();
        $machines =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",   $newInvoice->orders_id)->where("product_details.category_id", 1)
        ->selectRaw('products.id,company_name,product_name,group_name,country_of_manufacture,selling_price_with_comm,price_with_comm')
        ->groupBy('products.id','company_name','product_name','country_of_manufacture','group_name','selling_price_with_comm','price_with_comm')->get();
 
        $grinders =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",   $newInvoice->orders_id)->where("product_details.category_id", 2)
        ->selectRaw('products.id,company_name,product_name,group_name,country_of_manufacture,selling_price_with_comm,price_with_comm')
        ->groupBy('products.id','company_name','product_name','country_of_manufacture','group_name','selling_price_with_comm','price_with_comm')->get();
 
       $parts =DB::table('products')->
       leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
       ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",   $newInvoice->orders_id)->where("product_details.category_id", 3)
       ->selectRaw('products.id,company_name,product_name,group_name,country_of_manufacture,selling_price_with_comm,price_with_comm')
       ->groupBy('products.id','company_name','product_name','country_of_manufacture','group_name','selling_price_with_comm','price_with_comm')->get();

       $exporter = User::where('role_id','=',1)->get();
            $importer = User::where('role_id','=',2)->get();
            $representative = User::where('role_id','=',3)->get();
            $invoices =$newInvoice; 



        return view('invoices.Print_invoice',compact('invoices','machines','grinders','parts','exporter','importer','representative','order'));


    }
    public function invoice_serch(Request $request)
    { 
        if($request->rdio==1){
            
           if($request->type!=null){



                if ($request->invoice_categotry==null&&$request->start_at==null){
                $end_at=date($request->end_at);

                     $invoices=Invoice::where('invoice_categories_id',$request->type)->where('invoice_Date','<=',$end_at)->get();
                     
                          }
               else if($request->invoice_categotry==null&&$request->start_at!=null){
                $start_at=date($request->start_at);
                $end_at=date($request->end_at);
                $invoices=Invoice::where('invoice_categories_id',$request->type)->where('invoice_Date','>=',$start_at)->where('invoice_Date','<=',$end_at)->get();
               }
                else if($request->invoice_categotry!=null&&$request->start_at!=null){
                    $start_at=date($request->start_at);
                    $end_at=date($request->end_at);
                    $invoices=Invoice::where('invoice_categories_id',$request->type)->where('invoice_Date','>=',$start_at)->where('invoice_Date','<=',$end_at)
                    ->where('Value_Status',$request->invoice_categotry)->get();
                     }
               
                     else if($request->invoice_categotry!=null&&$request->start_at==null){
                    
                        $invoices=Invoice::where('invoice_categories_id',$request->type)->where('Value_Status',$request->invoice_categotry)->get();
                         }





           }
        }
        else{

            $invoices=Invoice::where('id',$request->invoice_number)->get();
        }
        
        $invoiceType = InvoiceCategory::all();
        $exporter = User::where('role_id','=',1)->get();
 $importer = User::where('role_id','=',2)->get();
 $representative = User::where('role_id','=',3)->get();

        return view('invoices.invoices', compact('invoiceType','exporter','importer','representative','invoices'));
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $invoices = Invoice::where('id', $id)->first();
        $order =Order::where('id', $invoices->orders_id)->first();
        $invoices_detailes =DB::table('invoices_details')->
      where ("invoices_details.invoices_id",$invoices->id)
        ->selectRaw('invoices_details.invoices_id,sum(invoices_details.amount_payment) as amount_payment_pefor')
        ->groupBy('invoices_details.invoices_id')->get();
        
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();
        return view('invoices.status_update', compact('invoices','order','exporter','importer','representative','invoices_detailes'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }
    public function Status_Update( Request $request)
    { 
       
        $fileName=null;
        if($request->pic!=null){
    
            $imageName = $request->pic;
            $fileName = $imageName->getClientOriginalName();
            }

        $invoices = Invoice::findOrFail($request->invoice_id);

        if ($request->Status == 1) {

            $invoices->update([
                'Value_Status' => 1,
              
                'Payment_Date' => $request->Payment_Date,
            ]);

            InvoicesDetails::create([
                'invoices_id' => $request->invoice_id,
               
                'amount_payment' => $request->new_payment,
                'image_name' => $fileName,
                'Value_Status' => 1,
                'note' => $request->note,
                'payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }

        else {
            $invoices->update([
                'Value_Status' => 2,
                
                'Payment_Date' => $request->Payment_Date,
            ]);
            invoicesDetails::create([
                'invoices_id' => $request->invoice_id,
               
                'amount_payment' => $request->new_payment,
                'image_name' => $fileName,
            
                'Value_Status' => 2,
                'note' => $request->note,
                'payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }

        if($request->pic!=null){
        $invoice_detail_id = InvoicesDetails::latest()->first()->id;
        $request->pic->move(public_path('Attachments/InvoicesDetails/' . $invoice_detail_id ), $fileName);
        }
        $order=Order::findOrFail($invoices->orders_id);
        $clint=User::findOrFail($order->exported_id);
if($invoices->invoice_categories_id != 1){
    if($request->paymentType==1){
        AccountStatement::create([
            'purpose' => 'دفعة مقبوضة من الذبون'.$clint->name.' عن طلبية رقم :'.'ORNO'.$order->id,
            'account_statement_types_id' => 2,
            
            'amount' => $request->new_payment,
            'note' => $request->note,
            'user_id' =>(Auth::user()->id),

            //'palance_after_this' => $fileName,

            'pay_date' =>  Carbon::today(),
  
        ]);}
        else{
            BankAccountStatements::create([
                'purpose' => 'دفعة مقبوضة من الذبون'.$clint->name.' عن طلبية رقم :'.'ORNO'.$order->id,
                'account_statement_types_id' => 2,
                
                'amount' => $request->new_payment,
                'note' => $request->note,
                'user_id' =>(Auth::user()->id),
    
                //'palance_after_this' => $fileName,
    
                'pay_date' =>  Carbon::today(),
      
            ]);}
    
    
    
    }
        else {

            if($request->paymentType==1){
        AccountStatement::create([
            'purpose' => 'دفعة للمورد'.$clint->name.' عن طلبية رقم :'.'ORNO'.$order->id,
            'account_statement_types_id' => 1,
            
            'amount' => $request->new_payment,
            'note' => $request->note,
            'user_id' =>(Auth::user()->id),

            //'palance_after_this' => $fileName,

            'pay_date' =>  Carbon::today(),
  
        ]);}
        else  {
            BankAccountStatements::create([
                'purpose' => 'دفعة للمورد'.$clint->name.' عن طلبية رقم :'.'ORNO'.$order->id,
                'account_statement_types_id' => 1,
                
                'amount' => $request->new_payment,
                'note' => $request->note,
                'user_id' =>(Auth::user()->id),
    
                //'palance_after_this' => $fileName,
    
                'pay_date' =>  Carbon::today(),
      
            ]);}
    
    
    }
        
        session()->flash('Status_Update');
        return redirect('/invoices');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
    public function show_invoice($invoice_id)
    {  $invoices =Invoice::find($invoice_id);
        $order = Order::where('id',  $invoices->orders_id)->first();
        $machines =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",   $invoices->orders_id)->where("product_details.category_id", 1)
        ->selectRaw('products.id,company_name,product_name,group_name,country_of_manufacture,selling_price_with_comm,price_with_comm')
        ->groupBy('products.id','company_name','product_name','country_of_manufacture','group_name','selling_price_with_comm','price_with_comm')->get();
 
        $grinders =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",   $invoices->orders_id)->where("product_details.category_id", 2)
        ->selectRaw('products.id,company_name,product_name,group_name,country_of_manufacture,selling_price_with_comm,price_with_comm')
        ->groupBy('products.id','company_name','product_name','country_of_manufacture','group_name','selling_price_with_comm','price_with_comm')->get();
 
       $parts =DB::table('products')->
       leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
       ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",   $invoices->orders_id)->where("product_details.category_id", 3)
       ->selectRaw('products.id,company_name,product_name,group_name,country_of_manufacture,selling_price_with_comm,price_with_comm')
       ->groupBy('products.id','company_name','product_name','country_of_manufacture','group_name','selling_price_with_comm','price_with_comm')->get();

       $exporter = User::where('role_id','=',1)->get();
            $importer = User::where('role_id','=',2)->get();
            $representative = User::where('role_id','=',3)->get();
          
        return view('invoices.Print_invoice',compact('invoices','machines','grinders','parts','exporter','importer','representative','order'));


    }

    public function Invoice_Paid()
    {
      
        $PaidFromUSInvoices = Invoice::where('invoice_categories_id',1)->where('Value_Status', 1)->get();
        $PaidForUSInvoices = Invoice::where('invoice_categories_id',2)->where('Value_Status', 1)->get();

        $exporter = User::where('role_id','=',1)->get();
 $importer = User::where('role_id','=',2)->get();
 $representative = User::where('role_id','=',3)->get();

        return view('invoices.invoices', compact('PaidFromUSInvoices',"PaidForUSInvoices",'exporter','importer','representative'));
    }
    public function Invoice_Partial()
    {
      
        $PaidFromUSInvoices = Invoice::where('invoice_categories_id',1)->where('Value_Status', 2)->get();
        $PaidForUSInvoices = Invoice::where('invoice_categories_id',2)->where('Value_Status', 2)->get();

        $exporter = User::where('role_id','=',1)->get();
 $importer = User::where('role_id','=',2)->get();
 $representative = User::where('role_id','=',3)->get();

        return view('invoices.invoices', compact('PaidFromUSInvoices',"PaidForUSInvoices",'exporter','importer','representative'));
    }
    public function Invoice_UnPaid()
    {
      
        $PaidFromUSInvoices = Invoice::where('invoice_categories_id',1)->where('Value_Status', 3)->get();
        $PaidForUSInvoices = Invoice::where('invoice_categories_id',2)->where('Value_Status', 3)->get();

        $exporter = User::where('role_id','=',1)->get();
 $importer = User::where('role_id','=',2)->get();
 $representative = User::where('role_id','=',3)->get();

        return view('invoices.invoices', compact('PaidFromUSInvoices',"PaidForUSInvoices",'exporter','importer','representative'));
    }
}
