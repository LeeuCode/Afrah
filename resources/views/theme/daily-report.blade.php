@extends('theme.master')

@section('breadcrumb')
    {{-- <li class="active">الرئيسة</li> --}}
@endsection

@section('container')

    <div id="print-bill" >
        <div class="page-header">
            <h1>
                التقرير اليومي
                <small>
                    <i class="ace-icon fa fa-angle-double-left"></i>
                    تقرير مفصل عن حركة الفواتير و الاصناف بالنظام
                </small>
            </h1>
        </div>

        <div class="col-md-12 col-xs-12">
            <h4 class="header">الفواتير</h4>
        </div>

        <div class="col-md-12 col-xs-12">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم العميل</th>
                        <th>المدفوع</th>
                        <th>الاجمالي</th>
                    </tr>
                </thead>
                <tbody class="table">
                    @foreach ($bills as $bill)
                        <tr>
                            <td>{{ $bill->id }}</td>
                            <td>{{ $bill->agentName }}</td>
                            <td>{{ $bill->paid }}ج</td>
                            <td>{{ $bill->turnover }}ج</td>
                        </tr>
                        <?php 
                        
                        $billTotal += $bill->paid; 
                        $total += $bill->turnover;
                        
                        ?>
                    @endforeach
                    @if(count($bills) > 0)
                        <tr style="background-color: #f7f5f5;">
                            <th class="text-left" colspan="2">إجمالي المبلغ المتحصل </th>
                            <th>{{ $billTotal }}ج</th>
                            <th>{{ $total }}ج</th>
                        </tr>
                    @else 
                        <tr>
                            <td class="text-center" colspan="4" >
                                <i>لا يوجد اي فواتير تم بيعها حتي الأن.</i>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="col-md-12 col-xs-12">
            <h4 class="header">الأصناف</h4>
        </div>

        <div class="col-md-12 col-xs-12">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>الصنف</th>
                        <th>السعر</th>
                        <th>الكمية</th>
                        {{-- <th>الاجمالي</th> --}}
                    </tr>
                </thead>
                <tbody class="table">
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}ج</td>
                            <td>{{ $item->quantityItem }}</td>
                            {{-- <td>{{ ($item->price * $item->quantityItem) }}ج</td> --}}
                        </tr>
                        <?php $total += ($item->price * $item->quantityItem); ?>
                    @endforeach
                    @if(count($items) > 0)
                        {{-- <tr style="background-color: #f7f5f5;">
                            <th class="text-left" colspan="3">إجمالي المبلغ المتحصل </th>
                            <th>{{ $total }}ج</th>
                        </tr> --}}
                    @else 
                        <tr>
                            <td class="text-center" colspan="4" >
                                <i>لا يوجد اي منتجات تم بيعها حتي الأن.</i>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="col-md-12 col-xs-12">
            <h4 class="header">تحصيل باقي فواتير</h4>
        </div>

        <div class="col-md-12 col-xs-12">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 10%">رقم الفاتورة</th>
                        <th>إسم العميل</th>
                        <th>المستحق</th>
                    </tr>
                </thead>
                <tbody class="table">
                    @if(count($remainders) > 0)
                    @foreach ($remainders as $remainder)
                        <tr>
                            <td >{{ $remainder->bill->id }}</td>
                            <td>{{ $remainder->bill->agentName }}ج</td>
                            <td>{{ $remainder->amount }}</td>
                        </tr>
                        <?php //$rmTotal += $remainder->amount; ?>
                    @endforeach
                        <tr style="background-color: #f7f5f5;">
                            <th class="text-left" colspan="2">إجمالي المبلغ المتحصل </th>
                            <th>{{ $rmTotal }}ج</th>
                        </tr>
                    @else 
                        <tr>
                            <td class="text-center" colspan="4" >
                                <i>لا يوجد اي منتجات تم بيعها حتي الأن.</i>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="col-md-12 col-xs-12">
            <table class="table table-bordered table-hover">
                <tbody class="table">

                    @if($billTotal > 0)
                    <tr>
                        <th>إجمالي المتحصل من الفواتير</th>
                        <th>{{ $billTotal }}ج</th>
                    </tr>
                    @endif

                    @if($rmTotal >0)
                    <tr>
                        <th>إجمالي المتحصل من باقي الفواتير</th>
                        <th>{{ $rmTotal }}ج</th>
                    </tr>
                    @endif
                    <tr>
                        <th colspan="2" class="text-center" >إجمالي المبلغ بخزينة الاستوديو <h3>{{ $billTotal + $rmTotal }}ج</h3></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 col-xs-12">
        <center>
            <button type="button" class="btn btn-inverse btn-xs print-btn " >
                <i class="fa fa-print"></i>
                طباعة الفاتورة
            </button>
        </center>
    </div>

@endsection

@section('custom-script')
    {{-- <script src="{{ asset('assets/js/JsBarcode.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/printThis.js') }}"></script>

    <script>
        (function ($) {
            // Print button used printThis jQuery plugin.        
            $(document).on('click','.print-btn',function(){

                $('#print-bill').printThis({
                    debug: false,               // show the iframe for debugging
                    importCSS: true,            // import parent page css
                    importStyle: true,         // import style tags
                    printContainer: true,       // print outer container/$.selector
                    loadCSS: ["/assets/css/ace.min.css","/assets/css/ace-rtl.min.css"],                // path to additional css file - use an array [] for multiple
                    pageTitle: "",              // add title to print page
                    removeInline: false,        // remove inline styles from print elements
                    removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
                    printDelay: 1000,            // variable print delay
                    header: null,               // prefix to html
                    footer: null,               // postfix to html
                    base: false,                // preserve the BASE tag or accept a string for the URL
                    formValues: true,           // preserve input/form values
                    canvas: false,              // copy canvas content
                    doctypeString: '...',       // enter a different doctype for older markup
                    removeScripts: false,       // remove script tags from print content
                    copyTagClasses: true,      // copy classes from the html & body tag
                    beforePrintEvent: null,     // function for printEvent in iframe
                    beforePrint: null,          // function called before iframe is filled
                    afterPrint: null            // function called before iframe is removed
                });
            });
        })(jQuery)
    </script>
@endsection