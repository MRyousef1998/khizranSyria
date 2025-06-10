<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class OrderDetailController extends Controller
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
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    { 
        $order = Order::findOrFail($request->order_id);
        $order->image_name="";
        $order->update();
        Storage::disk('public_uploads')->delete($request->order_id.'/'.$request->image_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }
    public function addAttachments(Request $request)
    {
        $imageName = $request->file_name;
        $fileName = $imageName->getClientOriginalName();
        
        $order = Order::findOrFail($request->order_id);
        $order->image_name=$fileName;
        $order->update();
        $request->file_name->move(public_path('Attachments/' . $request->order_id ), $fileName);
        
        session()->flash('delete', 'تمت اضافة المرفق بنجاح');
        return back();
    }
    

    public function get_file($orderNumber,$file_name)

    {
        $contents= Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($orderNumber.'/'.$file_name);
        return response()->download( $contents);
    }



    public function open_file($orderNumber,$file_name)

    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($orderNumber.'/'.$file_name);
        return response()->file($files);
    }
}
