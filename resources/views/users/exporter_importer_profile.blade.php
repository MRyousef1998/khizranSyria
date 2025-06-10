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
												
												<h6 >جميع الطلبيات:</h6>
												<h5 class="text-small text-muted mb-0">{{App\Models\Order::where('exported_id','=',$userDetail->id)->count()}}</h5>
											</div>
											<div class="col-md-4 col mb20">
												@if ($userDetail->role->id==1)
												<h6 > طلبيات قيد الانتظار :</h6>
												<h5 class="text-small text-muted mb-0 center">{{App\Models\Order::where('exported_id','=',$userDetail->id)->where('statuses_id','=',5)->count()}}</h5>
												@elseif ($userDetail->role->id==2)
												<h6 > طلبيات قيد الانتظار :</h6>
												<h5 class="text-small text-muted mb-0 center">{{App\Models\Order::where('exported_id','=',$userDetail->id)->where('statuses_id','=',1)->count()}}</h5>
																						
																					@else
																					
																					
																						
																					@endif
												
											</div>
											<div class="col-md-4 col mb20">
												@if ($userDetail->role->id==1)
												<h6 > طلبيات منجزة :</h6>
												<h5 class="text-small text-muted mb-0 center">{{App\Models\Order::where('exported_id','=',$userDetail->id)->where('statuses_id','=',6)->count()}}</h5>
												@elseif ($userDetail->role->id==2)
												<h6 > طلبيات مستلمة  :</h6>
												<h5 class="text-small text-muted mb-0 center">{{App\Models\Order::where('exported_id','=',$userDetail->id)->where('statuses_id','=',2)->count()}}</h5>
																						
																					@else
																					
																					
																						
																					@endif
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
												<h5 class="tx-13">الفواتير المدفوعة</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">{{$invoice_paid->invoice_count}}

												
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
												<h5 class="tx-13">الفواتير المدفوعة جزئيا</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">
													@if ($invoice_almost_paid!=null)
													<th class="border-bottom-0"> {{$invoice_almost_paid->invoice_count}}</th>
														
													@else
													<th class="border-bottom-0"> 0</th>
													
														
													@endif
												
												   
												
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
												<h5 class="tx-13">الفواتير الغير مدفوعة</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">
												
													@if ($invoice_unpaid!=null)
													<th class="border-bottom-0"> {{$invoice_unpaid->invoice_count}}</th>
														
													@else
													<th class="border-bottom-0"> 0</th>
													
														
													@endif
												
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
															@if ($userDetail->role->id==1)
															<th class="border-bottom-0">المستورد</th>
																					
																					@elseif ($userDetail->role->id==2)
																					<th class="border-bottom-0"> الشركة الموردة</th>
																						
																					@else
																					
																					
																						
																					@endif
															
															
						
														  
															<th class="border-bottom-0">عدد المكنات </th>
															
															<th class="border-bottom-0">تاريخ الطلب</th>
						
						
															<th class="border-bottom-0">تاريخ الوصول</th>
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
																					
																					<td  style="text-align: center;vertical-align: middle; width:0.5;" >{{ $i }}</td>
																					<td style="text-align: center;vertical-align: middle;">{{$x->importer->name}}</td>
																				
						
											
																				  
																					<td >
																						@if ($userDetail->role->id==1)
																						<a href="{{url('ExportOrderDetails')}}/{{$x->id}}"style="text-align: center;vertical-align: middle;">
																							{{ $x->countAllItem()}}
																							</a>
																					
																					@elseif ($userDetail->role->id==2)
																					<a href="{{url('OrderDetails')}}/{{$x->id}}"style="text-align: center;vertical-align: middle;">
																						{{ $x->countAllItem()}}
																						</a>
																						
																					@else
																					
																					
																						
																					@endif
															

																					
																					
																					
																					</td>
											
																					<td style="text-align: center;vertical-align: middle;  " >{{ $x->order_date }}</td>
																					<td style="text-align: center;vertical-align: middle; " >{{ $x->order_due_date }}</td>
																					<td style="text-align: center;vertical-align: middle;  " >{{ $x->Amount_Commission }}</td>
																					<td style="text-align: center;vertical-align: middle;  " >{{ $x->Value_VAT }}</td>
																					<td style="text-align: center;vertical-align: middle;  " >{{ $x->Total }}</td>
																					
																					<td>
																					@if ($x->status->id==1)
																						<span class="text-danger">{{ $x->status->status_name }}</span>
																					
																					@elseif ($x->status->id==2)
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
									<div class="tab-pane" id="profile">
										<div class="row">
											<div class="col-sm-4">
												<div class="border p-1 card thumb">
													<a href="#" class="image-popup" title="Screenshot-2"> <img src="{{URL::asset('assets/img/photos/7.jpg')}}" class="thumb-img" alt="work-thumbnail"> </a>
													<h4 class="text-center tx-14 mt-3 mb-0">Gallary Image</h4>
													<div class="ga-border"></div>
													<p class="text-muted text-center"><small>Photography</small></p>
												</div>
											</div>
											<div class="col-sm-4">
												<div class=" border p-1 card thumb">
													<a href="#" class="image-popup" title="Screenshot-2"> <img src="{{URL::asset('assets/img/photos/8.jpg')}}" class="thumb-img" alt="work-thumbnail"> </a>
													<h4 class="text-center tx-14 mt-3 mb-0">Gallary Image</h4>
													<div class="ga-border"></div>
													<p class="text-muted text-center"><small>Photography</small></p>
												</div>
											</div>
											<div class="col-sm-4">
												<div class=" border p-1 card thumb">
													<a href="#" class="image-popup" title="Screenshot-2"> <img src="{{URL::asset('assets/img/photos/9.jpg')}}" class="thumb-img" alt="work-thumbnail"> </a>
													<h4 class="text-center tx-14 mt-3 mb-0">Gallary Image</h4>
													<div class="ga-border"></div>
													<p class="text-muted text-center"><small>Photography</small></p>
												</div>
											</div>
											<div class="col-sm-4">
												<div class=" border p-1 card thumb  mb-xl-0">
													<a href="#" class="image-popup" title="Screenshot-2"> <img src="{{URL::asset('assets/img/photos/10.jpg')}}" class="thumb-img" alt="work-thumbnail"> </a>
													<h4 class="text-center tx-14 mt-3 mb-0">Gallary Image</h4>
													<div class="ga-border"></div>
													<p class="text-muted text-center"><small>Photography</small></p>
												</div>
											</div>
											<div class="col-sm-4">
												<div class=" border p-1 card thumb  mb-xl-0">
													<a href="#" class="image-popup" title="Screenshot-2"> <img src="{{URL::asset('assets/img/photos/6.jpg')}}" class="thumb-img" alt="work-thumbnail"> </a>
													<h4 class="text-center tx-14 mt-3 mb-0">Gallary Image</h4>
													<div class="ga-border"></div>
													<p class="text-muted text-center"><small>Photography</small></p>
												</div>
											</div>
											<div class="col-sm-4">
												<div class=" border p-1 card thumb  mb-xl-0">
													<a href="#" class="image-popup" title="Screenshot-2"> <img src="{{URL::asset('assets/img/photos/5.jpg')}}" class="thumb-img" alt="work-thumbnail"> </a>
													<h4 class="text-center tx-14 mt-3 mb-0">Gallary Image</h4>
													<div class="ga-border"></div>
													<p class="text-muted text-center"><small>Photography</small></p>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="settings">
										<form role="form">
											<div class="form-group">
												<label for="FullName">Full Name</label>
												<input type="text" value="John Doe" id="FullName" class="form-control">
											</div>
											<div class="form-group">
												<label for="Email">Email</label>
												<input type="email" value="first.last@example.com" id="Email" class="form-control">
											</div>
											<div class="form-group">
												<label for="Username">Username</label>
												<input type="text" value="john" id="Username" class="form-control">
											</div>
											<div class="form-group">
												<label for="Password">Password</label>
												<input type="password" placeholder="6 - 15 Characters" id="Password" class="form-control">
											</div>
											<div class="form-group">
												<label for="RePassword">Re-Password</label>
												<input type="password" placeholder="6 - 15 Characters" id="RePassword" class="form-control">
											</div>
											<div class="form-group">
												<label for="AboutMe">About Me</label>
												<textarea id="AboutMe" class="form-control">Loren gypsum dolor sit mate, consecrate disciplining lit, tied diam nonunion nib modernism tincidunt it Loretta dolor manga Amalia erst volute. Ur wise denim ad minim venial, quid nostrum exercise ration perambulator suspicious cortisol nil it applique ex ea commodore consequent.</textarea>
											</div>
											<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
										</form>
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