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
                <h4 class="content-title mb-0 my-auto">قاظمة الشحنات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                   الشحنات </span>
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

                                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                                        data-toggle="modal" href="#exampleModal">اضافة شحنة</a>
                    </div>
                    <div class="row">




                    <form action="/shipment_serch" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="row">

                    <div class="col-lg-3" id="type">
                            <p class="mg-b-10">تحديد الذبون</p><select class="form-control select2" name="importClint"
                               required >
                                <option value="{{ $typeimportClint->id ?? null }}" selected>
                                    {{ $typeimportClint->name ?? 'يرجى اختيار الذبون' }}
                                </option>
                 
                                @foreach ($importClints as $importClint)
                        <option value="{{ $importClint->id }}">{{ $importClint->name  }}</option>
                    @endforeach
                                  

                            </select>
               
              
                        </div>

                      <!-- col-4 -->

                        <div class="col-lg-3" id="start_at">
                            <label for="exampleFormControlSelect1">من تاريخ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                    name="start_at" placeholder="YYYY-MM-DD" type="text">
                            </div><!-- input-group -->
                        </div>

                        <div class="col-lg-3" id="end_at">
                            <label for="exampleFormControlSelect1">الي تاريخ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div><input class="form-control fc-datepicker" name="end_at"
                                    value="{{ $end_at ?? date('Y-m-d') }}" placeholder="YYYY-MM-DD" type="text">
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
								
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr>
                                    <th class="border-bottom-0" >رقم الشحنة</th>
                                    
                                    <th class="border-bottom-0">مارك</th>

                                  
                                    <th class="border-bottom-0">عدد الکرتین </th>
                                    
                                    <th class="border-bottom-0">تاريخ الشحن</th>
                                    <th class="border-bottom-0">عنوان الشحنة</th>

                                    <th class="border-bottom-0">رقم البارکن</th>
                                    <th class="border-bottom-0">اسم سائق اللانش</th>
                                    <th class="border-bottom-0">رقم سائق اللانش</th>
                                    <th class="border-bottom-0">اسم سائق البيكاب </th>


                                    
                                    <th class="border-bottom-0">رقم سائق البيكاب </th>
                                     
                                    


                                </tr>
                            </thead>
                            <tbody>
                            @if (isset($shipments))
                            <?php $i = 0; ?>
                            @foreach ($shipments as $x)
                                <?php $i++; ?>
                                <tr>
                                    <td  style="text-align: center;vertical-align: middle;" >{{ $i }}</td>
                                    <td style="text-align: center;vertical-align: middle;">{{ $x->mark }}</td>

                                 
                                    
                                       
                                        <td style="text-align: center;vertical-align: middle;color:rgb(207, 14, 14);"><a href="{{url('shipmentDeteile')}}/{{$x->id}}"style="text-align: center;vertical-align: middle;">
                                            {{$x->carton_number}}
                                            </a></td>
                                        
                                        
                                  
                                    <td style="text-align: center;vertical-align: middle;">{{ $x->shiping_date }}</td>

                                    <td style="text-align: center;vertical-align: middle;  " >{{ $x->marina_address }}</td>
                                    
                                    <td style="text-align: center;vertical-align: middle;  " >{{ $x->parking_number }}</td>
                                    
                                    <td style="text-align: center;vertical-align: middle;  " >{{ $x->Name_driver_lansh }}</td>
                                    <td style="text-align: center;vertical-align: middle;  " >{{ $x->number_driver_lansh }}</td>
                                    <td style="text-align: center;vertical-align: middle;  " >{{ $x->Name_driver }}</td>

                                    <td style="text-align: center;vertical-align: middle;  " >{{ $x->number_driver }}</td>

                                    


                                    
                                </tr>
                            @endforeach
                        </tbody>

                                @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>


<!--add-->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">اضافة شحنة للعميل</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> 
        
        <form action="{{ route('shipmentes.create') }}" method="get" method="get">
            {{ csrf_field() }}
            <div class="modal-body">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الرجاء تحديد العميل</label>
                <select name="clintId" id="clintId" class="form-control" required>
                    <option value="" selected disabled> --حدد الذبون--</option>
                    @foreach ($importClints as $importClint)
                        <option value="{{ $importClint->id }}">{{ $importClint->name  }}</option>
                    @endforeach
                </select>
              

             
            
                

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">تاكيد</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
        </form>
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
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>

  

    <script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();

</script>
	

@endsection
