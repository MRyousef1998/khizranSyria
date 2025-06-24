@extends('layouts.master',['exporter' => $exporter,'importer' =>  $importer,'representative' => $representative])
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
						  <p class="mg-b-0">khaizran al thahabi</p>
						</div>
					</div>
					<div class="main-dashboard-header-right">
						<div>
							<label class="tx-13">اغلاق الصندوق</label>
								<h5>{{number_format((\App\Models\AccountStatement::where('account_statement_types_id',2)->

								where('pay_date','>', '2023-6-22')->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',1)->
					
								where('pay_date','>', '2023-6-22')->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',3)->
					
								where('pay_date','>', '2023-6-22')->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',4)->
					
					where('pay_date','>', '2023-6-22')->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',5)->
					
					where('pay_date','>', '2023-6-22')->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',6)->
					
					where('pay_date','>', '2023-6-22')->sum('amount')),2)}}</h5>
						</div>
						
						<div>
							<label class="tx-13">اغلاق الحساب البنكي</label>
								<h5>{{number_format((\App\Models\BankAccountStatements::where('account_statement_types_id',2)->

								where('pay_date','>', '2023-6-22')->sum('amount'))-(\App\Models\BankAccountStatements::where('account_statement_types_id',1)->
					
								where('pay_date','>', '2023-6-22')->sum('amount'))+(\App\Models\BankAccountStatements::where('account_statement_types_id',3)->
					
								where('pay_date','>', '2023-6-22')->sum('amount')),2)}}</h5>
						</div>

						<div>
							<label class="tx-13">اغلاق الحساب المنزلي</label>
								<h5>{{number_format((\App\Models\HomeStatments::where('account_statement_types_id',2)->

								where('pay_date','>', '2023-6-22')->sum('amount'))-(\App\Models\HomeStatments::where('account_statement_types_id',1)->
					
								where('pay_date','>', '2023-6-22')->sum('amount'))+(\App\Models\HomeStatments::where('account_statement_types_id',3)->
					
								where('pay_date','>', '2023-6-22')->sum('amount')),2)}}</h5>
						</div>

						<div>
							<label class="tx-13">صافي المتبقي اليومي</label>
						@can('الصندوق')
						<h5>{{number_format((\App\Models\AccountStatement::where('account_statement_types_id',2)->

								where('pay_date','=', Illuminate\Support\Carbon::today())->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',1)->
					
								where('pay_date','=', Illuminate\Support\Carbon::today())->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',3)->
					
								where('pay_date','=', Illuminate\Support\Carbon::today())->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',4)->
					
					where('pay_date','=', Illuminate\Support\Carbon::today())->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',5)->
					
					where('pay_date','=', Illuminate\Support\Carbon::today())->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',6)->
					
					where('pay_date','=', Illuminate\Support\Carbon::today())->sum('amount')),2)}}</h5>
							@endcan
						</div>
						<div>
							<label class="tx-13">صافي المتبقي الشهري</label>
							@can('الصندوق')
							<h5>{{number_format((\App\Models\AccountStatement::where('account_statement_types_id',2)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',1)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',3)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',4)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',5)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount'))-(\App\Models\AccountStatement::where('account_statement_types_id',6)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount')),2)}}</h5>
					@endcan	
					</div>
					</div>
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									
									<h6 class="mb-3 tx-12 text-white">وارد الشهر الجاري</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											@can('الصندوق')
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{number_format(\App\Models\AccountStatement::where('account_statement_types_id',2)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount'),2)}}</h4>
											<p class="mb-0 tx-12 text-white op-7">درهم امارتي</p>
											@endcan
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											@can('الصندوق')
											<span class="text-white op-7">{{number_format(\App\Models\AccountStatement::where('account_statement_types_id',1)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount')+
												\App\Models\AccountStatement::where('account_statement_types_id',3)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount')+
												\App\Models\AccountStatement::where('account_statement_types_id',4)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount')+
												\App\Models\AccountStatement::where('account_statement_types_id',5)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount')+
												\App\Models\AccountStatement::where('account_statement_types_id',6)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount'),2)}} </span>
										</span>
										@endcan
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">مصاريف الشهر الجاري</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											@can('الصندوق')
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{number_format(\App\Models\AccountStatement::where('account_statement_types_id',1)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount')+
												\App\Models\AccountStatement::where('account_statement_types_id',3)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount')+
												\App\Models\AccountStatement::where('account_statement_types_id',4)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount')+
												\App\Models\AccountStatement::where('account_statement_types_id',5)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount')+\App\Models\AccountStatement::where('account_statement_types_id',6)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount'),2)}}</h4>
											<p class="mb-0 tx-12 text-white op-7">درهم امارتي</p>
											@endcan
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											@can('الصندوق')
											<span class="text-white op-7"> {{number_format(\App\Models\AccountStatement::where('account_statement_types_id',2)->
												whereBetween('pay_date', [Illuminate\Support\Carbon::now()->startOfMonth(),Illuminate\Support\Carbon::now()->endOfMonth()])->sum('amount'),2)}}</span>
										</span>
										@endcan
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">وارد اليوم</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											@can('الصندوق')
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{number_format(\App\Models\AccountStatement::where('account_statement_types_id',2)->
												where('pay_date','=', Illuminate\Support\Carbon::today())->sum('amount'),2)}}</h4>
												
											<p class="mb-0 tx-12 text-white op-7">درهم امارتي</p>@endcan
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> 52.09%</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">مصاريف اليوم</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											@can('الصندوق')
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{number_format(\App\Models\AccountStatement::where('account_statement_types_id',1)->
												where('pay_date','=', Illuminate\Support\Carbon::today())->sum('amount')+
												\App\Models\AccountStatement::where('account_statement_types_id',3)->
												where('pay_date','=', Illuminate\Support\Carbon::today())->sum('amount')+\App\Models\AccountStatement::where('account_statement_types_id',4)->
												where('pay_date','=', Illuminate\Support\Carbon::today())->sum('amount')+\App\Models\AccountStatement::where('account_statement_types_id',5)->
												where('pay_date','=', Illuminate\Support\Carbon::today())->sum('amount')+\App\Models\AccountStatement::where('account_statement_types_id',5)->
												where('pay_date','=', Illuminate\Support\Carbon::today())->sum('amount'),2)}}</h4>
												
											<p class="mb-0 tx-12 text-white op-7">درهم امارتي</p>@endcan
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7"> -152.3</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
				</div>
				<!-- row closed -->

				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-md-12 col-lg-12 col-xl-7">
						<div class="card">
							<div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
								<div class="d-flex justify-content">
									<h4 class="card-title mb-0">ارباح الاشهر الست الماضية</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 text-muted mb-0">.</p>
							</div>
							<div class="card-body">
								
							
								  <div style="width:100%;">
									@can('الارباح')
    {!! $BarChart->render() !!}
	@endcan
</div>
							</div>
						</div>
					</div>
					
					<div style="width:40%;">
						@can('الصندوق')
						{!! $chartjs1->render() !!}
						@endcan
					</div>
				</div>
				<!-- row closed -->

				<!-- row opened -->
				<div class="row row-sm">
					
					<div class="col-xl-6 col-md-6 col-lg-2">
						
							
						<div id="dlk" name="dd" style="width:100%;">
							@can('الارباح')
							{!! $Reminingchartjs->render() !!}
							@endcan
						</div>
						<div class="card ">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="d-flex align-items-center pb-2">
											<p class="mb-0">عدد المكنات المتبقية</p>
										</div>
										@can('الجرودات')
										<h4 class="font-weight-bold mb-2">{{$machineReminingNumber}}</h4>
										@endcan
										<div class="progress progress-style progress-sm">
											<div class="progress-bar bg-primary-gradient wd-80p" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
										</div>
									</div>
									<div class="col-md-6 mt-4 mt-md-0">
										<div class="d-flex align-items-center pb-2">
											<p class="mb-0">عدد المطاحن المتبقي</p>
										</div>
										@can('الجرودات')
										<h4 class="font-weight-bold mb-2">{{$GrinderReminingNumber}}</h4>
										@endcan
										<div class="progress progress-style progress-sm">
											<div class="progress-bar bg-danger-gradient wd-75" role="progressbar"  aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"></div>
										</div>
							
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row close -->

				<!-- row opened -->
				<div class="row row-sm row-deck">
				
					<div class="col-xl-12 col-md-6 col-lg-2">
						<div class="card card-table-two">
							<div class="d-flex justify-content-between">
								<h4 class="card-title mb-1">طلبيات توريد </h4>
								<i class="mdi mdi-dots-horizontal text-gray"></i>
							</div>
							<span class="tx-12 tx-muted mb-3 ">الطلبيات المتوقع وصولها في هذا الشهر</span>
							<div class="table-responsive country-table">
								@can('الجرودات')
								<table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
									<thead>
										<tr>
										
                                    <th class="border-bottom-0"> الشركة الموردة</th>

                                  
                                    <th class="border-bottom-0">عدد المكنات </th>
                                    
                                   


                                    <th class="border-bottom-0">تاريخ الوصول</th>
                                  
                                  


                                   
                                     <th class="border-bottom-0">المرفق</th>
										</tr>
									</thead>
									<tbody>
                                                    
                                                    <?php $i = 0; ?>
                                                    @foreach ($orders as $x)
                                                        <?php $i++; ?>
                                                        <div class="all_row">
                                                        <tr>
                                                            
                                                            
                                                            <td style="text-align: center;vertical-align: middle;">{{$x->importer->name}}</td>
                                                        

                    
                                                          
                                                            <td >
                                                            <a href="{{url('OrderDetails')}}/{{$x->id}}"style="text-align: center;vertical-align: middle;">
                                                            {{ $x->countAllItem()}}
                                                            </a>
                                                            
                                                            
                                                            </td>
                    
                                                            
                                                            <td style="text-align: center;vertical-align: middle; " >{{ $x->order_due_date }}</td>
                                                
                                                            
                                                          



                                                            
                                                           


                                                        <td>
                                                            <div class="dropdown">
                                                                <button aria-expanded="false" aria-haspopup="true"
                                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                                <div class="dropdown-menu tx-13">
                                                                     
                                                                <a class="dropdown-item" href= "{{ URL::route('order_report', [$x->id]) }}"
                                                       
                                                                 
                                                                        
                                                                        ><i
                                                                        class="text-success fas fa-check"></i>&nbsp;&nbsp;
                                                             التقاریر
                                                                </a>
                
                                                                 <a class="dropdown-item" href="{{url('order_prodect_code')}}/{{$x->id}}">
                                                                    <i
                                                                     class="text-success fas fa-check"></i>&nbsp;&nbsp;تفاصيل المنتجات  
                                                                                                                                   </a>   
                                                                   
                                                                       
                                                                   
                
                                                                 
                                                                        
                                                                   
                                                                </div>
                                                            </div>
                
                                                        </td>


                                                             
                                                            
                                                            
                                                        </tr>
                                                    </div>
                                                   
                                                    @endforeach
                            </tbody>
								</table>
								@endcan
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
		</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{ asset('/js/test.js') }}"></script>
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

@endsection