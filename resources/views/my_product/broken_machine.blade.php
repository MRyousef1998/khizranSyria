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

    @if ($id==1)
     <?php $s=" مكنات القهوة الکسر"; ?>
       
    @endif

     @if ($id==2)
     <?php $s=" المطاحن الکسر"; ?>
       
    @endif
       @if ($id==3)
     <?php $s="قطع التبديل"; ?>
      @endif
       @if ($id==4)
     <?php $s="مكنات كسر "; ?>
       
    @endif
    
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{$s}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة {{$s}}</span>
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

                    <a href="add_machine/create" class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                                > <i
                                class="fas fa-plus"></i>&nbsp; اضافة {{$s}} إلى المستودع</a>
                    </div>

                      <form action="/broken_machine_serch" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}


                    

                    <div class="row">
                        
                        <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">تحديد الصنف</p><select class="form-control select2" name="productCatgory"
                            required >
                             <option value="{{ $typeproductCatgories->id ?? null }}" selected>
                                 {{ $typeproductCatgories->category_name ?? 'يرجى اختيار الصنف' }}
                             </option>
                        
                             @foreach ($productCatgories as $productCatgory)
                             <option value="{{ $productCatgory->id }}"> {{ $productCatgory->category_name }}</option>
                         @endforeach
                             

                         </select>
                        </div><!-- col-4 -->


                        <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">تحديد الشركة</p><select class="form-control select2" name="productCompany"
                            >
                            <option value="{{ null }}" >
                                {{ 'الکل' }}
                            </option>
                            <option value="{{ $typeproductCompanies->id ?? null }}" selected>
                                {{ $typeproductCompanies->company_name ?? 'یرجى تحديد الشركة' }}
                            </option>
                            @foreach ($productCompanies as $productCompany)
                            <option value="{{ $productCompany->id }}"> {{ $productCompany->company_name }}</option>
                        @endforeach
                            

                        </select>
                        </div><!-- col-4 -->


                        <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">تحديد الصنف</p><select class="form-control select2" name="productGroup"
                                >
                                <option value="{{ null }}" selected>
                                    {{  'الکل' }}
                                </option>
                                <option value="{{ $typeproductGroupes->id ?? null }}" selected>
                                    {{ $typeproductCatgories->company_name ?? 'یرجى تحديد الفئة' }}
                                </option>
                                @foreach ($productGroupes as $productGroup)
                                <option value="{{ $productGroup->id }}"> {{ $productGroup->group_name }}</option>
                            @endforeach

                                

                            </select>
                        </div><!-- col-4 -->

                        
                    </div><br>

                    <div class="row">
                        <div class="col-sm-1 col-md-1">
                            <button class="btn btn-primary btn-block">بحث</button>
                        </div>
                    </div>
                </form>


								
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (isset($machines))
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  " >رقم المنتج</th>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle;  ">الشركة</th>
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle;  ">اسم المنتج</th>
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle;  ">الصنف</th>
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle;  ">بلد المنشأ</th>
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle;  ">العدد </th>

                                </tr>
                            </thead>
                            <tbody>
                                
                             <?php $i = 0; ?>
                                @foreach ($machines as $x)
                                    <?php $i++; ?>
                                    <tr>
                                        <td  >{{ $i }}</td>
                                        <td style="text-align: center;vertical-align: middle;">{{ $x->company_name }}</td>

                                        <td style="text-align: center;vertical-align: middle;">
                                            
                                            <div class = "vertical"><div>
                                                <img src="http://khaizran2.online/Attachments/{{ $x->id }}/{{ $x->image_name }}"  width="180"  height="120" /></div>
                                                <div>
                                                    {{ $x->product_name }}</div>
                                            </div>

                                            
                                            </td>
                                      
                                        <td style="text-align: center;vertical-align: middle;">{{ $x->group_name }}</td>

                                        <td style="text-align: center;vertical-align: middle; color:rgb(207, 14, 14); " >{{ $x->country_of_manufacture }}</td>
                                        
                                        <td   style="text-align: center;vertical-align: middle;  ">
                                            
                                                 <a href="{{url('productDetails')}}/{{$x->id}}" > {{$x->aggregate}}
                                               
                                            </a>
                                        </td>


                                        
                                    </tr>
                                @endforeach
                                </tbody>




                        </table>
                        @endif
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
