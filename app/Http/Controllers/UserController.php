<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoicesDetails;
use App\Models\Order;
use App\Models\User;
use App\Models\Payment;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash as Hash;
use PhpParser\Node\Stmt\Return_;

class UserController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/


function __construct()
{

$this->middleware('permission:قائمة المستخدمين', ['only' => ['index']]);
$this->middleware('permission:المستخدمين', ['only' => ['create','store']]);
$this->middleware('permission:المستخدمين', ['only' => ['edit','update']]);
$this->middleware('permission:المستخدمين', ['only' => ['destroy']]);

}
public function index(Request $request)
{ $exporter = User::where('role_id','=',1)->get();
    $importer = User::where('role_id','=',2)->get();
    $representative = User::where('role_id','=',3)->get();
$data = User::orderBy('id','DESC')->get();
return view('users.show_users',compact('data','exporter', 'importer','representative'))
->with('i', ($request->input('page', 1) - 1) * 5);
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    $exporter = User::where('role_id','=',1)->get();

 $importer = User::where('role_id','=',2)->get();
 $representative = User::where('role_id','=',3)->get();
$roles = Role::all();
return view('users.Add_user',compact('roles','exporter', 'importer','representative'));
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{

   
$this->validate($request, [
'name' => 'required',
'email' => 'required|email|unique:users,email',
'password' => 'required|same:confirm-password',
'role_id' => 'required'
]);

$input = $request->all();
$input['password'] = Hash::make($input['password']);
$user = User::create([
    'mobile' => $request->mopail_number,
 'name' => $request->name,
'email' =>  $request->email,
'role_id' => $request->role_id,
'password' =>  $input['password'],


 
]);
$user->assignRole([$request->role_id]);
$user->save();
return redirect()->route('users.index')
->with('success','User created successfully');
}
/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
$user = User::find($id);
return view('users.show',compact('user'));
}
/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
    
$user = User::find($id);
$roles = Role::all();


$exporter = User::where('role_id','=',1)->get();

$importer = User::where('role_id','=',2)->get();
$representative = User::where('role_id','=',3)->get();
return view('users.edit',compact('user','roles','representative','importer','exporter'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{ 
$this->validate($request, [
'name' => 'required',
'email' => 'required|email|unique:users,email,'.$id,
'password' => 'same:confirm-password',
'role_id' => 'required'
]);
$input = $request->all();
if(!empty($input['password'])){
$input['password'] = Hash::make($input['password']);
}else{
$input = array_except($input,array('password'));
}
$user = User::find($id);
$user->update(
    [
        'name' =>  $request->name,
        'email' =>$request->email,
        'password' => $input['password'],
        'role_id' => $request->role_id
        ]
    
    
   );

return redirect()->route('users.index')
->with('success','User updated successfully');
}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
User::find($id)->delete();
return redirect()->route('users.index')
->with('success','User deleted successfully');
} 


public function show_profile($id)
{
$userDetail =User::find($id);



if($userDetail->role_id==1||$userDetail->role_id==2){
    
$orders = Order::where('exported_id','=',$userDetail->id)->get();
$invoice_paid =DB::table('invoices')->
        leftJoin('orders', 'orders.id', '=', 'invoices.orders_id')->leftJoin('users', 'users.id', '=', 'orders.exported_id')->where("invoices.Value_Status", 1)->where("users.id", $id)->
        selectRaw('users.id,count(invoices.id) as invoice_count,sum(invoices.Total) as sum')
        ->groupBy('users.id')->get();
       
       if ($invoice_paid->isEmpty()==true) {

        $invoice_paid=[new Request(['id'=>$id,
    'invoice_count'=>0,
    'sum'=>0
    
    ])];
        
       }
  
     
  
 $invoice_almost_paid =DB::table('invoices')->
 leftJoin('orders', 'orders.id', '=', 'invoices.orders_id')->leftJoin('users', 'users.id', '=', 'orders.exported_id')->where("invoices.Value_Status", 2)->where("users.id", $id)->
 selectRaw('users.id,count(invoices.id) as invoice_count,sum(invoices.Total) as sum')
 ->groupBy('users.id')->get();   


 if ($invoice_almost_paid->isEmpty()==true) {

    $invoice_almost_paid=[new Request(['id'=>$id,
'invoice_count'=>0,
'sum'=>0

])];
    
    }
 $invoice_unpaid =DB::table('invoices')->
 leftJoin('orders', 'orders.id', '=', 'invoices.orders_id')->leftJoin('users', 'users.id', '=', 'orders.exported_id')->where("invoices.Value_Status", 3)->where("users.id", $id)->
 selectRaw('users.id,count(invoices.id) as invoice_count,sum(invoices.Total) as sum')
 ->groupBy('users.id')->get();
    
 if ($invoice_unpaid->isEmpty()==true) {

    $invoice_unpaid=[new Request(['id'=>$id,
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
      
$exporter = User::where('role_id','=',1)->get();
$importer = User::where('role_id','=',2)->get();
$representative = User::where('role_id','=',3)->get();

return view('users.exporter_importer_profile',compact('userDetail','orders','exporter','importer','representative','invoice_almost_paid','invoice_unpaid','invoice_paid'));
}
else if($userDetail->role_id==3){
   
    $orders = Order::where('representative_id','=',$userDetail->id)->get();

    
    if ($orders->isEmpty()==true) {

        $orders=[new Request(['category_id'=>0,
    
     
    ])];
        
       }
       $payments = Payment::where('representative_id','=',$userDetail->id)->get(); 
       if ($payments->isEmpty()==true) {

        $payments=[new Request(['pay_date'=>0,

    'amount'=>0,
     
    ])];
        
       } 
$exporter = User::where('role_id','=',1)->get();
$importer = User::where('role_id','=',2)->get();
$representative = User::where('role_id','=',3)->get();

return view('users.representative_profile',compact('userDetail','payments','orders','exporter','importer','representative'));

}
 


}



}
