<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductWithFavoriteRecource;
use App\Models\Product;

use App\Models\ProductCategory;
use App\Models\favotit;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
class ProductesController extends Controller
{
    public function get_productes_with_category(Request $request){

    //return $request;
       
       $favorite_list=favotit::where("user_id",$request->user_id)->get();
      

        $machines_of_this_category =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->where("products.value_location",'=',3)->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->category_id)->where("products.selling_date", null)
        ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name,product_details.rate,product_details.discraaption,product_details.online_price')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name','product_details.rate','product_details.discraaption','product_details.online_price')->get();
     
        $final_machines=[];
        foreach($machines_of_this_category as $machines_of_this_category1)
      {
       
        if(is_null(favotit::where("user_id",$request->user_id)->where("product_details_id",$machines_of_this_category1->id)->first()))
        {
    
           $machines_of_this_category1->favorit=0;
           $machines_of_this_category1->avileble=1;
            
        }
        else{
           
            $machines_of_this_category1->favorit=1;
            $machines_of_this_category1->avileble=1;
        }
        
        array_push($final_machines,$machines_of_this_category1);
      }


    
        $allData['machines_of_this_category']=ProductWithFavoriteRecource::collection( $final_machines) ;
       

        $allData["status"]="success";

        return $allData; 
    }



    public function search_product(Request $request){

    // search in allllll product
         
         $favorite_list=favotit::where("user_id",$request->user_id)->get();
        
  
          $machines_of_this_category =DB::table('product_details')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
          
          ->where('company_name', 'like', '%' . $request->searchText . '%')->orWhere('product_name', 'like', '%' . $request->searchText . '%')->orWhere('group_name', 'like', '%' . $request->searchText . '%')
          ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,product_details.image_name,product_details.rate,product_details.discraaption,product_details.online_price')
          ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name','product_details.rate','product_details.discraaption','product_details.online_price')->get();
       
          $final_machines=[];
          
          foreach($machines_of_this_category as $machines_of_this_category1)
        {
         
          if(is_null(favotit::where("user_id",$request->user_id)->where("product_details_id",$machines_of_this_category1->id)->first()))
          {
      
             $machines_of_this_category1->favorit=0;
              
          }
          else{
             
              $machines_of_this_category1->favorit=1;
          }

          if(is_null(Product::where("product_details_id",$machines_of_this_category1->id)->where("selling_date",null)->first()))
          {
      
             $machines_of_this_category1->avileble=0;
              
          }
          else{
             
              $machines_of_this_category1->avileble=1;
          }
          
          array_push($final_machines,$machines_of_this_category1);
        }
        
        $allData=ProductWithFavoriteRecource::collection($final_machines) ;
//return $allData;
        // $array = $allData->map(function($obj){
        //   return (array) $obj;
        // })->toArray();
        $my_final_array=[];
      foreach($allData as $data){
        $my_final_array[]= $data;
        

      }
    
        $searchResult = $this->paginate($my_final_array);
        return $searchResult;
      
          
         
  
      
          
  
    
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
// $items = $items instanceof Collection ? $items : Collection::make($items);

// return new LengthAwarePaginator(array_values($items->forPage($page, $perPage)
//     ->toArray()), $items->count(), $perPage, $page, $options);