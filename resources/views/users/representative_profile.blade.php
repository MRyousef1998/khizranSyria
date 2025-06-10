@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الملفات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$userDetail->name}}</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-lg-4">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="pl-0">
									<div class="main-profile-overview">
										<div class="main-img-user profile-user">
											<img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"><a class="fas fa-camera profile-edit" href="JavaScript:void(0);"></a>
										</div>
										<div class="d-flex justify-content-between mg-b-20">
											<div>
												<h5 class="main-profile-name">{{$userDetail->name}}</h5>
												<p class="main-profile-name-text">{{$userDetail->role->name}}</p>
												<p class="main-profile-name-text">{{$userDetail->email}}</p>
												<p class="main-profile-name-text">{{$userDetail->mobile}}</p>

											</div>
										</div>
										
										<div class="row">
											<div class="col-md-4 col mb20">
												
												<h6 > جميع الطلبيات المنجزة عن  طريق العميل:</h6>
												<h5 class="text-small text-muted mb-0">{{App\Models\Order::where('representative_id','=',$userDetail->id)->count()}}</h5>
											</div>
											
											
										</div>
										
										<!--skill bar-->
									</div><!-- main-profile-overview -->
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="row row-sm">
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											
											<div class="mr-auto">
												<h5 class="tx-13">كامل المبلغ المستحق</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">

													{{App\Models\Order::where('representative_id','=',$userDetail->id)->sum('Amount_Commission')}}
												</h2>
												<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mr-1"></i>increase</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
										
											<div class="mr-auto">
												<h5 class="tx-13"> المبلغ المقبوض</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">
													
													<th class="border-bottom-0"> {{App\Models\Payment::where('representative_id','=',$userDetail->id)->sum('amount')}} </th>
														
													
												   
												
												</h2>
												<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mr-1"></i>increase</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											
											<div class="mr-auto">
												<h5 class="tx-13">  المتبقي</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">
												
													
													<th class="border-bottom-0">{{
														App\Models\Order::where('representative_id','=',$userDetail->id)->sum('Amount_Commission')-
														
														App\Models\Payment::where('representative_id','=',$userDetail->id)->sum('amount')}}</th>
														
													
												
												</h2>
												<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mr-1"></i>increase</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<div class="tabs-menu ">
									<!-- Tabs -->
									<ul class="nav nav-tabs profile navtab-custom panel-tabs">
										<li class="active">
											<a href="#home" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">الطلبيات</span> </a>
										</li>
										<li class="">
											<a href="#profile" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-images tx-15 mr-1"></i></span> <span class="hidden-xs"></span> </a>
										</li>
										<li class="">
											<a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-cog tx-16 mr-1"></i></span> <span class="hidden-xs">SETTINGS</span> </a>
										</li>
									</ul>
								</div>
								<div class="tab-content border-left border-bottom border-right border-top-0 p-4">
									<div class="tab-pane active" id="home">
										<div class="card-body">
											<div class="table-responsive">
												<table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
													<thead>
														<tr>
															<th class="border-bottom-0" >رقم الطلبية</th>
															@if ($orders[0]->category_id==2)
															<th class="border-bottom-0">المستورد</th>
																					
																					@elseif ($orders[0]->category_id==1)
																					<th class="border-bottom-0"> الشركة الموردة</th>
																						
																					@else
																					
																					
																						
																					@endif
															
															
						
														  
															<th class="border-bottom-0">عدد المكنات </th>
															
														
															<th class="border-bottom-0">العمولة</th>
													
						
						
															
											
															
						
						
														</tr>
													</thead>
						
													<tbody>
														@if ($orders[0]->category_id!=0)
																			<?php $i = 0; ?>
																			@foreach ($orders as $x)
																				<?php $i++; ?>
																				<div class="all_row">
																				<tr>
																					
																					<td  style="text-align: center;vertical-align: middle; width:0.5;" >{{ $i }}</td>
																					<td style="text-align: center;vertical-align: middle;">{{$x->importer->name}}</td>
																				
						
											
																				  
																					<td >
																						@if ($orders[0]->category_id==2)
																						<a href="{{url('ExportOrderDetails')}}/{{$x->id}}"style="text-align: center;vertical-align: middle;">
																							{{ $x->countAllItem()}}
																							</a>
																					
																					@elseif ($orders[0]->category_id==1)
																					<a href="{{url('OrderDetails')}}/{{$x->id}}"style="text-align: center;vertical-align: middle;">
																						{{ $x->countAllItem()}}
																						</a>
																						
																					@else
																					
																					
																						
																					@endif
															

																					
																					
																					
																					</td>
											
																				
																					<td style="text-align: center;vertical-align: middle;  " >{{ $x->Amount_Commission }}</td>
																					
																					
						
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
																			@endif
													</tbody>
						
														
												</table>
											</div>
										</div>





									</div>
									<div class="tab-pane" id="profile">
									<div class="card-body">
                        <div class="table-responsive hoverable-table">
                            <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                                <thead>
                                    <tr>
                                        <th class="wd-10p border-bottom-0">#</th>
                                       
                                        <th class="wd-15p border-bottom-0">التاریخ</th>
                                       
                                        <th class="wd-15p border-bottom-0">المبلغ</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($payments as $x)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                          
                                        <td>{{ $x->pay_date }}</td>
                                           
                                            <td>{{ $x->amount }}</td> 
                                           
                                           
        
                 
        
                                        
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
									</div>
									<div class="tab-pane" id="settings">
										@if ($orders[0]->category_id!=0)
										<form role="form" action="{{ route('add_payment_representative.store') }}"  method="post" enctype="multipart/form-data">
											{{ csrf_field() }}
											<div class="form-group">
												<label for="amount_payments">قيمة الدفعة</label>
									
												<input type="text" class="form-control form-control-lg" id="amount_payments" name="amount_payments" value=0 oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
												<input type="hidden" class="form-control form-control-lg" id="representative_id" name="representative_id" value={{$userDetail->id}}  >
										   
											</div>
											<div class="form-group">
												<label for="inputName" class="control-label">عن طلبية  </label>
                                <select name="order_id" class="form-control SlectBox" required
                                   >
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد الطلبية</option>
                                    @foreach ($orders as $order)
                                        <option value="{{ $order->id }}"> {{ $order->importer->name }}  [ {{ $order->countAllItem()}}]</option>
                                    @endforeach
                                </select>
											</div>
											
											<div class="form-group">
												<label for="note">ملاحظات</label>
												<textarea id="note" class="form-control">

												</textarea>
											</div>
											<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
										</form>
										@endif
									</div>
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