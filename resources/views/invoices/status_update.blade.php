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
    تغير حالة الدفع
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تغير حالة الدفع</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Status_Update') }}" method="post" autocomplete="off"   enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{-- 1 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input type="hidden" name="invoice_id" value="{{ $invoices->id }}">
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" value="{{ $invoices->id }}" required
                                    readonly>
                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoices->invoice_Date }}" required readonly>
                            </div>

                            <div class="col">
                                <label>تاريخ الاستحقاق</label>
                                <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoices->Due_date }}" required readonly>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">العمیل </label>
                                <select name="clint" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" readonly>
                                    <!--placeholder-->
                                    <option value=" {{ $order->importer->id }}">
                                        {{ $order->importer->name }}
                                    </option>

                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">عن طلبية رقم</label>
                                <select id="order_id" name="product" class="form-control" readonly>
                                    <option value="{{ $order->id }}"> {{ $order->id }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">قيمة الفاتورة الاجمالية بدون دفعات</label>
                                <input type="text" class="form-control form-control-lg" id="primery_total"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoices->Total }}" required readonly>
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            

                            <div class="col">
                                @php
                                if(empty($invoices_detailes[0]))
                                $payment_pefor =  0 ;
                                else
                                $payment_pefor = $invoices_detailes[0]->amount_payment_pefor ;
                                @endphp
                                <label for="inputName" class="control-label">الدفعات السابقة</label>
                                <input type="text" class="form-control form-control-lg" id="payment_pefor" name="payment_pefor"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $payment_pefor }}" required readonly>
                            </div>

                            <div class="col">
                                @php
                                
                                $amount_payment_remining =  $invoices->Total-$payment_pefor ;
                              
                                @endphp
                                <label for="inputName" class="control-label">المبلغ المتبقي </label>
                                <input type="text" class="form-control form-control-lg" id="amount_payment_remining" name="amount_payment_remining"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{  $amount_payment_remining }}" required readonly>
                            </div>

                            
                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">قيمة الدفعة الجديدة</label>
                                <input type="text" class="form-control" id="new_payment" name="new_payment"
                                    value="{{ $amount_payment_remining }}"  onchange="new_payment_change()" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الاجمالي المتبقي بعد الدفع</label>
                                <input type="text" class="form-control" id="Total_after_new_payment" name="Total_after_new_payment" readonly
                                    value="0">
                            </div>
                        </div>
                       
                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                 <br>

                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">المرفقات</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                        </div>
                      
                        
                        <br>
                                
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">حالة الدفع</label>
                                <select class="form-control" id="Status" name="Status" onchange="change_states()" required>
                                    
                                    <option value="1">مدفوعة</option>
                                    <option value="2">مدفوعة جزئيا</option>
                                </select>
                            </div>

                            <div class="col">
                                <label>تاريخ الدفع</label>
                                <input class="form-control fc-datepicker" name="Payment_Date" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">الدفع من خلال </label>
                                <select name="paymentType" class="form-control SlectBox" 
                                  >
                                    <!--placeholder-->
                                    <option value="1" selected>
                                     كاش
                                    </option>
                                    <option value="2">
                                     بنك
                                    </option>

                                </select>
                            </div>

                            <div class="col">
                            <label for="exampleTextarea">ملاحظات</label>
                            <textarea class="form-control" id="exampleTextarea" name="note" rows="1" >
                            {{ $invoices->note }}</textarea>
                            </div>
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">تحديث حالة الدفع</button>
                        </div>

                    </form>
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
        function change_states() {
            var Status=document.getElementById("Status").value;
            var amount_payment_remining=document.getElementById("amount_payment_remining").value;
            
            if(Status==1){
   

                document.getElementById("new_payment").setAttribute('readonly',true);
                document.getElementById("new_payment").value=amount_payment_remining;
                document.getElementById("Total_after_new_payment").value=0;
 }
 else{
    
    document.getElementById("new_payment").removeAttribute('readonly');
    
  
 }
            
        }

    </script>
    <!-- <script>-->
    <!--    function new_payment_change() {-->


    <!--        var new_payment=parseFloat(document.getElementById("new_payment").value);-->

    <!--        var amount_payment_remining=parseFloat(document.getElementById("amount_payment_remining").value);-->
    <!--        alert(new_payment);-->
    <!--        alert(amount_payment_remining);-->
    <!--        if(new_payment>amount_payment_remining){-->

    <!--            alert("المبلغ المدفوع اكبر من المبلغ المطلوب ");-->
    <!--            document.getElementById("new_payment").value=0;-->
    <!--            document.getElementById("Total_after_new_payment").value=amount_payment_remining-0;-->
    <!--        }-->
    <!--        else if(new_payment==amount_payment_remining){-->
    <!--            alert("الفاتورة سوف تكون مدفوعة بشكل كامل");-->
    <!--            document.getElementById("Status").value=1;-->
    <!--            document.getElementById("new_payment").setAttribute('readonly',true);-->
    <!--            document.getElementById("Total_after_new_payment").value=0;-->
    <!--        }-->
    <!--        else  document.getElementById("Total_after_new_payment").value=amount_payment_remining-new_payment;-->
          
            
           
            
    <!--    }-->

    <!--</script>-->
@endsection

