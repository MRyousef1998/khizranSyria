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
                                   

                      <form action="/order_prodect_code_serch" method="POST" role="search" autocomplete="off">
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
                            <p class="mg-b-10">حالة التغليف</p><select class="form-control select2" name="selling_status"
                                >
                                <option value="{{ $typeSeleingId ?? null }}" selected>
                                {{ $typeSeleingName ?? 'الكل' }} 
                                </option>
                 
                                <option value="1" >
                                غیر مباع 
                                </option>
                                
                                <option value="2" >
                               مباع
                                </option>
                                

                            </select>
                        </div>
                        <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">تحديد الحالة</p><select class="form-control select2" name="status"
                                >
                                <option value="{{ $typeStatus->id ?? null }}" selected>
                                    {{ $typeStatus->status_name ?? 'الكل' }}
                                </option>
                 
                                @foreach ($statuses as $status)
                                <option value="{{ $status->id }}"> {{ $status->status_name }}</option>
                            @endforeach
                                  

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
                                    
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">سعر الشراء بدون عمولة</th>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  "> عمولة</th>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  "> سعر الشراء مع العمولة</th>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">سعر المبيع</th>

                                    
                                    
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">العمليات</th>


                                </tr>
                            </thead>
                        
                            <tbody>
                                    @if (isset($machines))
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

                                        <td style="text-align: center;vertical-align: middle;">@can('الارباح')  {{$x->primary_price}}@endcan</td>
                                        <td style="text-align: center;vertical-align: middle;">@can('الارباح')  {{$x->price_with_comm-$x->primary_price}}@endcan</td>
                                        <td style="text-align: center;vertical-align: middle;">@can('الارباح')  {{$x->price_with_comm}}@endcan</td>
                                        <td style="text-align: center;vertical-align: middle;">@can('الارباح')  {{$x->selling_price_with_comm?? "غير مخصص"}}@endcan</td>
                                        <td>
                                     
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item"
								data-id="{{ $x->products_id }}" data-order_id="{{ $x->orders_id }}"
								data-id="{{ $x->products_id }}" data-product_name="{{ $x->product_name }}"

                                                data-company_name="{{ $x->company_name }}"
                                               
                                                data-product_g="{{ $x->group_name }}"
                                                {{-- data-group_id="{{ $x->group_id }}" --}}
                                              
                                                {{-- data-product_category_name ="{{ $x->category->category_name}}"
                                                data-product_category_id ="{{ $x->category->id}}" --}}



								data-toggle="modal"
								href="#submit1" class="btn btn-success"><i
                                class="text-success fas fa-check"></i>&nbsp;&nbsp; تأكيد </a>
@if($x->statuses_id!=4)
                                <a class="dropdown-item"
								data-id="{{ $x->products_id }}" data-order_id="{{ $x->orders_id }}"
								data-id="{{ $x->products_id }}" data-product_name="{{ $x->product_name }}"

                                                data-company_name="{{ $x->company_name }}"
                                               
                                                data-product_g="{{ $x->group_name }}"
                                                {{-- data-group_id="{{ $x->group_id }}" --}}
                                                data-image-name ="{{ $x->image_name}}"
                                                {{-- data-product_category_name ="{{ $x->category->category_name}}"
                                                data-product_category_id ="{{ $x->category->id}}" --}}



								data-toggle="modal"

								href="#unsubmit" ><i
                                class="text-success fas fa-error"></i>&nbsp;&nbsp;  عدم وصول</a>
                               
                                <a class="dropdown-item"
								data-id="{{ $x->products_id }}" data-order_id="{{ $x->orders_id }}"
								data-id="{{ $x->products_id }}" data-product_name="{{ $x->product_name }}"

                                                data-company_name="{{ $x->company_name }}"
                                               
                                                data-product_g="{{ $x->group_name }}"
                                                {{-- data-group_id="{{ $x->group_id }}" --}}
                                                data-image-name ="{{ $x->image_name}}"
                                                {{-- data-product_category_name ="{{ $x->category->category_name}}"
                                                data-product_category_id ="{{ $x->category->id}}" --}}



								data-toggle="modal"

								href="#delete_product" ><i
                                class="text-success fas fa-error"></i>&nbsp;&nbsp;  حذف</a>
                                @endif
                                @can('الارباح')    <a class="dropdown-item"
                                data-order_id="{{ $x->orders_id }}"
                                data-id="{{ $x->products_id }}"
                                data-toggle="modal"
                                data-primary_price="{{ $x->primary_price }}"
                                data-comation="{{$x->price_with_comm-$x->primary_price}}"
                                href="#editProdect">
                                    <i
                                    class="text-success las la-pen"></i>&nbsp;&nbsp;تعديل سعر 
                                    </a>  @endcan
                                               
                                                </div>
                                            </div>
                                           

                                        </td>
                                        
                                    </tr>
                                @endforeach
                                @endif

                                </tbody>
 


                        </table>
                       
                    </div>
                </div>
            </div>
        </div>



    </div>


<!--update-->

           

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
                    <form action="{{route("edit_price_product_import")}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="modal-body">
                            
                            

                           
                        <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="order_id" id="order_id" value="">
                            <input type="hidden" name="old_price" id="old_price" value="">
                            <input type="hidden" name="old_comation" id="old_comation" value="">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">السعر بدون عمولة</label>
                            <input type="text" class="price form-control" style="text-align: center;vertical-align: middle;"id="price"  name ="price" onchange="priceChange('price',this)"  maxlength="5"  value="0" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">  عمولة</label>
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
<div class="modal fade" id="submit1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">تأكبد استلام منتج</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action='{{ route('submit_product') }}' method="post" enctype="multipart/form-data">
           
            {{ csrf_field() }}
            <div class="modal-body">


                <input type="hidden" class="form-control" name="company_id" id="company_id" value="">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الشركة المصنعة</label>
                <input type="text" class="form-control" name="company_name" id="company_name" readonly required>

                <div class="form-group">
                    <label for="title">اسم المنتج :</label>

                    <input type="hidden" class="form-control" name="id" id="id" value="">
                    <input type="hidden" class="form-control" name="order_id" id="order_id" value="">
                    <input type="text" class="form-control" name="product_name" id="product_name" readonly required>
                </div>
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الفئة</label>
                <input type="text" class="form-control" name="group_name" id="group_name" value="" readonly>
                <input type="hidden" class="form-control" name="supmit_from" id="supmit_from" value="2">
                
               

               

               

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"> تأكبد</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
        </form>
    </div>
</div>
</div>


<div class="modal fade" id="unsubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> منتج لم یصل </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action='{{ route('unsubmit_product') }}' method="post" enctype="multipart/form-data">
                       
                        {{ csrf_field() }}
                        <div class="modal-body">


                            <input type="hidden" class="form-control" name="company_id" id="company_id" value="">
                            <input type="hidden" class="form-control" name="unsubmit_from" id="unsubmit_from" value="2">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الشركة المصنعة</label>
                            <input type="text" class="form-control" name="company_name" id="company_name" readonly required>

                            <div class="form-group">
                                <label for="title">اسم المنتج :</label>

                                <input type="hidden" class="form-control" name="id" id="id" value="">
                                <input type="hidden" class="form-control" name="order_id" id="order_id" value="">
                                <input type="text" class="form-control" name="product_name" id="product_name" readonly required>
                            </div>
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الفئة</label>
                            <input type="text" class="form-control" name="group_name" id="group_name" value="" readonly>

                            
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">سيتم حذف المنتج من قائمة المحل دون حذف قيمته من الفاتورة</label>

                           
                            
                            

                           

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"> تأكبد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade" id="delete_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> منتج لم یصل </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action='{{ route('delete_product') }}' method="post" enctype="multipart/form-data">
                       
                        {{ csrf_field() }}
                        <div class="modal-body">


                            <input type="hidden" class="form-control" name="company_id" id="company_id" value="">
                            <input type="hidden" class="form-control" name="unsubmit_from" id="unsubmit_from" value="2">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الشركة المصنعة</label>
                            <input type="text" class="form-control" name="company_name" id="company_name" readonly required>

                            <div class="form-group">
                                <label for="title">اسم المنتج :</label>

                                <input type="hidden" class="form-control" name="id" id="id" value="">
                                <input type="hidden" class="form-control" name="order_id" id="order_id" value="">
                                <input type="text" class="form-control" name="product_name" id="product_name" readonly required>
                            </div>
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الفئة</label>
                            <input type="text" class="form-control" name="group_name" id="group_name" value="" readonly>

                            

                           
                            
                            

                           

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"> تأكبد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <!-- row closed -->
    </div>


    <!-- Container closed -->
    </div>

<!--CAPSALATION-->

   
<!--CAPSALATION-->

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
        $('#submit1').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var product_name = button.data('product_name')
            var company_name = button.data('company_name')
            var order_id = button.data('order_id')
            
            var id = button.data('id')
            
            var productG = button.data('product_g')
            
            

        
            
            var modal = $(this)
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #company_name').val(company_name);
            modal.find('.modal-body #group_name').val(productG);
            modal.find('.modal-body #order_id').val(order_id);
           
            


            modal.find('.modal-body #id').val(id);
        })
        $('#editProdect').on('show.bs.modal', function(event) {
   
   var button = $(event.relatedTarget)
   var id = button.data('id')
   var order_id = button.data('order_id')
   var product_price = button.data('primary_price')

   var comation = button.data('comation')
   
   var modal = $(this)
   modal.find('.modal-body #id').val(id);
   modal.find('.modal-body #order_id').val(order_id);
   modal.find('.modal-body #price').val(product_price);
   modal.find('.modal-body #old_price').val(product_price);
   modal.find('.modal-body #comation').val(comation);
   modal.find('.modal-body #old_comation').val(comation);
   })

   $('#unsubmit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var product_name = button.data('product_name')
            var company_name = button.data('company_name')
            var order_id = button.data('order_id')
            
            var id = button.data('id')
            
            var productG = button.data('product_g')
            
            

        
            
            var modal = $(this)
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #company_name').val(company_name);
            modal.find('.modal-body #group_name').val(productG);
            modal.find('.modal-body #order_id').val(order_id);
           
            


            modal.find('.modal-body #id').val(id);
        })

        $('#delete_product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var product_name = button.data('product_name')
            var company_name = button.data('company_name')
            var order_id = button.data('order_id')
            
            var id = button.data('id')
            
            var productG = button.data('product_g')
            
            

        
            
            var modal = $(this)
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #company_name').val(company_name);
            modal.find('.modal-body #group_name').val(productG);
            modal.find('.modal-body #order_id').val(order_id);
           
            


            modal.find('.modal-body #id').val(id);
        })
   
	
    </script>

	

@endsection
