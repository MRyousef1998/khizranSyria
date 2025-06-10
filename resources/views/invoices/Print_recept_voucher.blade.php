@extends('layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }

    </style>
@endsection
@section('title')
    معاينه طباعة الفاتورة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    معاينة طباعة الفاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <div>
                            <h1 class="invoice-title" style=" color:rgb(97, 134, 255);" >KITHRAN AL THAHBI</h1>
                            <h6 class="invoice-title" style=" color:rgb(97, 134, 255);" >       KITCHENS & REST. EUIP. TR</h6>
                        </div>
                            <div class="billed-from">
                                <h6>KITHRAN AL THAHBI</h6>
                                <p>Sharjah,UAE,Industria 4
                                    near to Isuzu showroom university road<br>
                                    Tel No: +971 567-774-654<br>
                                    Email: Gaiss14@hotmail.com</p>
                                    <p>EMIRATES ISLAMIC BANK P.J.S.C<br>
                                        A/C NO. 3708390760901<br>
                                        IPAN: AE45 0340 00370839 0760 901</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">Billed To</label>
                                <div class="billed-to">
                                    <h6>{{$order->importer->name}}</h6>
                                    <p>{{$order->importer->address}}<br>
                                        Tel No:{{$order->importer->mobile}}<br>
                                        Email:{{$order->importer->email}}</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="tx-gray-600">معلومات الفاتورة</label>
                                <p class="invoice-info-row"><span>رقم الفاتورة</span>
                                    <span>ORFK{{ $invoices->id }}</span></p>
                                <p class="invoice-info-row"><span>تاريخ الاصدار</span>
                                    <span>{{ $invoices->invoice_Date }}</span></p>
                               
                                
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-6p">#</th>
                                        <th class="wd-20p">المنتج</th>
                                        <th class="tx-center">کود المنتج</th>
                                        <th class="tx-right">العدد</th>
                                        <th class="tx-right">سعر القطعة</th>
                                     
                                        <th class="tx-right">الاجمالي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                @foreach ($machines as $x)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td class="tx-12">{{ $x->company_name }} {{ $x->product_name }} {{ $x->group_name }}</td>
                                        <td class="tx-center">MC{{ $x->id }}</td>
                                        <td class="tx-right"> 1 </td>
                                        
                            @if ($invoices->invoice_categories_id == 1)
                            <td class="tx-right">{{ number_format($x->price_with_comm, 2) }}</td>
                        
                        @else
                        <td class="tx-right">{{ number_format($x->selling_price_with_comm, 2) }}</td>
                        @endif
                        @php
                        if($invoices->invoice_categories_id == 1)
                        $total =  $x->price_with_comm*1 ;
                        else
                        $total =  $x->selling_price_with_comm*1 ;
                        @endphp
                                        <td class="tx-right">
                                            {{ number_format($total, 2) }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    @foreach ($grinders as $x)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td class="tx-12">{{ $x->company_name }} {{ $x->product_name }} {{ $x->group_name }}</td>
                                        <td class="tx-center">GRI{{ $x->id }}</td>
                                        <td class="tx-right"> 1 </td>
                                        @if ($invoices->invoice_categories_id == 1)
                            <td class="tx-right">{{ number_format($x->price_with_comm, 2) }}</td>
                        
                        @else
                        <td class="tx-right">{{ number_format($x->selling_price_with_comm, 2) }}</td>
                        @endif
                        @php
                        if($invoices->invoice_categories_id == 1)
                        $total =  $x->price_with_comm*1 ;
                        else
                        $total =  $x->selling_price_with_comm*1 ;
                        @endphp
                                        <td class="tx-right">
                                            {{ number_format($total, 2) }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    @foreach ($parts as $x)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td class="tx-12">{{ $x->company_name }} {{ $x->product_name }} {{ $x->group_name }}</td>
                                        <td class="tx-center">PRA{{ $x->id }}</td>
                                        <td class="tx-right"> 1 </td>
                                        @if ($invoices->invoice_categories_id == 1)
                                        <td class="tx-right">{{ number_format($x->price_with_comm, 2) }}</td>
                                    
                                    @else
                                    <td class="tx-right">{{ number_format($x->selling_price_with_comm, 2) }}</td>
                                    @endif
                                        @php
                                        if($invoices->invoice_categories_id == 1)
                                        $total =  $x->price_with_comm*1 ;
                                        else
                                        $total =  $x->selling_price_with_comm*1 ;
                                        @endphp
                                        <td class="tx-right">
                                            {{ number_format($total, 2) }}
                                        </td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13">#</label>

                                            </div><!-- invoice-notes -->
                                        </td>
                                        <td class="tx-right">الاجمالي</td>
                                        <td class="tx-right" colspan="2"> </td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">قيمة الضريبة </td>
                                        <td class="tx-right" colspan="2">{{$order->Value_VAT}}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">قيمة الخصم</td>
                                        <td class="tx-right" colspan="2"> {{ number_format($invoices->Discount, 2) }}</td>

                                    </tr>
                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">الاجمالي شامل الضريبة</td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{ number_format($invoices->Total, 2) }}</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

    </script>

@endsection
