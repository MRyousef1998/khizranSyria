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
                <h4 class="content-title mb-0 my-auto">طلبيات التصدير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                   الطلبيات </span>
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
                                     <div class="d-flex justify-content-between">

                    <a href="add_export_order" class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                                > <i
                                class="fas fa-plus"></i>&nbsp; اضافة طلبية تصدير جديدة </a>
                    </div>
<form action="/export_order_serch" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}

 

                    <div class="row">
                            <div class="col-lg-4">
                          <label for="inputName" class="control-label">المستورد</label>
                          <select name="exporter" class="form-control SlectBox"
                              >
                              <!--placeholder-->
                              <option value="" selected >الكل</option>
                              
                              @foreach ($exporter as $myexporter)
                                        <option value="{{ $myexporter->id }}"> {{ $myexporter->name }}</option>
                                    @endforeach
                          </select>
                      </div>
                        <div class="col-lg-4" id="start_at">
                            <label for="exampleFormControlSelect1">من تاريخ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <input class="form-control "type="date"  name="start_at" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $start_at ?? '' }}">
                               
                            </div><!-- input-group -->
                        </div>

                        <div class="col-lg-4" id="end_at">
                            <label for="exampleFormControlSelect1">الي تاريخ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <input class="form-control "type="date"  name="end_at" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $end_at ?? date('Y-m-d') }}" required>
                                
                               
                            </div><!-- input-group -->
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-sm-1 col-md-2">
                            <button class="btn btn-primary btn-block">بحث</button>
                        </div>
                    </div>
                </form>

								
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                     @if (isset($orders))
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr>
                                    <th class="border-bottom-0" >رقم الطلبية</th>
                                    <th class="border-bottom-0">المستورد</th>

                                  
                                    <th class="border-bottom-0">عدد المكنات </th>
                                    
                                    <th class="border-bottom-0">تاريخ الطلب</th>


                                    <th class="border-bottom-0">تاريخ المتوقع للشحن</th>
                                    <th class="border-bottom-0">العمولة</th>
                                    <th class="border-bottom-0">الضريبة</th>
                                    <th class="border-bottom-0">القيمة الاجمالية</th>


                                    
                                    <th class="border-bottom-0">الحالة</th>
                                     <th class="border-bottom-0">المرفق</th>
                                    


                                </tr>
                            </thead>

                            <tbody>
                                                    
                                                    <?php $i = 0; ?>
                                                    @foreach ($orders as $x)
                                                        <?php $i++; ?>
                                                        <div class="all_row">
                                                        <tr>
                                                            
                                                            <td  style="text-align: center;vertical-align: middle; color:rgb(250, 246, 246);background-color:rgb(36, 111, 182);width:0.5;" >{{ $i }}</td>
                                                            <td style="text-align: center;vertical-align: middle;">{{$x->importer->name}}</td>
                                                        

                    
                                                          
                                                            <td >
                                                            <a href="{{url('ExportOrderDetails')}}/{{$x->id}}"style="text-align: center;vertical-align: middle;">
                                                            {{ $x->countAllItem()}}
                                                            </a>
                                                            
                                                            
                                                            </td>
                    
                                                            <td style="text-align: center;vertical-align: middle;  " >{{ $x->order_date }}</td>
                                                            <td style="text-align: center;vertical-align: middle; " >{{ $x->order_due_date }}</td>
                                                            <td style="text-align: center;vertical-align: middle;  " >@can('الارباح') {{ $x->Amount_Commission }}@endcan</td>
                                                            <td style="text-align: center;vertical-align: middle;  " >@can('الارباح') {{ $x->Value_VAT }}@endcan</td>
                                                            <td style="text-align: center;vertical-align: middle;  " >@can('الارباح') {{ $x->Total }}@endcan</td>
                                                            
                                                            <td>
                                                            @if ($x->status->id==1)
                                                                <span class="text-danger">{{ $x->status->status_name }}</span>
                                                            
                                                            @elseif ($x->status->id==6)
                                                                <span class="text-success">{{ $x->status->status_name }}</span>
                                                            @else
                                                            
                                                                <span class="text-warning">{{ $x->status->status_name }}</span>
                                                                
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <div class="dropdown">
                                                                <button aria-expanded="false" aria-haspopup="true"
                                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                                <div class="dropdown-menu tx-13">
                                                                    <a class="dropdown-item" href="#update_status"
                                                                    data-order_id="{{ $x->id }}"
                                                                    data-toggle="modal"
                                                                        
                                                                        ><i
                                                                        class="text-success fas fa-check"></i>&nbsp;&nbsp;
                                                                     تغير الحالة
                                                                </a>
                                                                <a class="dropdown-item" href="{{url('export_order_prodect_code')}}/{{$x->id}}">
                                                                    <i
                                                                     class="text-success fas fa-check"></i>&nbsp;&nbsp;تفاصيل المنتجات  
                                                                                                                                   </a> 
                                                                
                                                                                                                                   @can('الارباح') 
                
                                                                       <a class="dropdown-item" href="#" data-order_id="{{ $x->id }}"
                                                                        data-toggle="modal" data-target="#delete"><i
                                                                            class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                                        الطلبية</a>
                @endcan
                
                                                                    
                                                                       
                                                                  
                
                                                                  
                                                                      
                                                                   
                
                                                                 
                                                                        
                                                                   
                                                                </div>
                                                            </div>
                
                                                        </td>


                                                             
                                                            
                                                            
                                                        </tr>
                                                    </div>
                                                   
                                                    @endforeach
                            </tbody>

                                
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>



    </div>


<!--update-->

           




    <!-- row closed -->
    </div>


    <!-- Container closed -->
    </div>
    <div class="modal fade" id="update_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تغیر حالة الطلبية</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action='update_status_order' method="post">
                {{ method_field('post') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="order_id" id="order_id" value="">

                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الرجاء تحديد الحالة </label>
                    <select name="status_id" id="status_id" class="form-control" required>
                        <option value="" selected disabled> --حدد الحالة--</option>
                        @foreach ($Statuses as $Status)
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
                        <h5 class="modal-title">حذف الطلبية</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="import_order/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="order_id" id="order_id" value="">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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

  
<script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
<!--Internal  pickerjs js -->
<script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();

</script>

<script>
    $('#update_status').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
       
       
        var order_id = button.data('order_id')
        var modal = $(this)

        
       
        modal.find('.modal-body #order_id').val(order_id);
    })

    $('#delete').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var order_id = button.data('order_id')
    var modal = $(this)
    modal.find('.modal-body #order_id').val(order_id);
  
})
</script>

@endsection
