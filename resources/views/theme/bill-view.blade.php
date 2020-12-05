@extends('theme.master')

@section('container')

<div id="print-bill" style="">
    <div style="overflow: auto;width:100%;border-bottom: 1px dotted #382222;" >
        <h3 class="text-center" ><strong>{{ get_option('site_name') }}</strong></h3>
                <br>
                <P class="text-center" >{{ get_option('phones') }}</P>
        <p class="col-xs-12"><b class="pull-right">الاسم :</b> <span class="pull-left" >{{ $bill->agentName }}</span></p>
        <p class="col-xs-12"><b class="pull-right">تاريخ الاصدار :</b> <span class="pull-left" >{{ date('H:i:s Y-m-d',strtotime($bill->created_at)) }}</span></p>
    </div>
    <div style="overflow: hidden;width:100%;border-bottom: 1px dotted #382222;" >
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>الصنف</th>
                    <th>السعر</th>
                    <th>الكمية</th>
                    <th>الاجمالي</th>
                </tr>
            </thead>
            <tbody class="table">
                @foreach ($bill->bill_items()->get() as $item)
                    <tr>
                        <td>{{ $item->item->name }}</td>
                        <td>{{ $item->price }}ج</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->amount }}ج</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="3" >إجمالي</th>
                    <th>{{ $bill->turnover }}ج</th>
                </tr>
                <tr>
                    <th colspan="3" >المدفوع</th>
                    <th>{{ $bill->paid }}ج</th>
                </tr>
                <tr>
                <th colspan="3" >{{ ($bill->paid > $bill->turnover) ? 'المتبقي' : 'الباقي' }}</th>
                    <th>{{ $bill->balance }}ج</th>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <center>
        <svg id="test-print" class="barcode visible-print test-print"
            jsbarcode-format="CODE39"
            jsbarcode-value="{{ $bill->id }}"
            jsbarcode-textmargin="0"
            jsbarcode-textalign="center"
            jsbarcode-width="1"
            jsbarcode-fontoptions="bold">
        </svg>
    </center>
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
    <script src="{{ asset('assets/js/JsBarcode.min.js') }}"></script>
    <script src="{{ asset('assets/js/printThis.js') }}"></script>

    <script>
    (function ($) {
        // Print button used printThis jQuery plugin.        
        $(document).on('click','.print-btn',function(){
                JsBarcode(".barcode").init();

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
                // PrintElem('print-bill');
            });
    })(jQuery)
    </script>
@endsection