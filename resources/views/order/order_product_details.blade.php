@extends('layouts.master')
@section('css')
<!--Internal  Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{$product[0]->product_name}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/تفاصيل</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body h-100">
								<div class="row row-sm ">
									<div class=" col-xl-5 col-lg-12 col-md-12">
										<div class="preview-pic tab-content">
										  <div class="tab-pane active" id="pic-1"><img src="http://khaizran2.online/Attachments/{{ $product[0]->id }}/{{ $product[0]->image_name }}" width="250"  height="250" alt="image"/></div>
										 
										</div>
										
									</div>
									<div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
										<h1 class="product-title mb-1">{{$product[0]->company_name}}    {{$product[0]->product_name}}</h1>
										<h2 class="product-title mb-1"></h2>
										<h3 class="product-title mb-1">{{$product[0]->group_name}}</h3>
										<h4 class="product-title mb-1">{{$product[0]->country_of_manufacture}}</h4>


										<div class="rating mb-1">
											<div class="stars">
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star text-muted"></span>
												<span class="fa fa-star text-muted"></span>
											
										<h4 class="price"> اجمالي العدد المتوفر:    <span class="h3 ml-2"style="color: rgb(170, 24, 10) ;">  {{$product[0]->aggregate}}</span></h4>
										
										
										<div class="d-flex  mt-2">
											
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->

				<!-- row -->
				<div class="row">
				@foreach ($detailProduct as $x)
					<div class="col-lg-3">
					 
						<div class="card item-card">
							<div class="card-body pb-0 h-100">
								
								<div class="card-body cardbody relative">
									<div class="cardtitle">
										<span>طلبية رقم </span>
										<a>اسم المورد</a>
										<span>الحالة </span>
										<a>تاريخ الوصول</a>
									</div>
									<div class="cardprice">
										<span >{{$x->orders_id}}</span>
										<span>{{$x->name}}</span>
										@if ($x->statusesId==1)
										<span class="text-danger">{{$x->status_name}}</span>
									
									@elseif ($x->statusesId==2)
										<span class="text-success">{{$x->status_name}}</span>
									@else
									
										<span class="text-warning">{{$x->status_name}}</span>
										
									@endif
										
										<span>{{$x->order_due_date}}</span>
									</div>
									<div class="cardtitle">
										
									</div>
									<div class="cardprice">
										
									</div>
								</div>
								<div class="card-body cardbody relative">
								<div class="cardtitle">
									@if ($x->statusesId==1)
										<span class="text-danger">العدد</span>
									
									@elseif ($x->statusesId==2)
										<span class="text-success">العدد</span>
									@else
									
										<span class="text-warning">العدد</span>
										
									@endif
									
										
									</div>
									<div class="cardprice">
										@if ($x->statusesId==1)
										<span class="text-danger">{{$x->aggregate}}</span>
									
									@elseif ($x->statusesId==2)
										<span class="text-success">{{$x->aggregate}}</span>
									@else
									
										<span class="text-warning">{{$x->aggregate}}</span>
										
									@endif
										
									</div>
									</div>
							</div>
						
						</div>
						
					</div>@endforeach
					
				
					
				</div>
				<!-- /row -->

				<!-- row -->
				
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
@endsection