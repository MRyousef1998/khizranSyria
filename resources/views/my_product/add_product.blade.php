@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
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
                    اضافة منتج</span>
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

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route("addProducts")}}"  method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                         <label for="inputName" class="control-label">طلبية استيرادها </label>
                                <select name="productorder" class="form-control SlectBox" 
                                   >
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد الطلبية</option>
                                    @foreach ($orders as $order)
                                        <option value="{{ $order->id }}"> {{ $order->importer->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                           <div class="col">
                          


                                <label for="inputName" class="control-label">الصنف</label>
                                <select name="productCategory" class="form-control SlectBox"
                                   required >
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
                                    onchange="console.log('change is firing')" required>
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
                                     required>
                                    <!--placeholder-->
                                    
                                
                                </select>
                               
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">العدد</label>
                                <div  style="text-align: center;vertical-align: middle;">
                                                                <div class="input-group quantity" style=" ">
                                                                    <div class="input-group-prepend decrement-btn" style="cursor: pointer">
                                                                        <span class="input-group-text" >-</span>
                                                                    </div>
                                                                    <input type="text" class="qty-input form-control  "  id= "qountity" name ="qountity"style="text-align: center;vertical-align: middle;" maxlength="4" max="10" value="0">
                                                                    <div class="input-group-append increment-btn" style="cursor: pointer">
                                                                        <span class="input-group-text"  >+</span>
                                                                    </div>
                                                                </div>
</div>
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">
 <div class="col">
                                <label for="inputName" class="control-label">العملة</label>
                        <select name="carency" class="form-control SlectBox" required
                           >
                           <!--placeholder-->
                           <option value="1"  >DHS</option>
                           <option value="2"  >GBP</option>

                           <option value="3" selected >EURO</option>
                          
                       </select>
                           
                          
                     


                      
                   </div>
                            <div class="col">
                                <label for="inputName" class="control-label">السعر </label>
                                <input type="text" class="form-control form-control-lg" id="primary_price"
                                    name="primary_price" title="يرجي ادخال السعر  "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>

                            
                            <div class="col">
                                <label for="inputName" class="control-label">العمولة</label>
                                <input type="text" class="form-control" id="Amount_Commission" name="Amount_Commission" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value=0  required>
                            </div>
                       

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            
                            <div class="col">
                                <label for="inputName" class="control-label">الحالة   </label>
                                <select name="status" id="status" class="form-control" onchange="myFunction()" required>
                                    <!--placeholder-->
                                    @foreach ($status as $statu)
                                        <option value="{{ $statu->id }}"> {{ $statu->status_name }}</option>
                                    @endforeach



                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">مكان التواجد   </label>
                                <select name="product_location" id="product_location" class="form-control" required>
                                    <!--placeholder-->
                                    <option value="1" >
                                    الافنراضي
                                </option>
                                <option value="1" >
                                    المستودع
                                </option>
                                <option value="2" >
                                   محل كبير 
                                </option>
                                <option value="3" >
                                    محل صغير
                                </option>



                                </select>
                            </div>



                                    <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="1"></textarea>
                            </div>
                        </div>

                        {{-- 5 --}}
                       

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
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

<script>

    
$(document).ready(function () {

$('.increment-btn').click(function (e) {
    e.preventDefault();
    var incre_value = $(this).parents('.quantity').find('.qty-input').val();

    var value = parseInt(incre_value, 10);
    value = isNaN(value) ? 0 : value;
    if(value<1001){
        value++;
        $(this).parents('.quantity').find('.qty-input').val(value);
  
    }
   

});

$('.decrement-btn').click(function (e) {

    e.preventDefault();
    var decre_value = $(this).parents('.quantity').find('.qty-input').val();
  
    var value = parseInt(decre_value, 10);
   
    value = isNaN(value) ? 0 : value;
    
    if(value>0){
        value--;
        $(this).parents('.quantity').find('.qty-input').val(value);
       
    
     
    }
   
});

});
</script>

@endsection
