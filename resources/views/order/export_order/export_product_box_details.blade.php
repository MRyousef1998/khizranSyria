
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
											
										<h4 class="price"> اجمالي العدد المطلوب:    <span class="h3 ml-2"style="color: rgb(170, 24, 10) ;">  {{$product[0]->aggregate}}</span></h4>
										
										<h4 class="price">عدد المكنات المغلفة :    <span class="h3 ml-2"style="color: rgb(170, 24, 10) ;">  {{$product[0]->box_count}}</span></h4>
										<div class="d-flex  mt-2">
											
										</div>
										<div class="action">
										
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
					<div class="col-lg-6">
					 
						<div class="card item-card" >
						<div class="card-header pb-0">
						@if($x->box_image_name!=null)
										  <div  id="pic-1"><img src="https://khaizran2.online/Attachments/Box/mybox{{$x->box_id}}/{{$x->box_image_name}}" width="400pix"  height="90pix" alt="image"/></div>
										 
										
										@else
										<div  id="pic-1"><img src="https://khaizran2.online/assets/img/add_image.png" width="400pix"  height="90pix" alt="image"/></div>
		
										@endif
</div>
							<div class="card-body pb-0 h-100">
								
								<div class="card-body cardbody relative">

								
									<div class="cardtitle">
										
										<span>  رقم المنتج</span>
										<span>اسم المنتج</span>
										<span>حالة المنتج </span>
										<span>حالة التغليف </span>
										<span>رقم الصندوق</span>
									</div>
									<div class="cardprice">
										<span >PNO{{$x->products_id}}</span>
										<span>{{$x->product_name}}</span>
										@if ($x->statuses_id==4)
										<span class="text-danger">{{$x->status_name}} </span>
									
									
									@else
									
										<span class="text-warning">{{$x->status_name}}</span>
										
									@endif
										@if ($x->box_id==null)
										<span class="text-danger">غير مغلف</span>
									
									
									@else
									
										<span class="text-warning">مغلف</span>
										
									@endif
									@if ($x->box_id==null)
									<span class="text-danger">غير مخصص</span>
								
								
								@else
								
									<span class="text-warning">{{$x->box_code}}</span>
									
								@endif
										
									</div>
									<div class="cardtitle">
										
									</div>
									<div class="cardprice">
										
									</div>
								</div>
								<div class="card-body cardbody relative">
								<div class="cardtitle">
									
									<span class="text-danger">طلبية توريدها</span>
										
									</div>
									<div class="cardprice">
									
										<span class="text-danger">ORNO {{$x->orders_id}}</span>
									</div>
									</div>
							</div>
							<div class="text-center border-top pt-3 pb-3 pl-2 pr-2 ">

								@if ($x->statuses_id==4)
								<a
								data-id="{{ $x->products_id }}" data-order_id="{{ $x->orders_id }}" data-product_price="{{ $x->selling_price_with_comm }}" data-category_id="{{ $x->category_id }}"
								data-toggle="modal"
								href="#rechose" class="btn btn-primary"> استبدال </a>
								<a
								data-id="{{ $x->products_id }}" data-order_id="{{ $x->orders_id }}" data-product_price="{{ $x->selling_price_with_comm }}" 
								data-toggle="modal"
								href="#removeProdect" class="btn btn-primary"> تخلي </a>
								@else 
								@if ($x->box_id==null)
								<a
								data-id="{{ $x->products_id }}" data-order_id="{{ $x->orders_id }}"
								data-toggle="modal"
								href="#capsalation" class="btn btn-primary"> تغليف </a>
								
								@else
								<a
								data-id="{{ $x->products_id }}" data-order_id="{{ $x->orders_id }}"
								data-toggle="modal"
								href="#capsalation" class="btn btn-warning"> تغیر کود </a>
									
									
								@endif
								
								
								
								
								<a
								data-id="{{ $x->products_id }}" data-order_id="{{ $x->orders_id }}" 
								data-toggle="modal"
								href="#sharcapsalation" class="btn btn-success"> تغليف مشترك</a>


								<div class="card-body cardbody relative">
								<div class="cardtitle">
									
									
										<a
								data-id="{{ $x->products_id }}" data-order_id="{{ $x->orders_id }}" data-product_price="{{ $x->selling_price_with_comm }}" data-category_id="{{ $x->category_id }}"
								data-toggle="modal"
								href="#rechose" class="btn btn-primary"> استبدال </a>
									</div>
									<div class="cardprice">
									
										<a
								data-id="{{ $x->products_id }}" data-order_id="{{ $x->orders_id }}" data-product_price="{{ $x->selling_price_with_comm }}" 
								data-toggle="modal"
								href="#removeProdect" class="btn btn-primary"> تخلي </a>
									</div>
									</div>

								
								
								@endif
							</div>
						</div>
						
					</div>@endforeach
					
				
					<div class="modal fade" id="rechoceProductConfirm" name="rechoceProductConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
					aria-hidden="true" >
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">استبدال المنتج من الطلبية </h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div> 
							
							<form action="{{route("rechoce_product_confirm")}}" method="post" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<div class="modal-body">
								   
								  
				
								  
									<input type="" name="id" id="id" value="">
									<input type="" name="product_id" id="product_id" value="">
				
										<label for="exampleInputEmail1">هل انت متأكد من استبدال المنتج؟ </label>
										
									
								   
								
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-success">تاكيد</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				
				</div>
				<!-- /row -->

				<!-- row -->
				
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
		
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

		$('#rechoceProductConfirm').on('show.bs.modal', function(event) {
			const zIndex = 1040 + 10 * $('.modal:visible').length;
		  $(this).css('z-index', zIndex);
		  setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
			
				var button = $(event.relatedTarget)
				var id = button.data('id')
				var product_id = button.data('product_id')
			 
			  
				
				var modal = $(this)
				modal.find('.modal-body #id').val(id);
				modal.find('.modal-body #product_id').val(product_id);
			   
			   
			})
		
		
		</script>
@endsection