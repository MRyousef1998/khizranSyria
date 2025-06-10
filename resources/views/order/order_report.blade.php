@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الملفات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ </span>
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
										
										<div class="table-responsive mt-15">

											<table class="table table-striped" style="text-align:center">
												<tbody>
													<tr>
														
														<th scope="row">المورد</th>
														<td>{{ $order->importer->name  }}</td>
														<th scope="row">العميل</th>
														  @if($order->representative_id!=null)
                                                            <td>{{ $order->representative->name  }}</td>
                                                            @else
                                                              <td>لايوجد</td>
                                                              @endif
													</tr>
													<tr>

														<th scope="row">تاريخ الطلب</th>
														<td>{{ $order->order_date }}</td>
														<th scope="row">تاريخ الوصول</th>
														<td>{{ $order->order_due_date }}</td>
														
													</tr>

													<tr>
													
														<th scope="row">مبلغ العمولة</th>
														<td>{{ $order->Amount_Commission }}</td>
														<th scope="row">الضرائب</th>
														<td>{{ $order->Value_VAT }}</td>
													</tr>
														<tr>

														<th scope="row">التكلفة الاجمالية</th>
														<td>{{ $order->Total }}</td>
														<th scope="row">الحالة الحالية</th>
														@if ($order->status->id==2)
															<td><span
																	class="badge badge-pill badge-success">{{ $order->status->status_name }}</span>
															</td>
													   @elseif ($order->status->id==1)
															<td><span
																	class="badge badge-pill badge-danger">{{ $order->status->status_name }}</span>
															</td>
														@else
															<td><span
																	class="badge badge-pill badge-warning">{{ $order->status->status_name }}</span>
															</td>
														@endif
													</tr>


												   
												</tbody>
											</table>
										</div>
										
										
										
										<!--skill bar-->
									</div><!-- main-profile-overview -->
								</div>
							</div>
						</div>
						
						<div class="card ">
							<div class="card-body">
								<div class="counter-status d-flex md-mb-0">
									
									<div class="mr-auto">
										<h1 class="tx-13">التکالیف</h1>
										<h2 class="mb-0 tx-22 mb-1 mt-1">
											{{ number_format($total_payments[0]->total)}}
											
										</h2>
										<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mr-1"></i>{{$GrinderRemining[0]->number_remining}}</p>
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
											<a href="#home" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">الدفعات</span> </a>
										</li>
										
										<li class="">
											<a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-cog tx-16 mr-1"></i></span> <span class="hidden-xs">اضافة دفعة</span> </a>
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
															<th class="border-bottom-0" >رقم الدفعة</th>
														
															
															
						
														  
															<th class="border-bottom-0">قيمة الدفعة</th>
															
														
															<th class="border-bottom-0">التاريخ</th>
															<th class="border-bottom-0">ملاحظات</th>
						
						
															
											
															
						
						
														</tr>
													</thead>
						
													<tbody>
														
																			<?php $i = 0; ?>
																			@foreach ($payments as $payment)
																				<?php $i++; ?>
																				<div class="all_row">
																				<tr>
																					
																					<td  style="text-align: center;vertical-align: middle; width:0.5;" >{{ $i }}</td>
																					<td style="text-align: center;vertical-align: middle;">{{$payment->amount}}</td>
																				
						
											
																				  
															
											
																				
																					<td style="text-align: center;vertical-align: middle;  " >{{ $payment->pay_date }}</td>
																					<td style="text-align: center;vertical-align: middle;">{{$payment->note}}</td>
																					
																					
						
																				
						
						
																					 
																					
																					
																				</tr>
																			</div>
																		   
																			@endforeach
																		
													</tbody>
						
														
												</table>
											</div>
										</div>





									</div>
									
									<div class="tab-pane" id="settings">
										
										<form role="form" action="add_payment_continer"  method="post" enctype="multipart/form-data">
											{{ csrf_field() }}
											<div class="form-group">
												<label for="amount_payments">قيمة الدفعة</label>
									
												<input type="text" class="form-control form-control-lg" id="amount_payments" name="amount_payments" value=0 oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
												<input type="hidden" class="form-control form-control-lg" id="order_id" name="order_id" value={{$order->id}} >
												
										   
											</div>
											
											
											<div class="form-group">
												<label for="note">ملاحظات</label>
												<textarea id="note" name='note' class="form-control form-control-lg">

												</textarea>
											</div>
											<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
										</form>
										
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="col-lg-8">
						<div class="row row-sm">
							<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
								<div class="card overflow-hidden sales-card bg-primary-gradient">
									<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
										<div class="">
											<h6 class="mb-3 tx-16 text-white">العناصر المباعة:</h6>
										</div>
										<div class="row row-sm">
											<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
												<h6 class="mb-3 tx-16 text-white">العدد   :</h6>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
												<h6 class="mb-3 tx-16 text-white">{{$allSold[0]->number_sold}}</h6>
												
											</div>
										</div>	
										
										<div class="pb-0 mt-0">
											
												<div class="row row-sm">
													<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
														<h6 class="mb-3 tx-16 text-white">السعر    :</h6>
													</div>
													<div class=" col-xl-6 col-lg-6 col-md-6 col-xm-12">
														<h6 class="mb-3 tx-16 text-white">{{ number_format($allSold[0]->selling_price_with_com_product_sold)}}</h6>
														
													</div>
												</div>	
												<span class="float-right my-auto mr-auto">
													<i class="fas fa-arrow-circle-up text-white"></i>
													<span class="text-white op-7"> +427</span>
												</span>
								
										</div>
									</div>
									<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
								<div class="card overflow-hidden sales-card bg-danger-gradient">
									<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
										<div class="">
											<h6 class="mb-3 tx-16 text-white">العناصر  الغیر مباعة:</h6>
										</div>
										<div class="row row-sm">
											<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
												<h6 class="mb-3 tx-16 text-white">العدد   :</h6>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
												<h6 class="mb-3 tx-16 text-white">{{$allRemining[0]->number_remining}}</h6>
												
											</div>
										</div>	
										
										<div class="pb-0 mt-0">
											
												<div class="row row-sm">
													<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
														<h6 class="mb-3 tx-16 text-white">السعر    :</h6>
													</div>
													<div class=" col-xl-6 col-lg-6 col-md-6 col-xm-12">
														<h6 class="mb-3 tx-16 text-white">{{ number_format($allRemining[0]->primery_price_with_com_product_remining)}}</h6>
														
													</div>
												</div>	
												<span class="float-right my-auto mr-auto">
													<i class="fas fa-arrow-circle-up text-white"></i>
													<span class="text-white op-7"> +427</span>
												</span>
								
										</div>
									</div>
									<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
								</div>
							</div>

							<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
								<div class="card overflow-hidden sales-card bg-warning-gradient">
									<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
										<div class="">
											<h6 class="mb-3 tx-16 text-white"> القطع المضافة من المحل:</h6>
										</div>
										<div class="row row-sm">
											<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
												<h6 class="mb-3 tx-16 text-white">العدد   :</h6>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
												<h6 class="mb-3 tx-16 text-white">{{$smallShop[0]->number}}</h6>
												
											</div>
										</div>	
										
										<div class="pb-0 mt-0">
											
												<div class="row row-sm">
													<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
														<h6 class="mb-3 tx-16 text-white">التكلفة    :</h6>
													</div>
													<div class=" col-xl-6 col-lg-6 col-md-6 col-xm-12">
														<h6 class="mb-3 tx-16 text-white">{{ number_format($smallShop[0]->primery_price_with_com_productParts)}}</h6>
														
													</div>
												</div>	
												
								
										</div>
									</div>
									<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
								</div>
							</div>

							<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
								<div class="card overflow-hidden sales-card bg-success-gradient">
									<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
										<div class="">
											<h6 class="mb-3 tx-16 text-white">  اجمالي الارباح:</h6>
										</div>
										<div class="row row-sm">
											<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
												<h6 class="mb-3 tx-16 text-white">العدد   :</h6>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
												<h6 class="mb-3 tx-16 text-white">{{$allSold[0]->number_sold}}</h6>
												
											</div>
										</div>	
										
										<div class="pb-0 mt-0">
											
												<div class="row row-sm">
													<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
														<h6 class="mb-3 tx-16 text-white">الربح    :</h6>
													</div>
													<div class=" col-xl-6 col-lg-6 col-md-6 col-xm-12">
														<h6 class="mb-3 tx-16 text-white">{{ number_format(($allSold[0]->selling_price_with_com_product_sold)
														-($allSold[0]->primery_price_with_com_product_sold+
														$smallShop[0]->primery_price_with_com_productParts+$total_payments[0]->total))}}</h6>
														
													</div>
												</div>	
												<span class="float-right my-auto mr-auto">
													<i class="fas fa-arrow-circle-up text-white"></i>
													<span class="text-white op-7"> {{$allRemining[0]->primery_price_with_com_product_remining}}</span>
												</span>
								
										</div>
									</div>
									<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
								</div>
							</div>
						

<div class="row row-sm">
							<div class="col-sm-12 col-xl-6 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											
											<div class="mr-auto">
												<h5 class="tx-13">مكنات القهوة المباعة</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">
												 	{{ number_format($machinesSold[0]->selling_price_with_com_product_sold)}}
													
												</h2>
												<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mr-1"></i>{{$machinesSold[0]->number_sold}}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-6 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
										
											<div class="mr-auto">
												<h5 class="tx-13"> مكنات القهوة الغير المباعة </h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">
													
													<th class="border-bottom-0">

														{{ number_format($machinesRemining[0]->primery_price_with_com_product_remining)}}
													
													</th>
														
													
												   
												
												</h2>
												<p class="text-muted mb-0 tx-11"><i class="si si-arrow-down-circle text-success mr-1"></i>{{$machinesRemining[0]->number_remining}}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-6 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											
											<div class="mr-auto">
												<h5 class="tx-13">المطاحن المباعة</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">
													{{ number_format($GrinderSold[0]->selling_price_with_com_product_sold)}}
													
												</h2>
												<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mr-1"></i>{{$GrinderSold[0]->number_sold}}</p>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12 col-xl-6 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											
											<div class="mr-auto">
												<h5 class="tx-13">المطاحن الغير مباعة</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">
													{{ number_format($GrinderRemining[0]->primery_price_with_com_product_remining)}}
													
												</h2>
												<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mr-1"></i>{{$GrinderRemining[0]->number_remining}}</p>
											</div>
										</div>
									</div>
								</div>
							</div>	
						</div>
						<div class="row row-sm">

							
							



							
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
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>	

@endsection