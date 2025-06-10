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
    تفاصيل الشحنة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الشحنات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل الشحنة</span>
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
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات
                                                    الشحنة</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">الصناديق</a></li>
                                          
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">


                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">رقم الشحنة</th>
                                                            <td>{{ $shipment->id }}</td>
                                                            <th scope="row">اسم العمیل</th>
                                                            <td>{{ $shipment->importer->name }}</td>
                                                             <th scope="row">مارك</th>
                                                            <td>{{$shipment->mark }}</td>
                                                            <th scope="row">عدد الکراتین</th>
                                                            <td>{{ $shipment->carton_number  }}</td>
                                                            <th scope="row">تاريخ الشحن</th>
                                                            <td>{{ $shipment->shiping_date }}</td>
                                                            <th scope="row">عنوان المرسى</th>
                                                            <td>{{ $shipment->marina_address  }}</td>
                                                            
                                                            
                                                            
                                                           
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">رقم البارکن</th>
                                                            <td>{{ $shipment->parking_number }}</td>
                                                            <th scope="row">اسم سائق اللانش</th>
                                                            <td>{{ $shipment->Name_driver_lansh }}</td>
                                                            <th scope="row">رقم سائق اللانش</th>
                                                            <td>{{ $shipment->number_driver_lansh }}</td>
                                                            <th scope="row">اسم سائق البيكاب</th>
                                                            <td>{{ $shipment->Name_driver }}</td>
                                                            <th scope="row">رقم سائق البيكاب</th>
                                                            <td>{{ $shipment->number_driver }}</td>
                                                        </tr>


                                                       
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab5">
                                            <div class="table-responsive ">
                                              
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr>
                                     <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle; " >رقم </th>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">كود الصندوق</th>
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">عدد المحتوى</th>
                                                             

                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php $i = 0;
                                
                                
                                ?>
                                @foreach (  $boxes as $x)
                                <?php $i++; ?>
                                    <div class="all_row">
                                    <tr>
                                        
                                        <td style="text-align: center;vertical-align: middle; width:5"><input type="checkbox"  value="{{ $x->boxId }}" class="box1" id="box_id" name="box_id"  ></td>
                                        <td  style="text-align: center;vertical-align: middle; background-color:rgb(11, 107, 16);width:5" >{{ $i }}</td>
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
                                        </div>


                                                     
                                        <div class="tab-pane" id="tab6">
                                            <!--المرفقات-->
                                            <div class="card card-statistics">
                                                
                                                    <div class="card-body">
                                                     @if ($shipment->image_name=="")
                                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">اضافة مرفقات</h5>
                                                        <form method="post" action="{{route("addAttachmentsShipment")}}" 
                                                            enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            
                                                            <div class="custom-file">
                                                            
                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                    name="file_name" required>
                                                                <input type="hidden" id="shipment_id" name="shipment_id"
                                                                    value="{{$shipment->id}}">
                                                                
                                                                <label class="custom-file-label" for="customFile">حدد
                                                                    المرفق</label>
                                                            </div><br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm "
                                                                name="uploadedFile">تاكيد</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                
                                                <br>
                                                 @if ($shipment->image_name=="")
                                                                <div>
                                                               
                                                                
                                                                <span
                                                                        class="text-muted mt-1 tx-13 mr-2 mb-0">لا يوجد مرفقات</span>
                                                                </div>
                                                           
                                                            @else

                                                <div class="table-responsive mt-15">
                                                     <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0 table table-hover"
                                                        style="text-align:center">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th scope="col">م</th>
                                                                <th scope="col">اسم الملف</th>
                                                                
                                                                <th scope="col">العمليات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                                    
                                                               
                                                            
                                                         <tr>
                                                                    <td>####</td>
                                                                    <td>{{ $shipment->image_name }}</td>
                                                                    
                                                                    <td>{{ $shipment->created_at }}</td>
                                                                    <td colspan="2">

                                                                        <a class="btn btn-outline-success btn-sm"
                                                                            href="{{ url('View_file_sipment') }}/{{ $shipment->id }}/{{ $shipment->image_name }}"
                                                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                            عرض</a>

                                                                        <a class="btn btn-outline-info btn-sm"
                                                                            href="{{ url('download_file_sipment') }}/{{ $shipment->id  }}/{{ $shipment->image_name }}"
                                                                            role="button"><i
                                                                                class="fas fa-download"></i>&nbsp;
                                                                            تحميل</a>

                                                                       
                                                                            <button class="btn btn-outline-danger btn-sm"
                                                                                data-toggle="modal"
                                                                                data-image_name="{{ $shipment->image_name}}"
                                                                                data-shipment_id="{{ $shipment->id }}"
                                
                                                                                data-target="#delete_file">حذف</button>
                                                                        

                                                                    </td>
                                                                </tr>
                                                            <?php $i = 0; ?>
                                                            @foreach ($shipment as $attachment)
                                                                <?php $i++; ?>
                                                               
                                                            @endforeach
                                                        </tbody>
                                                  
                                                    </table>
                                                              @endif  
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
            </div>
            <!-- /div -->
        </div>

    </div>
    <!-- /row -->
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
                <form action="{{route('delete_file_sipment')}}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                        <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                        </p>

                        
                        <input type="hidden" name="image_name" id="image_name" value="">
                        <input type="hidden" name="shipment_id" id="shipment_id" value="">

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
    
    <!-- Container closed -->



    
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
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
           
            var image_name = button.data('image_name')
            var shipment_id = button.data('shipment_id')
            var modal = $(this)

            
            modal.find('.modal-body #image_name').val(image_name);
            modal.find('.modal-body #shipment_id').val(shipment_id);
        })


        $('#capsalation').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var order_id = button.data('order_id')

        
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #order_id').val(order_id);
       
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
