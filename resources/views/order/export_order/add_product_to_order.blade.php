@extends('layouts.master')
<style>
    table,
    table td {
      border: 0.5px solid #cccccc;
    }
    td {
      height: 80px;
      width: 160px;
      text-align: center;
      vertical-align: middle;
    }
  </style> 
@section('css')
 <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
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
    
    .modal-lg {
        width:'95';
        
    }
    
    
@endsection

@section('title')
  اضافة طلبية 
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">طلبيات الاستيراد</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة طلبية</span>
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
    @if (session()->has('Erorr'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('Erorr') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    @if (session()->has('Edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Edit') }}</strong>
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

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="/machine_serch_to_export_order" method="POST" role="search" autocomplete="off">
                        {{ csrf_field() }}
    
    
                        <input class=""type="hidden"  name="order_id" 
                                    type="text" value="{{$order_id}}" required>
    
                        <div class="row">
                            
                            <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                                <p class="mg-b-10">تحديد الصنف</p><select class="form-control select" name="productCatgory"
                                   required >
                                    <option value="{{ $typeproductCatgories->id ?? null }}" selected>
                                        {{ $typeproductCatgories->category_name ?? 'يرجى اختيار الصنف' }}
                                    </option>
                               
                                    @foreach ($productCatgories as $productCatgory)
                                    <option value="{{ $productCatgory->id }}"> {{ $productCatgory->category_name }}</option>
                                @endforeach
                                    
    
                                </select>
                            </div><!-- col-4 -->
    
    
                            <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                                <p class="mg-b-10">تحديد الشركة</p><select class="form-control select" name="productCompany"
                                    >
                                    <option value="{{ null }}" >
                                        {{ 'الکل' }}
                                    </option>
                                    
                                    @foreach ($productCompanies as $productCompany)
                                    <option value="{{ $productCompany->id }}"> {{ $productCompany->company_name }}</option>
                                @endforeach
                                    
    
                                </select>
                            </div><!-- col-4 -->
                            <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                                <p class="mg-b-10">تحديد الحالة</p><select class="form-control select" name="productstatus"
                                    >
                                    <option value="{{ $typeproductStatus->id ?? null }}" selected>
                                        {{ $typeproductStatus->status_name ?? 'الكل' }}
                                    </option>
                                    @if($typeproductStatus != null)
                                    <option value="{{ null }}" >
                                        {{ 'الکل' }}
                                    </option>
                                    @endif
                                    @foreach ($status as $statu)
                                    <option value="{{ $statu->id }}"> {{ $statu->status_name }}</option>
                                @endforeach
    
                                    
    
                                </select>
                            </div><!-- col-4 -->
    
    
                             <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                                <p class="mg-b-10">تحديد مكان التواجد</p><select class="form-control select" name="productGroup"
                                    >
                                    <option value="{{ null }}" selected>
                                        {{  'الکل' }}
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
                            </div><!-- col-4 -->
    
                            <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                                <p class="mg-b-10">تحديد طلبية الاستيراد</p><select class="form-control select" name="importOrder"
                                    >
                                    <option value="{{ null }}" selected>
                                        {{  'الکل' }}
                                    </option>
                                    <option value="{{ $typeOrder->id ?? null }}" selected>
                                        {{ $typeOrder->order_date ?? 'الكل' }} {{ $typeOrder->importer->name ?? '' }}
                                    </option>
                                    @if($typeOrder != null)
                                   
                                @endif
                                    @foreach ($importOrder as $myImportOrder)
                                    <option value="{{ $myImportOrder->id }}"> {{ $myImportOrder->order_date }} {{$myImportOrder->importer->name}}</option>
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
            </div>
       

    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="/add_export_order_one_by_one"  method="post" name="form"id="form"enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        

                        <input name="typeproductCatgories" value="{{$typeproductCatgories->id ?? null}}" hidden>
                                    <input name="typeproductGroupes" value="{{$typeproductGroupes->id ?? null}}" hidden>
                                    <input name="typeproductCompanies" value="{{$typeproductCompanies->id ?? null}}" hidden>
                                    <input name="typeproductStatus" value="{{$typeproductStatus->id ?? null}}" hidden>
                                    <input name="typeproductCatgories" value="{{$typeproductCatgories->id ?? null}}" hidden>
                                    <input name="typeproductOrder" value="{{$typeOrder->id ?? null}}" hidden>
                           <input class=""type="hidden"  name="order_id" 
                                    type="text" value="{{$order_id}}" required>
                                    <input name="my_hidden_input" id="my_hidden_input" hidden
                                    >
                                    
                                    
                  <div class="table-responsive">
                                      
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='5000'>
                        <thead>
                            <tr>
                                 <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                                <th class="border-bottom-0" style="text-align: center;vertical-align: middle; " >رقم المنتج</th>
                                <th class="border-bottom-0"  style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">الشركة</th>
                                <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">اسم المنتج</th>
                                <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">الصنف</th>
                                
                                <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">بلد المنشأ</th>
                                <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">العدد المتاح</th>

                                <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">العدد</th>
                                <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">السعر</th>
                                <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">العمولة</th>
                                <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">السعر الاجمالي</th>                                 
    
                            </tr>
                        </thead>
                        @if (isset($machines))
                        <tbody>
                            
                            <?php $i = 0; ?>
                            @foreach ($machines as $x)
                                <?php $i++; ?>
                                <div class="all_row">
                                <tr>
                                    
                                    <td style="text-align: center;vertical-align: middle; width:5"><input type="checkbox"  value="{{ $x->id }}" class="box1" id="box1" name="box1"  ></td>
                                    <td  style="text-align: center;vertical-align: middle; background-color:rgb(11, 107, 16);width:5" >{{ $i }}</td>
                                    <td style="text-align: center;vertical-align: middle;">{{ $x->company_name }}</td>
    
                                    <td style="text-align: center;vertical-align: middle;">
                                        
                                        <div class = "vertical"   ><div>
                                            <img src="Attachments/{{ $x->id }}/{{ $x->image_name }}"  width="140"  height="80" /></div>
                                            <div>
                                                {{ $x->product_name }}</div>
                                        </div>
    
                                        
                                        </td>
                                  
                                    <td style="text-align: center;vertical-align: middle;">{{ $x->group_name }}</td>
    
                                    <td style="text-align: center;vertical-align: middle; color:rgb(207, 14, 14); " >{{ $x->country_of_manufacture }}</td>
                                    <td style="text-align: center;vertical-align: middle; color:rgb(207, 14, 14); " > <a class="modal-effect " data-effect="effect-scale"
                                        data-id="{{ $x->id }}" data-company_name="{{ $x->country_of_manufacture }}"
                                        data-toggle="modal" href="#modaldemo9" >{{ $x->aggregate }}</a></td>

                                    
                                    <td   style="text-align: center;vertical-align: middle;width:15% ;height:15%">
                                        <div class="input-group quantity" style=" ">
                                            <div class="input-group-prepend decrement-btn" style="cursor: pointer">
                                                <span class="input-group-text" >-</span>
                                            </div>
                                           
                                            <input type="text" class="qty-input form-control  "  id= "quntity" name ="quntity"style="text-align: center;vertical-align: middle;" maxlength="3" max="10" value="0">
                                            <div class="input-group-append increment-btn" style="cursor: pointer">
                                                <span class="input-group-text"  >+</span>
                                                
                                            </div>
                                           
                                        </div>
                                    </td>
    
    
    
    
                                 <td class="cart-product-quantity"  style="text-align: center;vertical-align: middle;width:15% ;height:15%">
                                        <div class="input-group" style=" ">
                                            
                                            <input type="text" class="price form-control" style="text-align: center;vertical-align: middle;"id="price"  name ="price" onchange="priceChange('price',this)"  maxlength="5"  value="0" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" readonly>
                                                
                                        </div>
                                        
                                    </td>
    
                                    <td class="cart-product-quantity"  style="text-align: center;vertical-align: middle;width:15% ;height:15%">
                                        <div class="input-group" style=" ">
                                        
                                           
                                            <input type="text" class="commission_pice form-control" style="text-align: center;vertical-align: middle;"id="commission_pice"  name ="commission_pice" onchange="priceChange('commission_pice',this)"  maxlength="5"  value="0" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required readonly>
                                            <input type="text" class="qtyy form-control" style="text-align: center;vertical-align: middle;"id="qtyy"  name ="qtyy" value="{{ $x->aggregate }}" hidden>

                                        </div>
                                        
                                    </td>
                                    <td class="cart-product-quantity"  style="text-align: center;vertical-align: middle;width:15% ;height:15%">
                                        <div class="input-group" style=" ">
                                            
                                            <input type="text" class="total_price form-control" style="text-align: center;vertical-align: middle;"id="total_price" name ="total_price" maxlength="5"  value="0" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"onchange="" required readonly>
                                            
                                        </div>
                                    </td>
    
                                     
                                    
                                    
                                </tr>
                            </div>
                           
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                    <div class="d-flex justify-content-center">
                        <button  class="" onclick="sandData()">إضافة</button>
                    </div>

                                    </div>
                               


                                            



                  

                                
                            </div>
                        </div>
                    </div>
                  
    
                </div>
     




               

                        </div>


                       

                           
                               
                                       
                         
                                    
                    
                    
                    
                        

                    </form>
                    
                </div>
            </div>
            
        </div>
    </div>


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





   
     <!-- Internal Select2 js-->
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
    $('#modaldemo9').on('show.bs.modal', function(event) {
        
        var button = $(event.relatedTarget)
        var id = button.data('id')
        
        var company_name = button.data('company_name')
        $.ajax({
        type : 'GET',
        url :"{{URL::to('export_productDetails')}}/" + id,

        success: function(result) {
          
            $('#modaldemo9 div.modal-body').html(result);
        }
    });
        
       // modal.find('.modal-body #company_name').innerHTML = "yourTextHere";
    })

</script>



<script>

    
$(document).ready(function () {

$('.increment-btn').click(function (e) {
    e.preventDefault();
    var incre_value = $(this).parents('.quantity').find('.qty-input').val();
    var price_elem=$(this).parent().parent().parent().find('.price');
    var com_price_elem=$(this).parent().parent().parent().find('.commission_pice');
    var qty_av=$(this).parent().parent().parent().find('.qtyy').val();

    
    var mycheck= $(this).parent().parent().parent().find('.box1');

    
    var total=0.0;
   


    var value = parseInt(incre_value, 10);
    value = isNaN(value) ? 0 : value;
    if(value<100 && value<qty_av){
        value++;
        $(this).parents('.quantity').find('.qty-input').val(value);

       

        mycheck.attr('checked', true);
      
       
       
         
      
        price_elem.removeAttr("readonly");
        com_price_elem.removeAttr("readonly");
        
        total=parseFloat(price_elem.val()*value )+parseFloat(com_price_elem.val()*value);
    
  
        
        var total_pirce_elem=$(this).parent().parent().parent().find('.total_price');
        
        total_pirce_elem.val(total);
        

        
    }

});

$('.decrement-btn').click(function (e) {

    e.preventDefault();
    var decre_value = $(this).parents('.quantity').find('.qty-input').val();
    var mycheck= $(this).parent().parent().parent().find('.box1');

    var value = parseInt(decre_value, 10);
    var price_elem=$(this).parent().parent().parent().find('.price');
    var com_price_elem=$(this).parent().parent().parent().find('.commission_pice');
    var total=0.0;
    value = isNaN(value) ? 0 : value;
    
    if(value>0){
        value--;
        $(this).parents('.quantity').find('.qty-input').val(value);
      
       

    
   
        total=parseFloat(price_elem.val()*value )+parseFloat(com_price_elem.val()*value);
        
       
        
        var total_pirce_elem=$(this).parent().parent().parent().find('.total_price');
        total_pirce_elem.val(total);
       
     
    }
    if(value==0){
         $(this).parent().parent().parent().find('.price').attr("readonly","true");
         $(this).parent().parent().parent().find('.commission_pice').attr("readonly","true");
         $(this).parent().parent().parent().find('.price').val(0);
         $(this).parent().parent().parent().find('.commission_pice').val(0);
         document.getElementById("total_price").value = 0;
         mycheck.attr('checked', false);
    }
});

});
</script>

<script>
        function sandData() {
       
           
            var order = new Array();
            
            

            $("#example1 input[type=checkbox]:checked").each(function() {
               
                var item = { id:this.value,qty: $(this).parent().parent().find('.qty-input').val(),
                               price:$(this).parent().parent().find('.price').val(),
                                commission_pice: $(this).parent().parent().find('.commission_pice').val(),

                                    
                                     };
                                     

                order.push(item);

           
                
            });
              document.getElementById('my_hidden_input').value = JSON.stringify(order);
             
              
                document.getElementById('form').submit();

        }

    </script>

<script>
        function priceChange(className,elem) {
            var qty= $(elem).parent().parent().parent().find('.qty-input').val();
            var price_elem= $(elem).parent().parent().parent().find('.price');
            var commission_pice=  $(elem).parent().parent().parent().find('.commission_pice');

            

            
                    total=parseFloat(price_elem.val()*qty )+parseFloat(commission_pice.val()*qty);
                    
                            
         
               
             // total=parseFloat(price_elem.val()*qty )+parseFloat(commission_pice.val()*qty);
                        

            
            
            $(elem).parent().parent().parent().find('.total_price').val(total);
                
           
            

        }

    </script>
     <script>
        function myFun(elem) {

            var quntity = parseFloat(document.getElementById("quntity").value);
             
            var pirce = parseFloat(document.getElementById("price").value);
            var commission_pice = parseFloat(document.getElementById("commission_pice").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var total_pirce = (pirce *quntity)+(commission_pice*quntity);


            if (typeof total_pirce === 'undefined'  ) {

                alert('يرجي ادخال مبلغ العمولة ');

            } 
            
            document.getElementById("total_price").value = total_pirce;
            var total_order=0;
             var total_commission=0;
        var total_elements=document.getElementsByClassName("total1");
        
        var commission_pice_elements=document.getElementsByClassName("commission_pice");
              

        var l=total_elements.length;

            for(var i=0;i<l;i++)
            {

           total_order=+total_elements[i].value;
           
           
            total_commission=+commission_pice_elements[i].value;
               
            }
           

            document.getElementById("Total").value =total_order+Value_VAT;
            document.getElementById("Amount_Commission").value =total_commission;




            
            {{-- else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                

                document.getElementById("Total").value = sumt;

            } --}}

        }

    </script>
    <script>

        function oneByone_check(){
            alert(document.getElementById("Amount_Commission").value);
document.getElementById("Amount_Commission").removeAttribute('readonly');
            
        }
        function all_check(){
           
document.getElementById("Amount_Commission").readOnly=true;
            
        }

  
function CheckAll(className,elem){

var elements=document.getElementsByClassName(className);
var l=elements.length;

if(elem.checked){
    for(var i=0;i<l;i++){

        elements[i].checked=true;

    }


}
else{
    for(var i=0;i<l;i++){
        elements[i].checked=false;
    }
}


}

    </script>
    <script type="text/javascript">
    $(function() {
        $("#btn").click(function() {
         
            var selected = new Array();

            $("#example1 input[type=checkbox]:checked").each(function() {
               

                selected.push(this.value);
            });
            
        });
    });
</script>
    
@endsection
