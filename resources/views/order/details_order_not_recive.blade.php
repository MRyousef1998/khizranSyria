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
    تفاصيل الطلبية
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">طلبيات {{$order->category->category_name}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                   الجرد والاستلام</span>
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


    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
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



    <!-- row opened -->
    <div class="row row-sm">

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
            <div class="card-header pb-0">
                                     <div class="d-flex justify-content-between">

                    <a href="add_produ_from_order/{{$order->id}}" class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                                > <i
                                class="fas fa-plus"></i>&nbsp; اضافة جديد</a>
                    </div>
                     </div>
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">


                                       

                                      
                                            <div class="table-responsive ">
                                              
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr>
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle; " >رقم المنتج</th>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">الشركة</th>
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">اسم المنتج</th>
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">الصنف</th>
                                    
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">بلد المنشأ</th>
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">العدد </th>


             

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($unAriveMAchine as $x)
                                    <?php $i++; ?>
                                    <tr>
                                        <td  style="text-align: center;vertical-align: middle; background-color:rgb(11, 107, 16);width:5" >{{ $i }}</td>
                                        <td style="text-align: center;vertical-align: middle;">{{ $x->company_name }}</td>

                                        <td style="text-align: center;vertical-align: middle;">
                                            
                                            <div class = "vertical"><div>
                                                <img src="http://khaizran2.online/Attachments/{{ $x->id }}/{{ $x->image_name }}"  width="180"  height="120" /></div>
                                                <div>
                                                    {{ $x->product_name }}</div>
                                            </div>

                                            
                                            </td>
                                      
                                        <td style="text-align: center;vertical-align: middle;">{{ $x->group_name }}</td>

                                        <td style="text-align: center;vertical-align: middle; color:rgb(207, 14, 14); " >{{ $x->country_of_manufacture }}</td>
                                        
                                      
                                        <td class="cart-product-quantity" width="130px" style="text-align: center;vertical-align: middle;">
                                            <a class="modal-effect " data-effect="effect-scale" 
                                            data-id="{{ $x->id }}" data-order_id="{{ $id }}"
                                            data-toggle="modal" href="#modaldemo9" >{{ $x->aggregate }}</a>
                                    </td>
                                       
                                      

                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                  
                                                


                                            </div>
                                        </div>

                                                  
                                           

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /div -->
        </div>

    </div>
    <!-- /row -->

    <!-- delete -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('delete_file')}}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                        <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                        </p>

                        
                        <input type="hidden" name="image_name" id="image_name" value="">
                        <input type="hidden" name="order_id" id="order_id" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                </form>
            </div>
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

                            
                           

                           
                            <h5 class="card-title">المرفقات</h5>
    
                            <div class="col-sm-12 col-md-12">
                                <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                    data-height="70" />
                            </div><br>
                            <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                            
                            

                           

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"> تأكبد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <!-- Container closed -->
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

<!--  closed -->

<div class="modal fade" id="submitall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">تأكبد استلام منتج</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action='{{ route('submit_all_product') }}' method="post" enctype="multipart/form-data">
           
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
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">العدد</label>
                <input type="text" class="form-control" name="count" id="count" value="" readonly>

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

<!-- Container closed -->
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



  <!-- Container closed -->
   
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تفاصيل الوصول</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                
                    </div>
        </div>
    </div>
    </div>
    </div>

    <!-- main-content closed -->
@endsection
@section('js')
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





    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            const zIndex = 1040 + 10 * $('.modal:visible').length;
  $(this).css('z-index', zIndex);
  setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
            var button = $(event.relatedTarget)
            var id = button.data('id')
            
            var order_id = button.data('order_id')
       
            $.ajax({
            type : 'GET',
          
            url :"{{URL::to('import_order_productDetails1/')}}?product_id="+id+"&order_id="+order_id,
            
            success: function(result) {
          
                $('#modaldemo9 div.modal-body').html(result);
            }
        });
            
           // modal.find('.modal-body #company_name').innerHTML = "yourTextHere";
        })
    
    </script>
    <script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
           
            var image_name = button.data('image_name')
            var order_id = button.data('order_id')
            var modal = $(this)

            
            modal.find('.modal-body #image_name').val(image_name);
            modal.find('.modal-body #order_id').val(order_id);
        })


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



        
        $('#submitall').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var product_name = button.data('product_name')
            var company_name = button.data('company_name')
            var order_id = button.data('order_id')
            
            var id = button.data('id')
            
            var productG = button.data('product_g')
            var count = button.data('count')
            

        
            
            var modal = $(this)
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #company_name').val(company_name);
            modal.find('.modal-body #group_name').val(productG);
            modal.find('.modal-body #order_id').val(order_id);
           
            modal.find('.modal-body #count').val(count);


            modal.find('.modal-body #id').val(id);
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
    </script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    </script>

@endsection
