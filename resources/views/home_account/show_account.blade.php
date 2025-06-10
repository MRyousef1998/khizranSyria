@extends('layouts.master')
@section('css')

@section('title')
    المستخدمين - مورا سوفت للادارة الفواتير
@stop

<!-- Internal Data table css -->

<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">صندوق المنزل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ 
                حرکة صندوق المنزل</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        
<div class="panel panel-primary tabs-style-3">
	<div class="tab-menu-heading">
		<div class="tabs-menu ">
			<!-- Tabs -->
			<ul class="nav panel-tabs">
				<li class=""><a href="#tab11" class="active" data-toggle="tab"><i class="fa fa-cube"></i> سحب</a></li>
				<li><a href="#tab12" data-toggle="tab"><i class="fa fa-cube"></i> ايداع</a></li>
				<li><a href="#tab13" data-toggle="tab"><i class="fa fa-cube"></i>ايداع خارجي</a></li>

			
			</ul>
		</div>
	</div>

    
	<div class="panel-body tabs-menu-body">
		<div class="tab-content">
			<div class="tab-pane active" id="tab11">
				<div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
        
                            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-payment_type_id="1" data-payment_type_name="دفع"         data-toggle="modal" href="#addModal">اضافة حدث سحب</a>
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive hoverable-table">
                            <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                                <thead>
                                    <tr>
                                        <th class="wd-10p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">نوع العملیة</th>
                                        <th class="wd-15p border-bottom-0">التاریخ</th>
                                        <th class="wd-20p border-bottom-0">التفاصیبل</th>
                                        <th class="wd-15p border-bottom-0">المبلغ</th>
                                        <th class="wd-15p border-bottom-0">المستخدم</th>
                                        <th class="wd-15p border-bottom-0">ملاحظات</th>
                                        <th class="wd-10p border-bottom-0">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($diposit as $event)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                               
                                                <span class="label text-danger d-flex">
                                                    <div class="dot-label bg-danger ml-1"></div>{{ $event->payment_type->type_name }}
                                                </span>
                                          
                            
                                            
                                        </td>
                                        <td>{{ $event->pay_date }}</td>
                                            <td>{{ $event->purpose }}</td>
                                            <td>{{ $event->amount }}</td> 
                                            <td>{{ $event->user->name }}</td>
                                            <td>{{ $event->note }}</td>
                                           
        
                                            
        
                                            <td>
                                              
                                                <a href="#editModal" class="btn btn-sm btn-info"
                                                data-event_id="{{ $event->id }}"    data-payment_type_id="1" data-purpose="{{$event->purpose}}" data-amount="{{$event->amount}}" data-note="{{$event->note}}" data-toggle="modal" href="#editModal"  title="تعديل"><i class="las la-pen"></i></a>
                                          
                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                        
                                                        data-toggle="modal" href="#modaldemo8"  data-event_id="{{ $event->id }}"  title="حذف"><i
                                                              class="las la-trash"></i></a>
                                              
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			</div>
			<div class="tab-pane" id="tab12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
        
                            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-payment_type_id="2" data-payment_type_name="قبض"      data-toggle="modal" href="#addModal">اضافة حدث ايداع</a>
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive hoverable-table">
                            <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                                <thead>
                                    <tr>
                                        <th class="wd-10p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">نوع العملیة</th>
                                        <th class="wd-15p border-bottom-0">التاریخ</th>
                                        <th class="wd-20p border-bottom-0">التفاصیبل</th>
                                        <th class="wd-15p border-bottom-0">المبلغ</th>
                                        <th class="wd-15p border-bottom-0">المستخدم</th>
                                        <th class="wd-15p border-bottom-0">ملاحظات</th>
                                        <th class="wd-10p border-bottom-0">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($withdrow as $event)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                               
                                                <span class="label text-success d-flex">
                                                    <div class="dot-label bg-success ml-1"></div>{{ $event->payment_type->type_name }}
                                                </span>
                                          
                            
                                            
                                        </td>
                                        <td>{{ $event->pay_date }}</td>
                                            <td>{{ $event->purpose }}</td>
                                            <td>{{ $event->amount }}</td> 
                                            <td>{{ $event->user->name }}</td>
                                            <td>{{ $event->note }}</td>
                                           
        
                                            
        
                                            <td style="text-align: center;vertical-align: middle;">
                                              <div>
                                                    <a href="#editModal" class="btn btn-sm btn-info"
                                                    data-event_id="{{ $event->id }}"    data-payment_type_id="2" data-purpose="{{$event->purpose}}" data-amount="{{$event->amount}}" data-note="{{$event->note}}" data-toggle="modal" href="#editModal"  title="تعديل"><i class="las la-pen"></i></a>
                                                </div>
                                                <div>
                                          
                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                        
                                                        data-toggle="modal" href="#modaldemo8"  data-event_id="{{ $event->id }}" title="حذف"><i
                                                            class="las la-trash"></i></a>
                                                        </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			</div>
			<!---->
            <div class="tab-pane" id="tab13">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
        
                            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-payment_type_id="3" data-payment_type_name="مصاريف خارجية"      data-toggle="modal" href="#addModal">اضافة حدث ايداعات خارجية</a>
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive hoverable-table">
                            <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                                <thead>
                                    <tr>
                                        <th class="wd-10p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">نوع العملیة</th>
                                        <th class="wd-15p border-bottom-0">التاریخ</th>
                                        <th class="wd-20p border-bottom-0">التفاصیبل</th>
                                        <th class="wd-15p border-bottom-0">المبلغ</th>
                                        <th class="wd-15p border-bottom-0">المستخدم</th>
                                        <th class="wd-15p border-bottom-0">ملاحظات</th>
                                        <th class="wd-10p border-bottom-0">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($externaldiposit as $event)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                               
                                                <span class="label text-success d-flex">
                                                    <div class="dot-label bg-success ml-1"></div>{{ $event->payment_type->type_name }}
                                                </span>
                                          
                            
                                            
                                        </td>
                                        <td>{{ $event->pay_date }}</td>
                                            <td>{{ $event->purpose }}</td>
                                            <td>{{ $event->amount }}</td> 
                                            <td>{{ $event->user->name }}</td>
                                            <td>{{ $event->note }}</td>
                                           
        
                                            
        
                                            <td style="text-align: center;vertical-align: middle;">
                                              <div>
                                                    <a href="#editModal" class="btn btn-sm btn-info"
                                                    data-event_id="{{ $event->id }}"    data-payment_type_id="3" data-purpose="{{$event->purpose}}" data-amount="{{$event->amount}}" data-note="{{$event->note}}" data-toggle="modal" href="#editModal"  title="تعديل"><i class="las la-pen"></i></a>
                                                </div>
                                                <div>
                                          
                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                        
                                                        data-toggle="modal" href="#modaldemo8"  data-event_id="{{ $event->id }}" title="حذف"><i
                                                            class="las la-trash"></i></a>
                                                        </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			</div>


         


		</div>
	</div>

    </div>
    <!--/div-->

    <!-- Modal effects -->
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف الحدث</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('today_home_statment.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="event_id" id="event_id" value="">
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>

</div>
<!-- /row -->
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافةعملیة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    
                    <form action="{{ route('today_home_statment.store') }}" method="post" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <label for="inputName" class="control-label" >الغاية </label>
                                <input type="text" class="form-control form-control-sm mg-b-20" id="purpose" name="purpose"required >
                                <label for="inputName" class="control-label" >المبلغ </label>
                                <input type="text" class="form-control form-control-sm mg-b-20" id="amount" name="amount"required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                <label for="note">ملاحظات</label>
                                <textarea class="form-control" id="note" name="note" rows="1"></textarea>
                                <input type="hidden" class="form-control form-control-sm mg-b-20" id="type_id" name="type_id"required >
                          
                               

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل عملیة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    
                    <form action="today_home_statment/update" method="post" method="post" enctype="multipart/form-data">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <label for="inputName" class="control-label" >الغاية </label>
                                <input type="text" class="form-control form-control-sm mg-b-20" id="purpose" name="purpose"required >
                                <label for="inputName" class="control-label" >المبلغ </label>
                                <input type="text" class="form-control form-control-sm mg-b-20" id="amount" name="amount"required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                <label for="note">ملاحظات</label>
                                <textarea class="form-control" id="note" name="note" rows="1"></textarea>
                                <input type="hidden" class="form-control form-control-sm mg-b-20" id="type_id" name="type_id"required >
                                <input type="hidden" class="form-control form-control-sm mg-b-20" id="id" name="id" >
                          
                          
                          
                               

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
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
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>
<script>
    $('#addModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var payment_type_id= button.data('payment_type_id')
        var usernapayment_type_name = button.data('payment_type_name')
        var modal = $(this)
        modal.find('.modal-body #type_id').val(payment_type_id);
       
    })

</script>

<script>
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var payment_type_id= button.data('payment_type_id')
        var purpose = button.data('purpose')
        var amount = button.data('amount')
        var note = button.data('note')
        var event_id = button.data('event_id')

        var modal = $(this)
        modal.find('.modal-body #type_id').val(payment_type_id);
        modal.find('.modal-body #purpose').val(purpose);
        modal.find('.modal-body #amount').val(amount);
      
        modal.find('.modal-body #note').val(note);
        modal.find('.modal-body #id').val(event_id);

       
    })

</script>
<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var event_id= button.data('event_id')
       
        var modal = $(this)
        modal.find('.modal-body #event_id').val(event_id);
       
    })

</script>
@endsection
