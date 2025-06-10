@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    اضافة منتج
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    بحث عن المنتجات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

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
    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route("search_product_insaid_export_order_get")}}"  method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                         <label for="inputName" class="control-label">المستورد  </label>
                                <select name="exporter" class="form-control SlectBox" 
                                   >
                                    <!--placeholder-->
                                    <option value="{{null}}" selected >الكل</option>
                                    @foreach ($exporter as $my_exporter)
                                        <option value="{{$my_exporter->id}}">{{$my_exporter->name}}</option>
                                        
                                    @endforeach
                                </select>
                            </div>

                           <div class="col">
                          


                                <label for="inputName" class="control-label">الصنف</label>
                                <select name="productCategory" class="form-control SlectBox"
                                    >
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد  الصنف</option>
                                    @foreach ($productCatgories as $productCatgory)
                                        <option value="{{ $productCatgory->id }}"> {{ $productCatgory->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                              <div class="col">
                                <label for="inputName" class="control-label">الشركة المصنعة</label>
                                <select name="productCompanies" class="form-control select2" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" >
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد الشركة المصنعة</option>
                                     @foreach ($productCompanies as $productCompany)
                                        <option value="{{ $productCompany->id }}"> {{ $productCompany->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                         

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                          

                            <div class="col">
                                <label for="inputName" class="control-label"  onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')">المنتج</label>
                                <select id="product" name="product" class="form-control select2">
                                    <option value="" selected disabled>حدد  منتج</option>
                                </select>
                            </div>
                               <div class="col">
                            <label for="inputName" class="control-label">الفئة</label>
                                <select id="productClass" name="productClass" class="form-control"
                                     >
                                    <!--placeholder-->
                                    
                                
                                </select>
                               
                            </div>

                          
                        </div>


                        {{-- 3 --}}

     
                      
                        <?php echo '&nbsp;';
  ?>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">بحث</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- ///////////////////// -->
@if (isset($machines))
<div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
<div class="card-body">

                    <div class="table-responsive">
                       
                        <table id="example1" class="table key-buttons text-md-nowrap" >
                            <thead>
                                <tr>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  " >کود المنتج</th>
                                    
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">تفاصيل المنتج</th>
                                  
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">اسم العميل</th>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  "> رقم الطلبية</th>
                                  
                                 

                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">سعر الشراء</th>
                                    
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">سعر المبيع</th>
                                 
                                  

                                </tr>
                            </thead>
                            
                            <tbody>
                                
                             <?php $i = 0; ?>
                                @foreach ($machines as $x)
                                   
                                    <tr>  
                                       
                                        <td style="text-align: center;vertical-align: middle;">P{{ $x->products_id }}OR{{$x->orders_id}}</td>

                             
                                      
                                        <td style="text-align: center;vertical-align: middle;">{{$x->company_name}} {{$x->product_name}} {{ $x->group_name }}</td>
                                        
                                        <td>
                                        <span class="label text-danger d-flex">
                                                <div class="dot-label bg-danger ml-1"></div>{{$x->name}}
                                            </span>
                                    </td>
                                        
                                        <td style="text-align: center;vertical-align: middle;">{{$x->order_date}} => {{$x->orders_id}}  </td>
                                     


                                        
                                         <td style="text-align: center;vertical-align: middle;">{{$x->price_with_comm}}</td>
                                         
                                         <td style="text-align: center;vertical-align: middle;"> {{$x->selling_price_with_comm}}</td>
                                        
                                        
                                    </tr>
                                @endforeach
                                </tbody>

@endif


                        </table>
                        
                    </div>
                </div>
            
             
            




<!-- //////////////////// -->
    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
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

<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
<!--Internal  pickerjs js -->
<script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('select[name="productCompanies"]').on('change', function() {
                var productCompaniesId = $(this).val(); 
                var category_id=  $('select[name="productCategory"]').val();
               
                if (productCompaniesId) {
                   
                    $.ajax({
                        url: "{{URL::to('products')}}/" + productCompaniesId+"/"+category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                          
                            $('select[name="product"]').empty();
                            $('select[name="product"]').append('<option value="" selected disabled>حدد  منتج</option>');
                            
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>

   <script>
        $(document).ready(function() {
            $('select[name="product"]').on('change', function() {
                var productname = $(this).val();
                var category_id=  $('select[name="productCategory"]').val();
            
                if (productname) {
                    $.ajax({
                        url: "{{URL::to('productsgroup')}}/" + productname+"/"+category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="productClass"]').empty();
                            $.each(data, function(value,key) {
                                
                                $('select[name="productClass"]').append('<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        },
                    });


                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>

    <script>
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('يرجي ادخال مبلغ العمولة ');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("Value_VAT").value = sumq;

                document.getElementById("Total").value = sumt;

            }

        }

    </script>



@endsection
