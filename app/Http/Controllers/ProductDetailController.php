<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\ProductCompany;
use App\Models\ProductGroup;



use App\Models\ProductDetail;
use App\Models\User;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $productDetail = ProductDetail::all();
        $productCompany = ProductCompany::all();
        $productGroups = ProductGroup::all();
        $productCategoies = ProductCategory::all();
  
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();


        return view('my_product.all_product',compact('productCompany','productGroups',"productCategoies",'exporter', 'importer','representative'));
    }
    public function all_product_serch (Request $request)
    {

        if($request->productGroup!=null && $request->productCompany!=null ){
            $productDetail = ProductDetail::where("category_id",$request->productCatgory)->where("company_id",$request->productCompany)->where("group_id",$request->productGroup)->get();
          }
        else if($request->productGroup!=null){
            $productDetail = ProductDetail::where("category_id",$request->productCatgory)->where("group_id",$request->productGroup)->get();
            
            
        }
       else if( $request->productCompany!=null ){
        $productDetail = ProductDetail::where("category_id",$request->productCatgory)->where("company_id",$request->productCompany)->get();
    }
            else{
                $productDetail = ProductDetail::where("category_id",$request->productCatgory)->get();
 

            }
          
    
            $productCompany = ProductCompany::all();
            $productGroups = ProductGroup::all();
            $productCategoies = ProductCategory::all();
$typeproductGroupes=ProductGroup::find($request->productGroup);
$typeproductCompanies=ProductCompany::find($request->productCompany);
$typeproductCatgories=ProductCategory::find($request->productCatgory);
$id=$request->productCatgory;
 $exporter = User::where('role_id','=',1)->get();
 $importer = User::where('role_id','=',2)->get();
 $representative = User::where('role_id','=',3)->get();

 return view('my_product.all_product',compact('typeproductGroupes','typeproductCompanies','typeproductCatgories','productDetail','productCompany','productGroups',"productCategoies",'exporter', 'importer','representative'));

 
    

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
       
        $input =$request->all();
        $p_exists=ProductDetail::where('product_name','=',$input['product_name'])->where('group_id','=',$input['productG'])->exists();
        if ($p_exists){
            session()->flash('Erorr', 'هذا المنتج موجود بالفعل ');
          //  return $request;
            return redirect('all_product');
        }
        $this->validate($request,['pic'=>'required'],['pic.required'=>"يرجى ادراج مرفق"]);
        
         $validatedData = $request->validate([
            'product_name' => 'required|max:255',
          'productG' => 'required',
          "productC"=>'required',

        ],[

            'product_name.required' =>'يرجي ادخال اسم المنتج',
            'productG.required' =>'يرجي ادراج الصنف ',

            
            'productC.required' =>'يرجي الشركة المصنعة,'

        ],
       
    
    );
   
    if($request->pic!=null){
            
  
      
       
       $imageName = $request->pic;
       $fileName = $imageName->getClientOriginalName();
       ProductDetail::create([
        'product_name' => $request->product_name,
        'company_id' => $request->productC,
        'image_name' =>  $fileName,
        'group_id' => $request->productG,
        'category_id' => $request->productCategory,

    ]);
// move pic
$product_id = ProductDetail::latest()->first()->id;

$request->pic->move(public_path('Attachments/' . $product_id ), $fileName);
   

    session()->flash('Add', 'تم اضافة المنتج بنجاح ');
    return redirect('/all_product');
      
   
}


session()->flash('Erorr', 'حدث خطأ غير متوقع  ');
//  return $request;
  return redirect('all_product');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ProductDetail $productDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductDetail $productDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductDetail $productDetail)
    { 
      
        
        $input =$request->all();
       
        $company_id = ProductCompany::where('company_name', $request->company_name)->first()->id;
        $category_id = ProductCategory::where('category_name', $request->product_category_name)->first()->id;
        $group_id = ProductGroup::where('group_name', $request->productG)->first()->id;

        
        $fileName=null;
        if($request->pic!=null){
        $imageName = $request->pic;
        $fileName = $imageName->getClientOriginalName();}
        $p_exists=ProductDetail::where('product_name','=',$input['product_name'])->where('group_id','=',$group_id)->where('company_id','=',$company_id)
        ->where('category_id','=',$category_id)->where('id','!=',$input['id'])->exists();
        if ($p_exists){
            session()->flash('Erorr', 'هذا المنتج موجود بالفعل ');
           
            return redirect('all_product');
        }

       
        $validatedData = $request->validate([
           'product_name' => 'required|max:255',
          
        ],[

            'product_name.required' =>'يرجي ادخال اسم المنتج',       ],
       
    
    );

        if($fileName==null){
        

        $Products = ProductDetail::findOrFail($request->id);
 
        $Products->update([
        'product_name' => $request->product_name,
        'company_id' => $company_id,
        'group_id' => $group_id,
        'category_id' => $category_id,
        'rate' => $request->rating	,
        'discraaption' => $request->discraaption,

        ]);
 
        session()->flash('Edit', 'بدون تعديل صورة تم تعديل المنتج بنجاح' );
        return redirect('/all_product');
    }


        if($fileName!=null){
           

            $Products = ProductDetail::findOrFail($request->id);
           
            $Products->update([
            'product_name' => $request->product_name,
            'company_id' => $company_id,
            'group_id' => $group_id,
            'image_name' =>  $fileName,
            'category_id' => $category_id,
            ]);
           
            
         
     // move pic
    
     
     $request->pic->move(public_path('Attachments/' . $Products->id ), $fileName);
        
     
         session()->flash('Add', 'تم تعديل المنتج بنجاح ');
         return redirect('/all_product');
           
        
     }
     
     
     session()->flash('Erorr', 'حدث خطأ غير متوقع  ');
     //  return $request;
       return redirect('all_product');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        session()->flash('delete', 'لايمكن حذف هذه المنتجات ');
        return redirect('all_product');
    }
}
