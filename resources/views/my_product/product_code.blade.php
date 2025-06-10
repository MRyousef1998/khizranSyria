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
                                   

                      <form action="/prodect_code_serch" method="POST" role="search" autocomplete="off">
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
                            <p class="mg-b-10">مکان التواجد</p><select class="form-control select2" name="location"
                                >
                                <option value="{{ $typelocationId?? null }}" selected>
                                {{ $typelocationId ?? 'الكل' }} 
                                </option>
                 
                                <option value="1" >
                               المستودع
                                </option>
                                
                                <option value="2" >
                               محل کبیر
                                </option>
                                <option value="3" >
                                    محل صغیر
                                     </option>

                            </select>
                        </div>
                        <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">تحديد الحالة</p><select class="form-control select2" name="status"
                                >
                                <option value="{{ $typeStatus->id ?? null }}" selected>
                                    {{ $typeStatus->status_name ?? 'الكل' }}
                                </option>
                                <option value="{{ null }}" >
                                     الكل 
                                </option>
                                <option value="{{-1}}" >
                                    كل الصالح لبيع الجملة 
                               </option>
                                @foreach ($statuses as $status)
                                <option value="{{ $status->id }}"> {{ $status->status_name }}</option>
                            @endforeach
                                  

                            </select>
                        </div>
                        
                        
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

                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">ملاحظات</th>
                                    
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">العمليات</th>


                                </tr>
                            </thead>
                        
                            <tbody>
                                    @if (isset($machines))
                             <?php $i = 0; ?>
                                @foreach ($machines as $x)
                                   
                                    <tr>  
                                       
                                        <td style="text-align: center;vertical-align: middle;">P{{ $x->products_id }}OR</td>

                             
                                      
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
                                        <td style="text-align: center;vertical-align: middle;">{{$x->note?? " "}}</td>
                                       
                                        <td style="text-align: center;vertical-align: middle;" >
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    @if($x->statuses_id!=7 && $x->statuses_id!=0)
                                                    <a class="dropdown-item" data-effect="effect-scale"
                                                        data-products_id="{{ $x->products_id }}" 
                                                        data-status_id="{{ $x->statuses_id }}"
                                                        data-status_name="{{ $x->status_name}}"
                                                        
        
                                                   
        
                                                        
        
                                                        data-toggle="modal" href="#delete" title="نقل الى قائمة الكسر"><i
                                                            class="las la-pentext-warning fas fa-exchange-alt"></i>نقل الى قائمة الكسر</a>
                                                        @elseif($x->statuses_id==7)
                                                            <a class="dropdown-item" data-effect="effect-scale"
                                                            data-products_id="{{ $x->products_id }}" 
                                                           
                                          
                                                    
                                                            data-toggle="modal" href="#unbroken" title="استعادة الى الفائمة الاساسية"><i
                                                                class="las fa-exchange-alt"></i>استعادة من قائمة الکسر</a>
                                                            
        
        
        
                                                                
                                                        
                                                        @endif
         
                                                    <a class="dropdown-item" data-effect="effect-scale"
                                                    data-product_id="{{ $x->products_id }}" 
                                                  
                                                        data-toggle="modal" href="#update_location" title="حذف"><i
                                                            class="las fa-exchange-alt"></i>نقل القطعة الى فرع اخر</a>


                                                            <a class="dropdown-item" href="#update_status"
                                                                    data-product_id="{{ $x->products_id }}"
                                                                    data-toggle="modal"
                                                                        
                                                                        ><i
                                                                        class="text-success fas fa-check"></i>&nbsp;&nbsp;
                                                                    تغيير الحالة 
                                                                </a>

                                            
                                                   
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

           




<div class="modal fade" id="update_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">تغیر حالة المنتج</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action='update_status_product' method="post">
            {{ method_field('post') }}
            {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="product_id" id="product_id" value="">
                <input type="hidden" name="sybmit_from" id="sybmit_from" value="2">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الرجاء تحديد الحالة </label>
                <select name="status_id" id="status_id" class="form-control" required>
                    <option value="" selected disabled> --حدد الحالة--</option>
                    @foreach ($statuses as $Status)
                        <option value="{{ $Status->id }}">{{ $Status->status_name  }}</option>
                    @endforeach
                </select>
               
                

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">تعديل البيانات</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
        </form>
    </div>
</div>

</div>
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تحديد منتج كانقص قطع</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="product_set_proken" method="post">
                    
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من العملية  ؟</p><br>
                        <input type="hidden" name="products_id" id="products_id" value="">
                       <label for="exampleTextarea">ملاحظات</label>
                            <textarea class="form-control" id="note" name="note" rows="1"></textarea>
                         
                    </div>
                    <input type="hidden" name="sybmit_from" id="sybmit_from" value="2">
                            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="unbroken" tabindex="-1" role="dialog" aria-labelledby="delete"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">استعادة المنتج من قائمة النقص</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="product_remove_from_proken" method="post">
                    
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من العملية  ؟</p><br>
                        <input type="hidden" name="products_id" id="products_id" value="">
                        <input type="hidden" name="sybmit_from" id="sybmit_from" value="2">
                       <label for="exampleTextarea">ملاحظات</label>
                            <textarea class="form-control" id="note" name="note" rows="1"></textarea>
                         
                    </div>
                     
                            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="update_location" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تغیر حالة الطلبية</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action='update_location_product' method="post">
                {{ method_field('post') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="product_id" value="">
                    <input type="hidden" name="sybmit_from" id="sybmit_from" value="2">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الرجاء تحديد الموقع </label>
                    <select name="location_id" id="location_id" class="form-control" required>
                        <option value="" selected disabled> --حدد الموقع--</option>
                       
                            <option value="1">مسنودع</option>
                            <option value="2">محل كبير</option>
                            <option value="3">محل صغير</option>
                    </select>
                   
                    

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">تعديل البيانات</button>
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
        $('#update_location').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
           
           
            var product_id = button.data('product_id')
            var modal = $(this)
    
            
           
            modal.find('.modal-body #product_id').val(product_id);
        })
    </script>
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    
    </script>
    
    <script>
        
    
    </script>
    <script>
        $('#delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var products_id = button.data('products_id')
            var note = button.data('note')
            var modal = $(this)
            modal.find('.modal-body #products_id').val(products_id);
            modal.find('.modal-body #product_name').val(note);
        })
    
        $('#update_status').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
               
               
                var product_id = button.data('product_id')
                var modal = $(this)
    
                
               
                modal.find('.modal-body #product_id').val(product_id);
            })
    
    </script>
    <script>
        $('#unbroken').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            
            var products_id = button.data('products_id')
            var note = button.data('note')
            var modal = $(this)
            modal.find('.modal-body #products_id').val(products_id);
            modal.find('.modal-body #product_name').val(note);
        })
    </script>

@endsection
