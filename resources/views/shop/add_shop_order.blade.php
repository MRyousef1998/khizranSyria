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
                <h4 class="content-title mb-0 my-auto">طلبيات داخلية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
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
                    <form action="" method="post" name="form"id="form"enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                         <label for="inputName" class="control-label">نوع الطلبية   </label>
                                 <select name="order_category" class="form-control SlectBox"
                                    >
                                    <!--placeholder-->
                                    <option value="3" selected enabled>طلبية قطع للمحل</option>
                                   
                                </select>
                                    
                                   
                              


                               
                            </div>

                           <div class="col">
                          
                            <input name="my_hidden_input" id="my_hidden_input" hidden
                            >

                                <label for="inputName" class="control-label">الهدف</label>
                                <select name="importer" class="form-control SlectBox" 
                                    required>
                                    <!--placeholder-->
                                    <option value="3" selected >محل صغیر</option>
                                    @foreach ($importer as $importClint)
                                        <option value="{{ $importClint->id }}">تكملة لطلبية {{ $importClint->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col">
                                <label for="inputName" class="control-label"  onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')">عن طلبية رقم</label>
                                <select id="orderID" name="orderID" class="form-control" required>
                                    <option value="" selected disabled>حدد  الطلبية</option>
                                </select>
                            </div>
                         

                        </div>

               

                        {{-- 3 --}}

                      
                       
                            

                        

                    
                        {{-- 4 --}}
                        
                       


                        {{-- 5 --}}
                      
                        
                            
                        <div class="col-xl-12">
                            <div class=" mg-b-20">
                                <div class="card-header pb-0">
                             
                                </div>
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
                     
                                    <div class="table-responsive mt-15">
                                      
                                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
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
                                                                     
                        
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php $i = 0; ?>
                                                @foreach ($parts as $x)
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
                                                            <div class="input-group" style=" ">
                                                            
                                                               
                                                            
                                                                <input type="text" class="qtyy form-control" style="text-align: center;vertical-align: middle;"id="qtyy"  name ="qtyy" value="{{ $x->aggregate }}" hidden>
                                                                
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
      
                                                        
                                                    </tr>
                                                </div>
                                               
                                                @endforeach
                                            </tbody>
                                        </table>
          
                                        


                                    </div>
                                </div>

                                          
                                <div class="d-flex justify-content-center">
                                    <button  class="" onclick="sandData()">حفظ البيانات</button>
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

    var qty_av=$(this).parent().parent().parent().find('.qtyy').val();

    
    var mycheck= $(this).parent().parent().parent().find('.box1');

    
   
   


    var value = parseInt(incre_value, 10);
    value = isNaN(value) ? 0 : value;
    if(value<100 && value<qty_av){
        value++;
        $(this).parents('.quantity').find('.qty-input').val(value);

        

        mycheck.attr('checked', true);
      
       
       
         
      
       
       var clint=document.getElementById("clint").value;
    
   

        
    }

});

$('.decrement-btn').click(function (e) {

    e.preventDefault();
    var decre_value = $(this).parents('.quantity').find('.qty-input').val();
    var mycheck= $(this).parent().parent().parent().find('.box1');

    var value = parseInt(decre_value, 10);
    var price_elem=$(this).parent().parent().parent().find('.price');
    var total=0.0;
    value = isNaN(value) ? 0 : value;
    
    if(value>0){
        value--;
        $(this).parents('.quantity').find('.qty-input').val(value);
        var commission_pice= $(this).parent().parent().parent().find('.commission_pice');
       
       var clint=document.getElementById("clint").value;
    
    if(String(clint)!=""){
        
        if(!document.getElementById("com_all").checked){
         
           $(this).parent().parent().parent().find('.commission_pice').removeAttr("readonly");
           total=parseFloat(price_elem.val()*value )+parseFloat(commission_pice.val()*value);}
           else{
            total=parseFloat(price_elem.val()*value );
           }
          
         // total=parseFloat(price_elem.val()*value )+parseFloat(commission_pice.val()*value);
        }
        else{
            total=parseFloat(price_elem.val() )*value;
        }
       
        
        var total_pirce_elem=$(this).parent().parent().parent().find('.total_price');
        total_pirce_elem.val(total);
        calTotal();
     
    }
    if(value==0){
         $(this).parent().parent().parent().find('.price').attr("readonly","true");
         $(this).parent().parent().parent().find('.commission_pice').attr("readonly","true");

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
                              

                                    
                                     };
                                     

                order.push(item);

           
                
            });
              document.getElementById('my_hidden_input').value = JSON.stringify(order);
                
                document.getElementById('form').submit();

        }

    </script>


     
    <script>

        function oneByone_check(){
           
document.getElementById("Amount_Commission").removeAttribute('readonly');
            
        }
        function all_check(){
           
document.getElementById("Amount_Commission").readOnly=true;
            
        }

        function calTotal(){
            
            var elements_price=document.getElementsByClassName("total_price");
            var elements_commission=document.getElementsByClassName("commission_pice");
            var elements_qty=document.getElementsByClassName("qty-input");
            
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var l=elements_price.length;
           

          
           var total_price=0;
           var total_commission=0;
                for(var i=0;i<l;i++){

                    total_price+=parseFloat(elements_price[i].value);
                    total_commission+=parseFloat(elements_commission[i].value)*parseFloat(elements_qty[i].value);

                }

                if(!document.getElementById("com_all").checked){
                    document.getElementById("Amount_Commission").value =parseFloat(total_commission);
                    document.getElementById("Total").value =parseFloat(total_price)+Value_VAT;
          }
           else {

            document.getElementById("Total").value =parseFloat(total_price)+Value_VAT+parseFloat(document.getElementById("Amount_Commission").value);
           }
           
          


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
<script>
    $(document).ready(function() {
        $('select[name="importer"]').on('change', function() {
            var importer_id = $(this).val();
            if (importer_id) {
                if(importer_id==1){
                    $('select[name="orderID"]').append('<option value="' +
                                1 + '">' + 'serves' + '</option>');
                }
               else{
                $.ajax({
                    url: "{{URL::to('shop_exporter_order')}}/" + importer_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                       
                        $('select[name="orderID"]').empty();
                        $('select[name="orderID"]').append('<option value="" selected disabled>حدد  الطلبية</option>');
                        
                        $.each(data, function(key, value) {
                            $('select[name="orderID"]').append('<option value="' +
                                key + '">'+'('+key+')' + value + '</option>');
                        });
                    },
                });}

            } else {
                console.log('AJAX load did not work');
            }
        });

    });

</script>
@endsection
