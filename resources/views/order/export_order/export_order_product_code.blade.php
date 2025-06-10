@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    
@endsection

@section('title')
   
@stop
 
 
@section('page-header')
    <!-- breadcrumb -->

   
    
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تفاصیل مع اکواد</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')




    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">

      <div class="col-xl-12">
						<div class="card mg-b-20" >
							<div class="card-header pb-0">
                                     <div class="d-flex justify-content-between">

                    
                    </div>

                      <form action="/export_order_prodect_code_serch" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}


                    

                    <div class="row">
                        
                        <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">تحديد الصنف</p><select class="form-control select2" name="productCatgory"
                               required >
                                <option value="{{ $typeproductCatgories->id ?? null }}" selected>
                                    {{ $typeproductCatgories->category_name ?? 'يرجى اختيار الصنف' }}
                                </option>
                 
                                @foreach ($productCategories as $productCatgory)
                                <option value="{{ $productCatgory->id }}"> {{ $productCatgory->category_name }}</option>
                            @endforeach
                                

                            </select>
                        </div><!-- col-4 -->

                        <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">حالة التغليف</p><select class="form-control select2" name="box_status"
                                >
                                <option value="{{ $typeBoxCatgoriesId ?? null }}" selected>
                                {{ $typeBoxCatgoriesName ?? 'الكل' }} 
                                </option>
                 
                                <option value="1" >
                                مغلف 
                                </option>
                                
                                <option value="2" >
                               غير مغلف
                                </option>
                                

                            </select>
                        </div>
                        <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">حالة الشحن</p><select class="form-control select2" name="shipment_status"
                                >
                                <option value="{{$typeShipmentCatgoriesId ?? null}}" selected>
                                {{ $typeShipmentCatgoriesName ?? 'الكل' }} 
                                </option>
                 
                                <option value="1" >
                                مشحون  
                                </option>
                                
                                <option value="2" >
                               غير مشحون
                                </option>
                                

                            </select>
                        </div>
                        <input type="hidden" name="order_id" id="order_id" value="{{$order->id}}">
                        
                    </div><br>

                    <div class="row">
                        <div class="col-sm-1 col-md-1">
                            <button class="btn btn-primary btn-block">بحث</button>
                        </div>
                    </div>
                </form>


								
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                       
                        <table id="example" class="table key-buttons text-md-nowrap" >
                            <thead>
                                <tr>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  " >کود المنتج</th>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">الشركة</th>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">مكان التواجد</th>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">الحالة</th>
                                    
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">كود التغليف</th>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">تاريخ الشحن</th>

                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">سعر الشراء</th>
                                    
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">سعر المبيع</th>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">عمولة عميل التوزيع</th>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">العمليات</th>


                                </tr>
                            </thead>
                            @if (isset($machines))
                            <tbody>
                                
                             <?php $i = 0; ?>
                                @foreach ($machines as $x)
                                   
                                    <tr>  
                                       
                                        <td style="text-align: center;vertical-align: middle;">P{{ $x->products_id }}OR{{$order->id}}</td>

                             
                                      
                                        <td style="text-align: center;vertical-align: middle;">{{$x->company_name}} {{$x->product_name}} {{ $x->group_name }}</td>
                                        
                                        
                                        
                                        
                                        @if($x->value_location==1){
                                      <td style="text-align: center;vertical-align: middle;">المستودع</td>

                                        }
                                        @elseif ($x->value_location==2){
                                      <td style="text-align: center;vertical-align: middle;">محل كبير</td>
                                            
                                        }
                                        @else{
                                      <td style="text-align: center;vertical-align: middle;">محل صغير</td>

                                        }
                                        @endif
                                        <td style="text-align: center;vertical-align: middle;"> {{$x->status_name}}</td>
                                       
                                        @if($x->box_id!=null)
                                        <td>
                                           
                                           <span class="label text-success d-flex">
                                               <div class="dot-label bg-success ml-1"></div>{{ $x->box_code }}
                                           </span>                                       
                                         </td>
                                         @else
                                         <td>
                                           
                                           <span class="label text-danger d-flex">
                                               <div class="dot-label bg-danger ml-1"></div>غير مخصص
                                           </span>                                       
                                         </td>
                                         @endif



                                         @if($x->shipment_id!=null)
                                        <td>
                                           
                                           <span class="label text-success d-flex">
                                               <div class="dot-label bg-success ml-1"></div>{{ $x->shiping_date }}
                                           </span>                                       
                                         </td>
                                         @else
                                         <td>
                                           
                                           <span class="label text-danger d-flex">
                                               <div class="dot-label bg-danger ml-1"></div>غير مخصص
                                           </span>                                       
                                         </td>
                                         @endif
                                         <td style="text-align: center;vertical-align: middle;"> @can('الجرودات'){{$x->price_with_comm}}@endcan</td>
                                         
                                         <td style="text-align: center;vertical-align: middle;"> @can('الجرودات'){{$x->selling_price_with_comm}}@endcan</td>
                                         <td style="text-align: center;vertical-align: middle;">@can('الجرودات') {{$x->selling_price_with_comm-$x->selling_price}}@endcan</td>
                                        <td>
                                        
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                
                                                @if($x->statuses_id!=4) 
                                                @if($order->category_id!=4)  
                                                @if($x->box_id==null)
                                                    <a class="dropdown-item" 
                                                    data-id="{{ $x->products_id }}" data-order_id="{{ $order->id }}"
							                            	data-toggle="modal"
							                            	href="#capsalation"    
                                                     
                                                    
                                                    
                                                    ><i
                                                        class="text-success fas fa-check"></i>&nbsp;&nbsp;
                                                      
                                                    تغليف
                                                </a>
                                                @else 
                                                <a class="dropdown-item" 
                                                    data-id="{{ $x->products_id }}" data-order_id="{{ $order->id }}"
							                            	data-toggle="modal"
							                            	href="#capsalation"    
                                                     
                                                     
                                                    
                                                    ><i
                                                        class="text-success fas fa-check"></i>&nbsp;&nbsp;
                                                      
                                                    تعديل كود
                                                </a>
                                                @endif
                                                <a class="dropdown-item" 
								data-id="{{ $x->products_id }}" data-order_id="{{ $x->orders_id }}" 
								data-toggle="modal"
								href="#sharcapsalation" > <i
                                                        class="text-success fas fa-check"></i>&nbsp;&nbsp; تغليف مشترك</a>
                                                
                                                    @endif
                                                    <a class="dropdown-item"
								data-id="{{ $x->products_id }}" data-order_id="{{ $x->orders_id }}" data-product_price="{{ $x->selling_price_with_comm }}" 
								data-toggle="modal"
								href="#removeProdect" > <i
                                                    class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp; حذف المنتج </a>
                                             @else    
                                             <a class="dropdown-item" 
                                                    >
                                                      
                                                هذا المنتج محذوف
                                                </a>
                                                @endif
                                                

                                                    @can('الارباح')  <a class="dropdown-item"
                                                data-order_id="{{ $x->orders_id }}"
                                                data-id="{{ $x->products_id }}"
                                                data-toggle="modal"
                                                data-product_price="{{ $x->selling_price_with_comm }}"
                                                data-comation="{{ $x->selling_price_with_comm-$x->selling_price }}"
                                                href="#editProdect">
                                                    <i
                                                    class="text-success las la-pen"></i>&nbsp;&nbsp;تعديل سعر المبيع
                                                    </a> 
                                                    @endcan
                                                    

                                                

                                        </td>
                                        
                                    </tr>
                                @endforeach
                                </tbody>

@endif


                        </table>
                        
                    </div>
                </div>
            </div>
        </div>



    </div>


<!--update-->

           




    <!-- row closed -->
    </div>


    <!-- Container closed -->
    </div>
    <div class="modal fade" id="removeProdect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ازالة المنتج من الطلبية </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    
                    <form action="{{route("remove_product_fom_order")}}" method="post" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                           
                          

                          
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="order_id" id="order_id" value="">
                            <input type="hidden" name="place_delete" id="place_delete" value="2">

                                <label for="exampleInputEmail1">هل انت متأكد من ازالة المنتج؟ </label>
                                <div>
                                    <h6 style="color:red">سوف یتم ازالة قیمة هذا المنتج من الفاتورة الاساسية</h6>
                                    <input name="product_price" id="product_price"  readonly>
                              
                            </div>
                            
                           
                        
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade" id="editProdect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل سعر  منتج</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route("edit_price_product")}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="modal-body">
                            
                            

                           
                        <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="order_id" id="order_id" value="">
                            <input type="hidden" name="old_price" id="old_price" value="">
                            <input type="hidden" name="old_comation" id="old_comation" value="">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> السعر : يرجى الانتباه سيتم اقتطاع عمولة العميل من هذه القيمة </label>

                            <input type="text" class="price form-control" style="text-align: center;vertical-align: middle;"id="price"  name ="price" onchange="priceChange('price',this)"  maxlength="5"  value="0" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> العمولة : يرجى الانتباه هذه القيمة جزء من السعر الكلي </label>
                            <input type="text" class="price form-control" style="text-align: center;vertical-align: middle;"id="comation"  name ="comation" onchange="priceChange('price',this)"  maxlength="5"  value="0" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >


                       
                            
                            

                           

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">تعديل البيانات</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<!--CAPSALATION-->


    <div class="modal fade" id="capsalation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تغليف منتج</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            
            <form action="{{ route('box.store') }}" method="post" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                   
                  

                  
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="order_id" id="order_id" value="">
                    <input type="hidden" name="capsalation_from" id="capsalation_from" value="2">


                        <label for="exampleInputEmail1">كود المنتج</label>
                        <input type="text" class="form-control" id="box_code" name="box_code" required>
                   
                    
                   
                <br>
                    
                    <h5 class="card-title">المرفقات</h5>

                    <div class="col-sm-12 col-md-12">
                        <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                            data-height="70" />
                    </div><br>
                    <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">تاكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!--CAPSALATION-->
<div class="modal fade" id="sharcapsalation" name ='sharcapsalation' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">تغليف  منتج</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div> 
				
				<form  action="{{route("sharbox")}}"   method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="modal-body">
					   
					  

					  
						<input name="id" id="id" value="" hidden>
						<input name="order_id" id="order_id" value="" hidden>
						<input name="capsalation_from" id="capsalation_from" value="2" hidden>


						<div class="col">
							<label for="inputName" class="control-label">كود الصندوق المشترك</label>
							<select name="box_id" class="form-control SlectBox"
								>
								<!--placeholder-->
								<option value="" selected disabled>حدد  الصندوق</option>
								@foreach ($boxes as $box)
									<option value="{{ $box->id }}"> {{ $box->box_code }}</option>
								@endforeach
							</select>
						</div>
					   
						
					   
					<br>
						
						
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">تاكيد</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
					</div>
				</form>
			</div>
		</div>
	</div>


</div>



   
    <!-- main-content closed -->
@endsection
@section('js')

    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

  
    <script>
        $('#capsalation').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var order_id = button.data('order_id')
    
            
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #order_id').val(order_id);
           
        })
    
        $('#removeProdect').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var order_id = button.data('order_id')
        var product_price = button.data('product_price')
     
       
        
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #order_id').val(order_id);
        modal.find('.modal-body #product_price').val(product_price);
       
    })


    
    </script>

<script>
        $('#sharcapsalation').on('show.bs.modal', function(event) {
            
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var order_id = button.data('order_id')
            
            
        var modal = $(this)
        
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #order_id').val(order_id);
    
       
    })
    
    $('#editProdect').on('show.bs.modal', function(event) {
   
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var order_id = button.data('order_id')
        var product_price = button.data('product_price')
        var comation = button.data('comation')
       
        
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #order_id').val(order_id);
        modal.find('.modal-body #price').val(product_price);
        modal.find('.modal-body #old_price').val(product_price);
        modal.find('.modal-body #comation').val(comation);
   modal.find('.modal-body #old_comation').val(comation);
        })

    </script>

@endsection
