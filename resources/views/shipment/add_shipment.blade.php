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
                    <form  action="{{ route('shipmentes.store') }}" method="post" name="form" id="form" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                           

                           <div class="col">
                          


                                <label for="inputName" class="control-label">المستورد</label>
                                <select name="clints" class="form-control SlectBox"
                                    required>
                                    <!--placeholder-->
                                    
                                    @foreach ($importClints as $importClint)
                                        <option value="{{ $importClint->id }}"> {{ $importClint->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label" >مارك</label>
                                <input type="text" class="form-control form-control-lg" id="Mark" name="Mark" value="">
                            </div>
                            <div class="col">
                                <label>التاريخ  </label>
                                <input class="form-control appearance-none block w-full" type="date" name="sipment_date" value="{{ date('Y-m-d') }}" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>
                         

                        </div>

               

                        {{-- 3 --}}

                    
                            

                        

                    
                        {{-- 4 --}}
                        
                       

                        <div class="row">
                            
                            <div class="col">
                                <label for="marce" class="control-label">عنوان المرسى</label>
                                <input type="text" class="form-control form-control-lg" id="marce"
                                    name="marce" title="يرجي ادخال عنوان المرسى "
                                   
                                    required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label" >رقم الباركن</label>
                                <input type="text" class="form-control form-control-lg" id="parking_number" name="parking_number" value=0 oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"onchange="finalTotal('total1')" onchange="calTotal()">
                            </div>

                       
                        </div>
                        

                        {{-- 5 --}}
                        <div class="row">
                            <input name="my_hidden_input" id="my_hidden_input" hidden
                            >
                            <div class="col">
                                <label for="naghda_name" class="control-label">اسم سائق اللانش</label>
                                <input type="text" class="form-control form-control-lg" id="naghda_name"
                                    name="naghda_name" title="يرجي ادخال عنوان المرسى "
                                   
                                    required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label" >رقم سائق اللانش</label>
                                <input type="text" class="form-control form-control-lg" id="naghda_number" name="naghda_number" value=0 oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"onchange="finalTotal('total1')" onchange="calTotal()">
                            </div>

                            <div class="col">
                                <label for="driving_name" class="control-label">اسم سائق البيكاب</label>
                                <input type="text" class="form-control form-control-lg" id="driving_name"
                                    name="driving_name" title="يرجي ادخال عنوان المرسى "
                                   
                                    required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label" >رقم سائق البيكاب</label>
                                <input type="text" class="form-control form-control-lg" id="driving_number" name="driving_number" value=0 oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"onchange="finalTotal('total1')" onchange="calTotal()">
                            </div>

                       
                        </div>
                        
                        <br>

                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">المرفقات</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                        </div>
                      
                        
                        <br>
                            
                        <div class="col-xl-12">
                            <div class="card mg-b-20">
                                <div class="card-header pb-0">
                             
                                </div>
                                <div class="card-body">
                                   
                                    <div class="table-responsive">
                                        <table id="example" class="table key-buttons text-md-nowrap" data-page-length='500'>
                                            <thead>
                                                <tr>
                                                     <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" hidden/></th>
                                            
                                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">كود الصندوق</th>
                                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">عدد المحتوى</th>
                                                                             
                
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php $i = 0; ?>
                                                @foreach ($boxes as $x)
                                                <?php $i++; ?>
                                                    <div class="all_row">
                                                    <tr>
                                                        
                                                        <td style="text-align: center;vertical-align: middle; width:5"><input type="checkbox"  value="{{ $x->boxId }}" class="box1" id="box_id" name="box_id"  ></td>
                                                    
                                                        <td style="text-align: center;vertical-align: middle;">{{ $x->box_code }}</td>
                
                                                        <td class="cart-product-quantity" width="130px" style="text-align: center;vertical-align: middle;">
                                                            <a class="modal-effect " data-effect="effect-scale" 
                                                            data-id="{{ $x->boxId }}" 
                                                            data-toggle="modal" href="#modaldemo9" >{{ $x->count_insaid }}</a>
                                                    </td>
                                                      
                                                       
                
                                                   

                                                         
                                                        
                                                        
                                                    </tr>
                                                </div>
                                               
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>


                                    <div class="d-flex justify-content-center">
                                        <button  class="" onclick="sandData()">حفظ البيانات</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body main-content-body-right border">
                      
                            </div>
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
        
       
//         const zIndex = 1040 + 10 * $('.modal:visible').length;
// $(this).css('z-index', zIndex);
// setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
        var button = $(event.relatedTarget)
        var id = button.data('id')
        
      
        
        $.ajax({
        type : 'GET',
      
        url :"{{URL::to('box_insaid_detailes/')}}?box_id="+id,
        
        success: function(result) {
           
            $('#modaldemo9 div.modal-body').html(result);
        }
    });
        
       // modal.find('.modal-body #company_name').innerHTML = "yourTextHere";
    })

</script>



     <script>
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
   <script>
    function sandData() {
        
        var order = new  Array();
        
        

        $("#example input[type=checkbox]:checked").each(function() {
            
            var item = { id:this.value
                                
                                 };

            order.push(item);

       
            
        });
          document.getElementById('my_hidden_input').value = JSON.stringify(order);
          
            
            document.getElementById('form').submit();

    }

</script>
    
@endsection
