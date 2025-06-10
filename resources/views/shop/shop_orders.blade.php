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
                <h4 class="content-title mb-0 my-auto">طلبيات المحل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
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

                    <a href="add_shop_order" class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                                > <i
                                class="fas fa-plus"></i>&nbsp; اضافة طلبية  جديدة </a>
                    </div>

								
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr>
                                    <th class="border-bottom-0" >رقم الطلبية  </th>
                                    <th class="border-bottom-0">المورد</th>

                                  
                                    <th class="border-bottom-0">عدد القطع </th>
                                    
                                    <th class="border-bottom-0">تاريخ الطلب</th>
                                    <th class="border-bottom-0" >رقم الطلبية المكملة </th>
                                


                               
                                 
                                    <th class="border-bottom-0">القيمة الاجمالية</th>
                                    <th class="border-bottom-0">العمليات</th>

                                    
                              
                                    


                                </tr>
                            </thead>

                            <tbody>
                                                    
                                                    <?php $i = 0; ?>
                                                    @foreach ($orders as $x)
                                                        <?php $i++; ?>
                                                        <div class="all_row">
                                                        <tr>
                                                            
                                                            <td  style="text-align: center;vertical-align: middle; horizontal-align: middle; " >{{ $i }}</td>
                                                            <td style="text-align: center;vertical-align: middle;">{{$x->importer->name}}</td>
                                                        

                    
                                                          
                                                            <td >
                                                            <a href="{{url('shop_orders_detail')}}/{{$x->id}}"style="horizontal-align: middle; text-align: center;vertical-align: middle;">
                                                             {{ $x->countAllItem()}}
                                                            </a>
                                                            
                                                            
                                                            </td>
                    
                                                            <td style="text-align: center;vertical-align: middle;  " >{{ $x->order_date }}</td>
                                                            <td style="text-align: center;vertical-align: middle;  " >
                                                            <a href="{{url('OrderDetails')}}/{{$x->related_to_id}}"style="text-align: center;vertical-align: middle;">
                                                                {{ $x->related_to_id }}
                                                                </a>
                                                                
                                                            
                                                            </td>
                                                            <td style="text-align: center;vertical-align: middle;  " >{{ $x->Total }}</td>
                                                            
                                                            
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
                                                                    تأكيد استلام
                                                                </a>
                                                                      
                                                                
                
                                                              
                                                                        <a class="dropdown-item" href="#" data-invoice_id="{{ $x->id }}"
                                                                            data-toggle="modal" data-target="#delete_invoice"><i
                                                                                class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                                            الطلبية</a>
                                                                 
                
                                                                    
                                                                       
                                                                  
                
                                                                  
                                                                        <a class="dropdown-item" href="#" data-invoice_id="{{ $x->id }}"
                                                                            data-toggle="modal" data-target="#Transfer_invoice"><i
                                                                                class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي
                                                                            الارشيف</a>
                                                                   
                
                                                                 
                                                                        
                                                                   
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
            </div>
        </div>



    </div>


<!--update-->

           




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

  


	

@endsection
