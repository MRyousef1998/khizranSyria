
@section('css')
<!--Internal  Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection


				<!-- row -->
				

				<!-- row -->
				<div class="row">
				@foreach ($detailBox as $x)
				<div class="col-lg-3">
					<div class="card item-card">
						<div class="card-body pb-0 h-100">
							<div  class="text-center">
							@if($x->box_image_name!=null)
								<img src="https://khaizran2.online/Attachments/Box/mybox{{$x->box_id}}/{{$x->box_image_name}}" alt="img" class="img-fluid">
								@else
								<img src="https://khaizran2.online/assets/img/add_image.png" class="img-fluid" alt="image"/></div>
		
										@endif
							</div>
							<div class="card-body cardbody relative">
								<div class="cardtitle">
									<a>{{$x->product_name}}</a>
									<span>{{$x->group_name}}</span>
									
								</div>
								<div class="cardprice">
									<span class="type--strikethrough">{{$x->company_name}}</span>
									<span>{{$x->country_of_manufacture}}</span>
								</div>
							</div>
						</div>
						
					</div>
				</div>
					@endforeach
					
				
					
				</div>
				<!-- /row -->

				<!-- row -->
				
			<!-- Container closed -->
		
		<!-- main-content closed -->

@section('js')
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
@endsection