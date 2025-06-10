<?php

namespace App\Http\Controllers;

use App\Models\ProductCompany;
use App\Models\User;
use Illuminate\Http\Request;

class ProductCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $productCompany = ProductCompany::all();
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

        return view('company.company',compact('productCompany','exporter', 'importer','representative'));
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
        $validatedData = $request->validate([
            'company_name' => 'required|unique:product_companies|max:255',
          'country_of_manufacture' => 'required|max:255',
        ],[

            'company_name.required' =>'يرجي ادخال اسم الشركة',
            'company_name.unique' =>'هذه الشركة موجودة بالفعل',
            'country_of_manufacture.required' =>'يرجي ادخال بلد المنشأ,'

        ],
       
    
    );
        

        ProductCompany::create([
                'company_name' => $request->company_name,
                'country_of_manufacture' => $request->country_of_manufacture,
              

            ]);
            session()->flash('Add', 'تم اضافة القسم بنجاح ');
            return redirect('/companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCompany  $productCompany
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCompany $productCompany)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCompany  $productCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCompany $productCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCompany  $productCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'company_name' => 'required|max:255|unique:product_companies,company_name,'.$id,
          'country_of_manufacture' => 'required|max:255',
        ],[

            'company_name.required' =>'يرجي ادخال اسم الشركة',
            'company_name.unique' =>'هذه الشركة موجودة بالفعل',
            'country_of_manufacture.required' =>'يرجي ادخال بلد المنشأ,'

        ],);

        $productCompany = ProductCompany::find($id);
        $productCompany->update([
            'company_name' => $request->company_name,
            'country_of_manufacture' => $request->country_of_manufacture,
        ]);

        session()->flash('edit','تم تعديل الشركة بنجاج');
        return redirect('/companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCompany  $productCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        ProductCompany::find($id)->delete();
        session()->flash('delete','تم حذف الشركة بنجاح');
        return redirect('/companies');
    }
}
