<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  $orders = Order::where('category_id','=',1)->whereMonth("order_date",Carbon::now()->month)->get();
       
        $machinesRemining =DB::table('products')-> leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
        where("product_details.category_id", 1)->where("products.selling_date", '=',null)->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)
         ->selectRaw('count(products.id) as number_remining ,sum(products.price_with_comm) as primery_price_with_com_product_remining')
        ->get(); 
        
       
         
       $GrinderRemining =DB::table('products')-> leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
       where("product_details.category_id", 2)->where("products.selling_date", '=',null)->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)
        ->selectRaw('count(products.id) as number_remining ,sum(products.price_with_comm) as primery_price_with_com_product_remining')
       ->get();
       
       
        $partsReminig = DB::table('products')-> leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
        where("product_details.category_id", 3)->where("products.selling_date", '=',null)
         ->selectRaw('count(products.id) as number_remining ,sum(products.price_with_comm) as primery_price_with_com_product_remining')
        ->get();

for($i=1;$i<=12;$i++){

    $erning_from_machine[$i]=0;
    $erning_from_grinder[$i]=0;
    $costForMachineParMonth[$i]=0;
     $cost_array[$i]=0;
}


$macineSoldParMonth=DB::table('products')-> leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')-> 
Join('order_product', 'products.id', '=', 'order_product.products_id')->leftJoin('orders', 'order_product.orders_id', '=', 'orders.id')->where("product_details.category_id", '=',1)->where("orders.category_id", '!=',1)->where("orders.category_id", '!=',3)->where("products.selling_date", '!=',null)->whereMonth("order_date", '>=',Carbon::now()->month-5)
->selectRaw('count(products.id) as number_sold ,sum(products.price_with_comm) as primery_price_with_com_product_sold,sum(products.selling_price) as selling_price_without_com_product_sold,sum(products.selling_price_with_comm) as selling_price_with_com_product_sold,YEAR(order_date) year, MONTH(order_date) month')
->groupBy('year','month')->get();
$grinderSoldParMonth=DB::table('products')-> leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')-> 
Join('order_product', 'products.id', '=', 'order_product.products_id')->leftJoin('orders', 'order_product.orders_id', '=', 'orders.id')->where("product_details.category_id", '=',2)->where("orders.category_id", '!=',1)->where("orders.category_id", '!=',3)->where("products.selling_date", '!=',null)->whereMonth("order_date", '>=',Carbon::now()->month-5)
->selectRaw('count(products.id) as number_sold ,sum(products.price_with_comm) as primery_price_with_com_product_sold,sum(products.selling_price) as selling_price_without_com_product_sold,sum(products.selling_price_with_comm) as selling_price_with_com_product_sold,YEAR(order_date) year, MONTH(order_date) month')
->groupBy('year','month')->get();
$costForMachineParMonth=DB::table('payments')->whereMonth("pay_date", '>=',Carbon::now()->month-5)
->selectRaw('sum(amount) as cost_amount,YEAR(pay_date) year, MONTH(pay_date) month')
->groupBy('year','month')->get();
foreach ($costForMachineParMonth as $cost) {
    $cost_array[$cost->month] =$cost->cost_amount;
}   
foreach ($macineSoldParMonth as $machine) {
    $erning_from_machine[$machine->month] =$machine->selling_price_with_com_product_sold-$machine->primery_price_with_com_product_sold-$cost_array[$machine->month];
}

foreach ($grinderSoldParMonth as $machine) {
     $erning_from_grinder[$machine->month] =$machine->selling_price_with_com_product_sold-$machine->primery_price_with_com_product_sold;
   // $erning_from_grinder[$machine->month] =$machine->selling_price_with_com_product_sold-$machine->primery_price_with_com_product_sold-$cost_array[$machine->month]/2 ;
  //  $erning_from_machine[$machine->month] = $erning_from_machine[$machine->month]+$cost_array[$machine->month]/2;
}       

 


$PartsSoldParMonth=DB::table('products')-> leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')-> 
Join('order_product', 'products.id', '=', 'order_product.products_id')->leftJoin('orders', 'order_product.orders_id', '=', 'orders.id')->where("product_details.category_id", '=',3)->where("orders.category_id", '=',2)->where("products.selling_date", '!=',null)->whereMonth("order_date", '>=',Carbon::now()->month-5)
->selectRaw('count(products.id) as number_sold ,sum(products.price_with_comm) as primery_price_with_com_product_sold,sum(products.selling_price) as selling_price_without_com_product_sold,sum(products.selling_price_with_comm) as selling_price_with_com_product_sold,YEAR(order_date) year, MONTH(order_date) month')
->groupBy('year','month')->get();

$paymentsthismonth = DB::table('account_statements')->where("account_statements.account_statement_types_id", 1)
->selectRaw('count(id) as number ,sum(amount) as payments, MONTH(pay_date) month')->whereMonth("account_statements.pay_date", Carbon::now()->month)
->groupBy('month')->get();
$erningthismonth = DB::table('account_statements')->where("account_statements.account_statement_types_id", '=',2)
->selectRaw('count(id) as number ,sum(amount) as payments, MONTH(pay_date) month')->whereMonth("account_statements.pay_date", Carbon::now()->month)
->groupBy('month')->get();

$parsonalpaymentthismonth = DB::table('account_statements')->where("account_statements.account_statement_types_id", '=',3)
->selectRaw('count(id) as number ,sum(amount) as payments, MONTH(pay_date) month')->whereMonth("account_statements.pay_date", Carbon::now()->month)
->groupBy('month')->get();

$zuhair = DB::table('account_statements')->where("account_statements.account_statement_types_id", 4)
->selectRaw('count(id) as number ,sum(amount) as payments, MONTH(pay_date) month')->whereMonth("account_statements.pay_date", Carbon::now()->month)
->groupBy('month')->get();
$giass = DB::table('account_statements')->where("account_statements.account_statement_types_id", '=',5)
->selectRaw('count(id) as number ,sum(amount) as payments, MONTH(pay_date) month')->whereMonth("account_statements.pay_date", Carbon::now()->month)
->groupBy('month')->get();

$zakria = DB::table('account_statements')->where("account_statements.account_statement_types_id", '=',6)
->selectRaw('count(id) as number ,sum(amount) as payments, MONTH(pay_date) month')->whereMonth("account_statements.pay_date", Carbon::now()->month)
->groupBy('month')->get();


if ($paymentsthismonth->isEmpty()==true) {

    $paymentsthismonth=[new Request(['count'=>0,

    "payments"=>0,
   
])];
    
   }
   if ($erningthismonth->isEmpty()==true) {

    $erningthismonth=[new Request(['count'=>0,

    "payments"=>0,
   
])];
    
   }
   if ($parsonalpaymentthismonth->isEmpty()==true) {

    $parsonalpaymentthismonth=[new Request(['count'=>0,

    "payments"=>0,
   
])];
    
   }

   if ($zuhair->isEmpty()==true) {

    $zuhair=[new Request(['count'=>0,

    "payments"=>0,
   
])];
    
   }
   if ($giass->isEmpty()==true) {

    $giass=[new Request(['count'=>0,

    "payments"=>0,
   
])];
    
   }
   if ($zakria->isEmpty()==true) {

    $zakria=[new Request(['count'=>0,

    "payments"=>0,
   
])];
    
   }
   if ($machinesRemining->isEmpty()==true) {

    $machinesRemining=[new Request(['number_remining'=>0,

   
   
])];
    
   }
   if ($partsReminig->isEmpty()==true) {

    $partsReminig=[new Request(['number_remining'=>0,

   
])];
    
   }
   if ($GrinderRemining->isEmpty()==true) {

    $GrinderRemining=[new Request(['number_remining'=>0,

   
   
])];
    
   }
 
        $chartjs1 = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 300 , 'height' => 200])
        ->labels(['مدفوعات', 'مقبوضات','مصاریف خارجیة','السيد زكريا','السيد غياث','السيد زهير'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384', '#36A2EB','#Fa672e','#3eb05c', '#c9d16d','#52504e'],
                'hoverBackgroundColor' => ['#FF6384', '#36A2EB','#Fa672e','#3eb05c', '#c9d16d','#52504e'],
                'data' => [$paymentsthismonth[0]->payments, $erningthismonth[0]->payments,$parsonalpaymentthismonth[0]->payments
                ,$zakria[0]->payments, $giass[0]->payments,$zuhair[0]->payments,]
            ]
        ])
        ->options([]);
  
        $Reminingchartjs = app()->chartjs
        ->name('pieChartTest1')
        ->type('doughnut')
        ->size(['width' => 300 , 'height' => 200])
        ->labels(['متبقي مکنات', 'متبقي مطاحن','متبقي قطع تبديل'])
        ->datasets([
            [
                'backgroundColor' => ['#36A2EB', '#FF6384','#Fa672e'],
                'hoverBackgroundColor' => ['#36A2EB', '##FF6384','#Fa672e'],
                'data' => [$machinesRemining[0]->primery_price_with_com_product_remining, $GrinderRemining[0]->primery_price_with_com_product_remining,$partsReminig[0]->primery_price_with_com_product_remining]
            ]
        ])
        ->options([]);

        $BarChart = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 800, 'height' => 200])
        ->labels([Carbon::now()->format('Y-m'),Carbon::now()->subMonths(1)->format('Y-m'),Carbon::now()->subMonths(2)->format('Y-m'),
        Carbon::now()->subMonths(3)->format('Y-m'),Carbon::now()->subMonths(4)->format('Y-m'),Carbon::now()->subMonths(5)->format('Y-m')])
        ->datasets([
            [
                "label" => "مکائن القهوة",
               
                'backgroundColor' => ['#36A2EB'],
                'data' => [$erning_from_machine[(int)Carbon::now()->format('m')],$erning_from_machine[(int)Carbon::now()->subMonths(1)->format('m')],$erning_from_machine[(int)Carbon::now()->subMonths(2)->format('m')],
                $erning_from_machine[ (int) Carbon::now()->subMonths(3)->format('m')],$erning_from_machine[(int)Carbon::now()->subMonths(4)->format('m')],$erning_from_machine[(int)Carbon::now()->subMonths(5)->format('m')]]
            ],
            [
                "label" => "مطاحن",
                'backgroundColor' => [ '#FF6384'],
                'data' =>[$erning_from_grinder[(int)Carbon::now()->format('m')],$erning_from_grinder[(int)Carbon::now()->subMonths(1)->format('m')],$erning_from_grinder[(int)Carbon::now()->subMonths(2)->format('m')],
                $erning_from_grinder[ (int) Carbon::now()->subMonths(3)->format('m')],$erning_from_grinder[(int)Carbon::now()->subMonths(4)->format('m')],$erning_from_grinder[(int)Carbon::now()->subMonths(5)->format('m')]]
           
            ]
        ])
        ->options([]);
        $GrinderReminingNumber=$GrinderRemining[0]->number_remining;
        $machineReminingNumber=$machinesRemining[0]->number_remining;


        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

        return view('home',compact('chartjs1','orders','exporter','importer','representative','BarChart','Reminingchartjs','GrinderReminingNumber','machineReminingNumber'));
    }
}
