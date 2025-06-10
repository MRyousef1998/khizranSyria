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
   اصدار فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الطلبيات </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اصدار فاتورة</span>
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
                    <form action="{{route("invoices.store")}}"  method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            
                            <div class="col">
                                         <label for="inputName" class="control-label">نوع الفاتورة </label>
                                <select name="invoice_category" id="invoice_category" class="form-control SlectBox" 
                                   >
                                    <!--placeholder-->
                                    <option value="{{$invoice_category->id}}" selected >{{$invoice_category->category_name}}</option>
                                   
                                </select>
                            </div>

                           <div class="col">
                          
                            @if ($invoice_category->id == 1)
                            <label for="inputName" class="control-label">المطلوب من السيد</label>
                        
                        @else
                        <label for="inputName" class="control-label">المورد</label>
                        @endif

                                
                                <select name="clint_id" class="form-control SlectBox"
                                    >
                                    <!--placeholder-->
                                    <option value="{{$order->id}}" selected >{{$order->importer->name}}</option>
                                    
                                </select>
                            </div>
                            <div class="col">
                                <label>تاريخ اصدار الفاتورة </label>
                                <input class="form-control appearance-none   w-full"type="date"  name="invoice_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" required>
                            
                    

                        </div>
                    </div>
                        {{-- 2 --}}
                        <div class="row">
                          
                            <div class="col">
                                <label for="inputName" class="control-label">القيمة الاساسية للفاتورة </label>
                                <input type="text" class="form-control form-control-lg" id="Amount_collection"
                                    name="Amount_collection" value="{{$order->Total}}"
                                    readonly>
                                </div>
                            <div class="col">
                                <label for="inputName" class="control-label">خصم</label>
                                <input type="text" class="form-control form-control-lg" id="Discount"
                                    name="Discount" value="{{$invoice->Discount?? 0}}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onchange="myFunction()"
                                    required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">القیمة النهائية </label>
                                <input type="text" value="{{$order->Total}}" class="form-control" id="Total" name="Total" readonly>
                            </div>
                        

                            
                        </div>



                        
                                    <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="5"></textarea>
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
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>

    <script>
        $(document).ready(function() {
            $('select[name="productCompanies"]').on('change', function() {
                var productCompaniesId = $(this).val();
                if (productCompaniesId) {
                    $.ajax({
                        url: "{{URL::to('products')}}/" + productCompaniesId,
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
        function myFunction() {

            var Amount_collection = parseFloat(document.getElementById("Amount_collection").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            

            var total = Amount_collection - Discount;


            total = parseFloat(total).toFixed(2);
               

               

                document.getElementById("Total").value = total;

           

        }

    </script>



@endsection
