<?php

namespace App\Http\Controllers\Api;



use Illuminate\Support\Facades\DB;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductWithFavoriteRecource;
use App\Models\Product;

use App\Models\ProductCategory;
use App\Models\favotit;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoicesDetails;
use App\Models\Order;
use App\Models\User;
use App\Models\Payment;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function get_user_balance(Request $request)
    
    {
        $totalRequird=0.0;
        $totalPayment=0.0;
        $userDetail =User::find($request->id);

        //return $userDetail;
        if($userDetail->role_id==1||$userDetail->role_id==2){
    
            $orders = Order::where('exported_id','=',$userDetail->id)->get();
            $invoice_paid =DB::table('invoices')->
                    leftJoin('orders', 'orders.id', '=', 'invoices.orders_id')->leftJoin('users', 'users.id', '=', 'orders.exported_id')->where("invoices.Value_Status", 1)->where("users.id", $request->id)->
                    selectRaw('users.id,count(invoices.id) as invoice_count,sum(invoices.Total) as sum')
                    ->groupBy('users.id')->get();
                   
                   if ($invoice_paid->isEmpty()==true) {
            
                    $invoice_paid=[new Request(['id'=>$request->id,
                'invoice_count'=>0,
                'sum'=>0
                
                ])];
                    
                   }
              
                 
              
             $invoice_almost_paid =DB::table('invoices')->
             leftJoin('orders', 'orders.id', '=', 'invoices.orders_id')->leftJoin('users', 'users.id', '=', 'orders.exported_id')->where("invoices.Value_Status", 2)->where("users.id", $request->id)->
             selectRaw('users.id,count(invoices.id) as invoice_count,sum(invoices.Total) as sum')
             ->groupBy('users.id')->get();   
            
            
             if ($invoice_almost_paid->isEmpty()==true) {
            
                $invoice_almost_paid=[new Request(['id'=>$request->id,
            'invoice_count'=>0,
            'sum'=>0
            
            ])];
                
                }
             $invoice_unpaid =DB::table('invoices')->
             leftJoin('orders', 'orders.id', '=', 'invoices.orders_id')->leftJoin('users', 'users.id', '=', 'orders.exported_id')->where("invoices.Value_Status", 3)->where("users.id", $request->id)->
             selectRaw('users.id,count(invoices.id) as invoice_count,sum(invoices.Total) as sum')
             ->groupBy('users.id')->get();
                
             if ($invoice_unpaid->isEmpty()==true) {
            
                $invoice_unpaid=[new Request(['id'=>$request->id,
            'invoice_count'=>0,
            'sum'=>0
            
            ])];
                
               }
            
            //return $orders;
            // $invoices = Invoice::where('orders_id',$orders->id)->get();
            // return $invoices;
            // $details  = InvoicesDetails::where('invoices_id',$invoices->id)->get();
            $invoice_paid=$invoice_paid[0];
            $invoice_almost_paid=$invoice_almost_paid[0];
            $invoice_unpaid=$invoice_unpaid[0];
                  
            
            
           // return view('users.exporter_importer_profile',compact('userDetail','orders','exporter','importer','representative','invoice_almost_paid','invoice_unpaid','invoice_paid'));
           $all_invoices =DB::table('invoices')->
           leftJoin('orders', 'orders.id', '=', 'invoices.orders_id')->leftJoin('invoices_details', 'invoices_details.invoices_id', '=', 'invoices.id')->leftJoin('users', 'users.id', '=', 'orders.exported_id')->where("users.id", $request->id)
           ->selectRaw('invoices.id,sum(invoices_details.amount_payment) as amount_payment_pefor,invoices.Total')
    ->groupBy('invoices.id','invoices.Total')->get();
          
          
          
          

 foreach($all_invoices as $invoice){
    

    $totalRequird=$totalRequird+$invoice->Total;
    if($invoice->Total!=null)
  { $totalPayment=$totalPayment+$invoice->amount_payment_pefor;}

 }


            return response()->json([
                'message' => 'address successfully added',
                'invoice_paid_count' => $invoice_paid->invoice_count,
                'invoice_paid_amount' => $invoice_paid->sum,
                'invoice_almost_paid_count' => $invoice_almost_paid->invoice_count,
                'invoice_almost_paid_amount' => $invoice_almost_paid->sum,
                'invoice_unpaid_count' => $invoice_unpaid->invoice_count,
                'invoice_unpaid_amount' => $invoice_unpaid->sum,
               'totalRequird'=>$totalRequird,
                    'totalPayment'=>$totalPayment,                

            ], 201);
            }




    }

    public function get_user_payment(Request $request)
    
    {
        
            
            
           // return view('users.exporter_importer_profile',compact('userDetail','orders','exporter','importer','representative','invoice_almost_paid','invoice_unpaid','invoice_paid'));
           $all_invoices_payments =DB::table('invoices_details')->
          leftJoin('invoices', 'invoices_details.invoices_id', '=', 'invoices.id')->
           leftJoin('orders', 'orders.id', '=', 'invoices.orders_id')->
           leftJoin('users', 'users.id', '=', 'orders.exported_id')->
           where("users.id", $request->id)
         -> selectRaw('sum(invoices_details.amount_payment) as amount,invoices_details.payment_Date')
          ->groupBy('invoices_details.payment_Date')->orderBy('invoices_details.payment_Date','DESC')
          ->get();
          
          $my_final_array=[];
          foreach($all_invoices_payments as $all_invoices_payment){
            $my_final_array[]= $all_invoices_payment;
    
          }
    
         
         
          $myPayment = $this->paginate($my_final_array);
          return $myPayment;
            return response()->json([
                'message' => 'data get successfully',
                'paymentes' => $all_invoices_payments,
                

            ], 201);

            
            }




            private function paginate(array $items, int $perPage = 8, ?int $page = null, $options = []): LengthAwarePaginator
{                                                                                                       
  $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

    $items = $items instanceof Collection ? $items : Collection::make($items);
    return new LengthAwarePaginator(array_values($items->forPage($page, $perPage)
->toArray()), $items->count(), $perPage, $page, $options);
//    return new LengthAwarePaginator($items->forPage($page, $perPage)->toArray(), $items->count(), $perPage, $page, $options);
} 


    }



