@extends('layouts.master')
<style>
    table,
    table td {
      border: 0.5px solid #cccccc;
    }
    td {
      height: 80px;
      width: 160px;
      text-align: center;
      vertical-align: middle;
    }
  </style> 
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
    قائمة البضائع
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">البضائع</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة البضائع</span>
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
    @if (session()->has('Erorr'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('Erorr') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    @if (session()->has('Edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Edit') }}</strong>
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
            <div class="card mg-b-20">
                <div class="card-header pb-0">
             <div class="d-flex justify-content-between">

                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                                data-toggle="modal" href="#exampleModal">اضافة منتج</a>
                     </div>
                     <form action="/all_product_serch" method="POST" role="search" autocomplete="off">
                        {{ csrf_field() }}
    
    
                        
    
                        <div class="row">
                            
                            <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                                <p class="mg-b-10">تحديد الصنف</p><select class="form-control select2" name="productCatgory"
                                required >
                                 <option value="{{ $typeproductCatgories->id ?? null }}" selected>
                                     {{ $typeproductCatgories->category_name ?? 'يرجى اختيار الصنف' }}
                                 </option>
                            
                                 @foreach ($productCategoies as $productCatgory)
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
                                @foreach ($productCompany as $productCompany1)
                                <option value="{{ $productCompany1->id }}"> {{ $productCompany1->company_name }}</option>
                            @endforeach
                                
    
                            </select>
                            </div><!-- col-4 -->
    
    
                            <div class="col-lg-2 mg-t-20 mg-lg-t-0" id="type">
                                <p class="mg-b-10">تحديد الفئة</p>
                                <select class="form-control select2" name="productGroup"
                                    >
                                    <option value="{{ null }}" >
                                        {{  'الکل' }}
                                    </option>
                                    <option value="{{ $typeproductGroupes->id ?? null }}" selected>
                                        {{ $typeproductGroupes->group_name ?? 'یرجى تحديد الفئة' }}
                                    </option>
                                    @foreach ($productGroups as $productGroup)
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
                        @if (isset($productDetail))
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr>
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle; " >رقم المنتج</th>
                                    <th class="border-bottom-0"  style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">الشركة</th>
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">اسم المنتج</th>
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">الصنف</th>
                                    
                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">بلد المنشأ</th>
                                 


                                    <th class="border-bottom-0" style="text-align: center;vertical-align: middle; background-color:rgb(97, 134, 255);">العمليات</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($productDetail as $x)
                                    <?php $i++; ?>
                                    <tr>
                                        <td  style="text-align: center;vertical-align: middle;color:rgb(250, 246, 246);background-color:rgb(36, 111, 182);width:5" >{{ $i }}</td>
                                        <td style="text-align: center;vertical-align: middle;">{{ $x->companies->company_name }}</td>

                                        <td style="text-align: center;vertical-align: middle;">
                                            
                                            <div class = "vertical"><div>
                                                <img src="Attachments/{{ $x->id }}/{{ $x->image_name }}"  width="180"  height="120" /></div>
                                                <div>
                                                    {{ $x->product_name }}</div>
                                            </div>

                                            
                                            </td>
                                      
                                        <td style="text-align: center;vertical-align: middle;">{{ $x->groups->group_name }}</td>

                                        <td style="text-align: center;vertical-align: middle; color:rgb(207, 14, 14); " >{{ $x->companies->country_of_manufacture }}</td>
                                        
                                       


                                        <td style="text-align: center;vertical-align: middle;" >

                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $x->id }}" data-product_name="{{ $x->product_name }}"

                                                data-company_name="{{ $x->companies->company_name }}"
                                                data-company_id="{{ $x->company_id }}"
                                                data-product_g="{{ $x->groups->group_name }}"
                                                data-group_id="{{ $x->group_id }}"
                                                data-image-name ="{{ $x->image_name}}"
                                                data-product_category_name ="{{ $x->category->category_name}}"
                                                data-product_category_id ="{{ $x->category->id}}"

                                                

                                                data-toggle="modal" href="#edit_Product" title="تعديل"><i
                                                    class="las la-pen"></i></a>



                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $x->id }}" data-product_name="{{ $x->product_name }}"
                                                data-toggle="modal" href="#delete" title="حذف"><i
                                                    class="las la-trash"></i></a>

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



 <!-- add -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة منتج</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    
                    <form action="{{ route('all_product.store') }}" method="post" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الصنف</label>
                            <select name="productCategory" id="productCategory" class="form-control" required>
                                <option value="" selected disabled> --حدد الصنف--</option>
                                @foreach ($productCategoies as $productCategory)
                                    <option value="{{$productCategory->id}}">{{$productCategory->category_name}}</option>
                                @endforeach
                            </select>
                          

                          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الشركة</label>
                            <select name="productC" id="productC" class="form-control" required>
                                <option value="" selected disabled> --حدد الشركة--</option>
                                @foreach ($productCompany as $productC)
                                    <option value="{{$productC->id }}">{{$productC->company_name}}</option>
                                @endforeach
                            </select>
                          
                                <label for="exampleInputEmail1">اسم المنتج</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" required>
                           
                            
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الفئة</label>
                            <select name="productG" id="productG" class="form-control" required>
                                <option value="" selected disabled> --حدد الفئة--</option>
                                @foreach ($productGroups as $productGroup)
                                    <option value="{{$productGroup->id}}" >{{ $productGroup->group_name }}</option>
                                @endforeach
                            </select>
                        <br>
                            
                            <h5 class="card-title">المرفقات</h5>
    
                            <div class="col-sm-12 col-md-12">
                                <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                    data-height="70" />
                            </div><br>
                            <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>





        <!--UDAETE-->

        <div class="modal fade" id="edit_Product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل منتج</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action='all_product/update' method="post" enctype="multipart/form-data">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الصنف</label>
                            <select name="product_category_name" id="product_category_name" class="form-control" required>
                                @foreach ($productCategoies as $productCategory)
                                    <option >{{ $productCategory->category_name }}</option>
                                @endforeach
                            </select>


                            <input type="hidden" class="form-control" name="company_id" id="company_id" value="">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الشركة المصنعة</label>
                            <select name="company_name" id="company_name" class="form-control" required>
                                @foreach ($productCompany as $productC)
                                    <option>{{ $productC->company_name }}</option>
                                @endforeach
                            </select>

                            <div class="form-group">
                                <label for="title">اسم المنتج :</label>

                                <input type="hidden" class="form-control" name="id" id="id" value="">
                                
                                <input type="text" class="form-control" name="product_name" id="product_name" required>
                            </div>
                            <input type="hidden" class="form-control" name="group_id" id="group_id" value="">

                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الفئة</label>
                            <select name="productG" id="productG" class="form-control" required>
                               
                                @foreach ($productGroups as $productGroup)
                                    <option   >{{ $productGroup->group_name }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="title">التفاصيل :</label>

                                
                            <input type="text" class="form-control" name="discraaption" id="discraaption" required>
                            </div>
                            <label for="title">التقيم :</label>
                            <div class="input-group quantity" style=" ">
                                            <div class="input-group-prepend decrement-btn" style="cursor: pointer">
                                                <span class="input-group-text" >-</span>
                                            </div>
                                           
                                            <input type="text" class="qty-input form-control  "  id= "rating" name ="rating"style="text-align: center;vertical-align: middle;" maxlength="3" max="10" value="0">
                                            <div class="input-group-append increment-btn" style="cursor: pointer">
                                                <span class="input-group-text"  >+</span>
                                                
                                            </div>
                                           
                                        </div>
                           
                            <h5 class="card-title">المرفقات</h5>
    
                            <div class="col-sm-12 col-md-12">
                                <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                    data-height="70" />
                            </div><br>
                            <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                            
                            

                           

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">تعديل البيانات</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

  <!-- delete -->
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">حذف المنتج</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="all_product/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<!--update-->

 <div class="modal fade" id="edit_Product1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل منتج</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action='all_product/update' method="post">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                             
                            <div class="form-group">
                                <label for="title">اسم المنتج :</label>

                                <input type="hidden" class="form-control" name="id" id="id" value="">

                                <input type="text" class="form-control" name="product_name" id="product_name">
                            </div>
                            <div class="form-group">
                          <label class="my-1 mr-1" for="inlineFormCustomSelectPref">الشركة المصنعة</label>
                            <select name="company_name" id="company_name" class="custom-select my-1 mr-sm-1" required>
                                @foreach ($productCompany as $productC)
                                    <option value="{{ $productC->id }}">{{ $productC->company_name }}</option>
                                @endforeach
                            </select>                          

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">تعديل البيانات</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
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
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>



	<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var company_name = button.data('company_name')
        var country_of_manufacture = button.data('country_of_manufacture')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #company_name').val(company_name);
        modal.find('.modal-body #country_of_manufacture').val(country_of_manufacture);
    })

</script>
<script>
    $('#delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var product_name = button.data('product_name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #product_name').val(product_name);
    })


     $('#edit_Product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var product_name = button.data('product_name')
            var company_name = button.data('company_name')
            var id = button.data('id')
            var group_id = button.data('group_id')
            var company_id = button.data('company_id')
            var productG = button.data('product_g')
            var product_category_name = button.data('product_category_name')
            var product_category_id = button.data('product_category_id')

       
            
            var modal = $(this)
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #company_name').val(company_name);
            modal.find('.modal-body #productG').val(productG);
            modal.find('.modal-body #group_id').val(group_id);
            modal.find('.modal-body #company_id').val(company_id);
            modal.find('.modal-body #product_category_name').val(product_category_name);
           
            


            modal.find('.modal-body #id').val(id);
        })

</script>

<script>

    
$(document).ready(function () {

$('.increment-btn').click(function (e) {
    e.preventDefault();
    var incre_value = $(this).parents('.quantity').find('.qty-input').val();
    var price_elem=$(this).parent().parent().parent().find('.price');
    var com_price_elem=$(this).parent().parent().parent().find('.commission_pice');
    var qty_av=$(this).parent().parent().parent().find('.qtyy').val();

    
    var mycheck= $(this).parent().parent().parent().find('.box1');

    
    var total=0.0;
   


    var value = parseInt(incre_value, 10);
    value = isNaN(value) ? 0 : value;
    if(value<100 && value<qty_av){
        value++;
        $(this).parents('.quantity').find('.qty-input').val(value);

       

        mycheck.attr('checked', true);
      
       
       
         
      
        price_elem.removeAttr("readonly");
        com_price_elem.removeAttr("readonly");
        
        total=parseFloat(price_elem.val()*value )+parseFloat(com_price_elem.val()*value);
    
  
        
        var total_pirce_elem=$(this).parent().parent().parent().find('.total_price');
        
        total_pirce_elem.val(total);
        

        
    }

});

$('.decrement-btn').click(function (e) {

    e.preventDefault();
    var decre_value = $(this).parents('.quantity').find('.qty-input').val();
    var mycheck= $(this).parent().parent().parent().find('.box1');

    var value = parseInt(decre_value, 10);
    var price_elem=$(this).parent().parent().parent().find('.price');
    var com_price_elem=$(this).parent().parent().parent().find('.commission_pice');
    var total=0.0;
    value = isNaN(value) ? 0 : value;
    
    if(value>0){
        value--;
        $(this).parents('.quantity').find('.qty-input').val(value);
      
       

    
   
        total=parseFloat(price_elem.val()*value )+parseFloat(com_price_elem.val()*value);
        
       
        
        var total_pirce_elem=$(this).parent().parent().parent().find('.total_price');
        total_pirce_elem.val(total);
       
     
    }
    if(value==0){
         $(this).parent().parent().parent().find('.price').attr("readonly","true");
         $(this).parent().parent().parent().find('.commission_pice').attr("readonly","true");
         $(this).parent().parent().parent().find('.price').val(0);
         $(this).parent().parent().parent().find('.commission_pice').val(0);
         document.getElementById("total_price").value = 0;
         mycheck.attr('checked', false);
    }
});

});
</script>
<script>

    
$(document).ready(function () {

$('.increment-btn').click(function (e) {
    e.preventDefault();
    var incre_value = $(this).parents('.quantity').find('.qty-input').val();
    var value = parseInt(incre_value, 10);
    value = isNaN(value) ? 0 : value;
    if(value<100){
        value++;
        $(this).parents('.quantity').find('.qty-input').val(value);
    }

});

$('.decrement-btn').click(function (e) {
    e.preventDefault();
    var decre_value = $(this).parents('.quantity').find('.qty-input').val();
    var value = parseInt(decre_value, 10);
    value = isNaN(value) ? 0 : value;
    if(value>0){
        value--;
        $(this).parents('.quantity').find('.qty-input').val(value);
    }
});

});
</script>
@endsection
