<?php

namespace App\Http\Controllers;

use App\Models\AccountStatement;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AccountStatementType;
use App\Models\BankAccountStatements;
use App\Models\HomeStatments;

class AccountStatementReport extends Controller
{
    public function index(){
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

        return view('reports.account_statment_report',compact('exporter', 'importer','representative',));
           
       }
   
       public function Search_Payment(Request $request){
      
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       $rdio = $request->rdio;
       $type =AccountStatementType::find( $request->type);
 
    // في حالة البحث بنوع الفاتورة
       
       if ($rdio == 1) {
          
          
    // في حالة عدم تحديد تاريخ
           if ($request->type && $request->start_at =='' && $request->end_at =='') {
               
              $details = AccountStatement::select('*')->where('account_statement_types_id','=',$request->type)->get();
            
              return view('reports.account_statment_report',compact('exporter', 'importer','representative','type','details'));
           }
           
           // في حالة تحديد تاريخ استحقاق
           else {
              
             $start_at = date($request->start_at);
             $end_at = date($request->end_at);
             
            
             $details = AccountStatement::whereBetween('pay_date',[$start_at,$end_at])->where('account_statement_types_id','=',$request->type)->orderBy('pay_date',)->get();
             return view('reports.account_statment_report',compact('exporter', 'importer','representative','type','start_at','end_at','details'));
             
           }
   
    
           
       } 
       
   //====================================================================
       
   // في البحث برقم الفاتورة
       else {
           
           $details = AccountStatement::select('*')->where('id','=',$request->invoice_number)->get();
           
           return view('reports.account_statment_report',compact('exporter', 'importer','representative','details'));
           
       }
   
       
        
       }
       public function bank_index(){
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

        return view('reports.bank_statment_report',compact('exporter', 'importer','representative',));
           
       }
   
       public function bank_Search_Payment(Request $request){
      
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       $rdio = $request->rdio;
       $type =AccountStatementType::find( $request->type);
       if($type->id==3){
        $type->type_name="ايداعات خارجية";
       }
 
    // في حالة البحث بنوع الفاتورة
       
       if ($rdio == 1) {
          
          
    // في حالة عدم تحديد تاريخ
           if ($request->type && $request->start_at =='' && $request->end_at =='') {
               
              $details = BankAccountStatements::select('*')->where('account_statement_types_id','=',$request->type)->get();
            
              return view('reports.bank_statment_report',compact('exporter', 'importer','representative','type','details'));
           }
           
           // في حالة تحديد تاريخ استحقاق
           else {
              
             $start_at = date($request->start_at);
             $end_at = date($request->end_at);
             
            
             $details = BankAccountStatements::whereBetween('pay_date',[$start_at,$end_at])->where('account_statement_types_id','=',$request->type)->orderBy('pay_date',)->get();
             return view('reports.bank_statment_report',compact('exporter', 'importer','representative','type','start_at','end_at','details'));
             
           }
   
    
           
       } 
       
   //====================================================================
       
   // في البحث برقم الفاتورة
       else {
           
           $details = BankAccountStatements::select('*')->where('id','=',$request->invoice_number)->get();
           
           return view('reports.bank_statment_report',compact('exporter', 'importer','representative','details'));
           
       }
   
       
        
       }




       ////

       public function home_index(){
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

        return view('reports.home_statment_report',compact('exporter', 'importer','representative',));
           
       }
   
       public function home_Search_Payment(Request $request){
      
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       $rdio = $request->rdio;
       $type =AccountStatementType::find( $request->type);
       if($type->id==3){
        $type->type_name="ايداعات خارجية";
       }
 
    // في حالة البحث بنوع الفاتورة
       
       if ($rdio == 1) {
          
          
    // في حالة عدم تحديد تاريخ
           if ($request->type && $request->start_at =='' && $request->end_at =='') {
               
              $details = HomeStatments::select('*')->where('account_statement_types_id','=',$request->type)->get();
            
              return view('reports.home_statment_report',compact('exporter', 'importer','representative','type','details'));
           }
           
           // في حالة تحديد تاريخ استحقاق
           else {
              
             $start_at = date($request->start_at);
             $end_at = date($request->end_at);
             
            
             $details = HomeStatments::whereBetween('pay_date',[$start_at,$end_at])->where('account_statement_types_id','=',$request->type)->orderBy('pay_date',)->get();
             return view('reports.home_statment_report',compact('exporter', 'importer','representative','type','start_at','end_at','details'));
             
           }
   
    
           
       } 
       
   //====================================================================
       
   // في البحث برقم الفاتورة
       else {
           
           $details = HomeStatments::select('*')->where('id','=',$request->invoice_number)->get();
           
           return view('reports.home_statment_report',compact('exporter', 'importer','representative','details'));
           
       }
   
       
        
       }

       //
}
