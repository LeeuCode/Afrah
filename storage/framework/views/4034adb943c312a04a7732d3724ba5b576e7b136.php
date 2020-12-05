<?php $__env->startSection('custom-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/jquery.gritter.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <div class="widget-box" id="widget-box-1">
                    <div class="widget-header">
                        <h5 class="widget-title">
                            <i class="fa fa-wpforms"></i>
                            حجز فاتورة جديده
                        </h5>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main" style="overflow: auto">
                            <div class="col-md-2 col-xs-12">
                                
                                <div class="form-group">
                                    <label for="daily-counter">العداد اليومي</label>
                                    <input disabled type="text" class="form-control text-center" id="daily-counter" value="<?php echo e($dayCounter); ?>">
                                </div>
                                
                            </div>

                            <div class="col-md-2 col-xs-12">
                                
                                <div class="form-group">
                                    <label for="id-bill">رقم الفاتورة</label>
                                    <input disabled type="text" class="form-control text-center" id="id-bill" value="<?php echo e($lastID); ?>">
                                </div>
                                
                            </div>

                            <div class="col-md-4 col-xs-12">
                                
                                <div class="form-group">
                                    <label for="agent-name">اسم العميل</label>
                                    <input type="text" class="form-control" id="agent-name" placeholder="أكتب اسم العميل هنا" >
                                </div>
                                
                            </div>

                            <div class="col-md-4 col-xs-12">
                                
                                <div class="form-group">
                                    <label for="agent-phone">رقم العميل</label>
                                    <input type="text" class="form-control" id="agent-phone" placeholder="ex:+0987654321" >
                                </div>
                                
                            </div>

                            <div class="col-md-4 col-xs-12">
                                
                                <div class="form-group">
                                    <label for="item-name">الصنف</label>
                                    <select class="form-control" id="item-name">
                                        <option value="">أختار صنف من هنا</option>
                                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                                
                            </div>

                            <div class="col-md-1 col-xs-12">
                                
                                <div class="form-group">
                                    <label for="item-price">السعر</label>
                                    <input disabled type="text" class="form-control text-center" id="item-price" value="00">
                                </div>
                                
                            </div>

                            <div class="col-md-2 col-xs-12">
                                
                                <div class="form-group">
                                    <label for="item-price">الكمية</label>
                                    <input type="number" value="1" min="1" class="form-control text-center" id="item-quantity" placeholder="00">
                                </div>
                                
                            </div>

                            <div class="col-md-2 col-xs-12">
                                
                                <div class="form-group">
                                    <label for="item-price">الاجمالي</label>
                                    <input disabled type="text" class="form-control text-center" id="item-amount" value="00">
                                </div>
                                
                            </div>

                            <div class="col-md-3 col-xs-12">
                                
                                <div class="form-group">
                                    <label for="item-price" style="display: block;color: transparent;">الكمية</label>
                                    <button id="add-to-bill" class="btn btn-primary btn-block btn-xs" style="padding: 4px 6px 5px;">
                                        <i class="ace-icon fa fa-plus align-top bigger-125"></i>
                                        أضافة الصنف للفاتورة
                                    </button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-xs-12">
                <div class="widget-box" id="widget-box-1">
                    <div class="widget-header">
                        <h5 class="widget-title">
                            <i class="fa fa-wpforms"></i>
                            اعدادات التاريخ
                        </h5>
                    </div>
    
                    <div class="widget-body">
                        <div class="widget-main" style="overflow: auto">
                            <div class="col-md-12 col-xs-12">
                                
                                <div class="form-group">
                                    <label for="release-date">تاريخ الايصال</label>
                                    <input disabled type="text" class="form-control" id="release-date" value="<?php echo e(date('Y-m-d')); ?>" >
                                </div>
                                
                            </div>

                            <div class="col-md-12 col-xs-12">
                                
                                <div class="form-group">
                                    <label for="delivery-date">تاريخ التسليم</label>
                                    <input type="text" class="form-control date-picker" id="delivery-date" value="<?php echo e(date('Y-m-d')); ?>" >
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form id="save-bill" class="form-horizontal" action="<?php echo e(url('bill/save')); ?>" method="POST">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="agentName">
                <input type="hidden" name="agentPhone">
                <input type="hidden" name="deliveryDate">
            <div class="col-md-9 col-xs-12">
                
                <table id="simple-table" class="table  table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>الصنف</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>الاجمالي</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody class="append-item" >
                    </tbody>
                </table>
            </div>

            <div class="col-xs-12 col-md-3">
                <div class="widget-box" id="widget-box-1">
                    <div class="widget-header">
                        <h5 class="widget-title">
                            <i class="fa fa-calculator"></i>
                            الحساب
                        </h5>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main" style="overflow: auto">
                            <div class="col-md-12 col-xs-12">
                                
                                <div class="form-group">
                                    <label for="turnover" class="col-md-3 col-xs-12">إجمالي </label>
                                    <div class="col-sm-9 col-xs-12">
                                        <input name="turnover" readonly type="text" class="form-control text-center" id="turnover" value="00" >
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-12 col-xs-12">
                                
                                <div class="form-group">
                                    <label for="paid" class="col-md-3 col-xs-12">المدفوع</label>
                                    <div class="col-sm-9 col-xs-12">
                                        <input type="number" name="paid" class="form-control text-center col-md-6 col-xs-12" value="0" id="paid" placeholder="00" autocomplete="off">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-12 col-xs-12">
                                
                                <div class="form-group">
                                    <label id="balanceLabal" for="balance" class="col-md-3 col-xs-12">الباقي</label>
                                    <div class="col-sm-9 col-xs-12">
                                        <input name="balance" readonly type="text" class="form-control text-center" id="balance" value="00" >
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-12 col-xs-12">
                                
                                <div class="form-group">
                                    
                                    <button id="add-to-bill" class="btn btn-success btn-block btn-xs" style="padding: 4px 6px 5px;">
                                        <i class="ace-icon fa fa-plus align-top bigger-125"></i>
                                        حافظ الفاتورة
                                    </button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
        <div class="modal-content" style="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">طباعة فاتورة</h4>
            </div>
            <div id="print-bill" class="modal-body print-bill" style="overflow: auto">
                <h3 class="text-center" ><strong><?php echo e(get_option('site_name')); ?></strong></h3>
                <br>
                <P class="text-center" ><?php echo e(get_option('phones')); ?></P>
                <div style="overflow: auto;width:100%;border-bottom: 1px dotted #382222;" >
                    <p class="col-xs-12"><b class="pull-right">الاسم :</b> <span class="pull-left bill-name" ></span></p>
                    <p class="col-xs-12"><b class="pull-right">تاريخ الاصدار :</b> <span class="pull-left bill-date" ></span></p>
                    <p class="col-xs-12"><b class="pull-right">تاريخ التسليم :</b> <span class="pull-left bill-deliveryDate" ></span></p>
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
                        <tbody class="bill-table-items">
                        </tbody>
                    </table>
                </div>
                <br>
                <center>
                    <svg id="test-print" class="barcode visible-print test-print"
                        jsbarcode-format="CODE39"
                        jsbarcode-value="2"
                        jsbarcode-textmargin="0"
                        jsbarcode-textalign="center"
                        jsbarcode-width="1"
                        jsbarcode-fontoptions="bold">
                    </svg>
                </center>
                <br>
            </div>
            <div class="modal-footer text-center">
                <center>
                    <button type="button" class="btn btn-inverse btn-xs print-btn " >
                        <i class="fa fa-print"></i>
                        طباعة الفاتورة
                    </button>
                </center>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>

    <script src="<?php echo e(asset('assets/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/printThis.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/JsBarcode.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.gritter.min.js')); ?>"></script>
    
    <script>
        (function($) {
            
            $('#agent-name').on('keyup keypress key down', function () {
               $('input[name=agentName]').val($(this).val()); 
               $('.bill-name').text($(this).val());
            });

            $('#agent-phone').on('keyup keypress key down', function () {
               $('input[name=agentPhone]').val($(this).val()); 
            });

            // Option to select input
            $('#item-name').select2({
                dir: "rtl",
                placeholder: "أختار الصنف من هنا",
            });

            // Get item info by Ajax technique when change value
            $('#item-name').on('change',function (){
                var id = $(this).val();

                if(id != null) {
                    $.get("<?php echo e(url('getItem')); ?>/"+id, function(data, status){

                        var currentDate = new Date(),
                            newDeliveryDate = formatDate(currentDate.addDays(data.delivery)),
                            deliveryDate = $('#delivery-date').val();

                        // Get the price of the item.
                        $('#item-price').val(data.price);
                        $('#delivery-date').attr('data-delivery',newDeliveryDate);

                        $('#delivery-date').val(newDeliveryDate);
                        total();
                    });
                }
            });

            $('#item-quantity').on('keypress keyup keydown', function () {
               total(); 
            });

            // Add item row to the table.
            $('#add-to-bill').on('click', function () {
                var itemVal      = $('#item-name').val(),
                    itemSelect   = $('#item-name').find('option:selected').text(),
                    itemPrice    = $('#item-price').val(),
                    itemQuantity = $('#item-quantity').val(),
                    itemAmount   = Number($('#item-amount').val()),
                    deliveryDate = $('#delivery-date').val(),
                    turnover = Number($('#turnover').val()),
                    biggerDate = deliveryDate,
                    is_set = false,
                    total = 0;

                // validationInputs 
                if(validationInputs() != false){

                    if ($('.append-item tr').length > 0) {
                        $('.append-item tr').each(function () {
                            var trId = $(this).attr('id'),
                                trDeliverydate = $(this).attr('data-deliverydate'),
                                quantityTd = $(this).find('td p').eq(2),
                                amountTd = $(this).find('td p').eq(3),
                                quantityTdVal = Number(quantityTd.text()),
                                quantityTotalSum = Number(itemQuantity) + quantityTdVal,
                                amountTotal = (quantityTotalSum * itemPrice),
                                removeBtn = $(this).find('td').eq(4).find('button');

                            if (Number(itemVal) == Number(trId)) {
                                quantityTd.text(quantityTotalSum);
                                quantityTd.prev('input').val(quantityTotalSum);
                                amountTd.text(amountTotal);
                                amountTd.prev('input').val(amountTotal);
                                removeBtn.attr('id',amountTotal);

                                is_set = true;
                            }

                            if (trDeliverydate > biggerDate) {
                                biggerDate = trDeliverydate;
                            }

                        });
                    }

                    restInputs();

                    $('#delivery-date').val(biggerDate);
                    $('input[name=deliveryDate]').val(biggerDate);
                    // $('.bill-date').text(biggerDate);

                    if(is_set != true) {
                        $('.append-item').append('<tr data-deliveryDate="'+ deliveryDate +'" id="'+ itemVal +'"><input type="hidden" name="itemBillName[]" value="'+ itemSelect +'" ><td><input name="itemName[]" type="hidden" value="'+ itemVal +'" ><p>'+ itemSelect +'</p></td><td><input name="itemPrice[]" type="hidden" value="'+ itemPrice +'" ><p>'+ itemPrice +'</p></td><td><input name="itemQuantity[]" type="hidden" value="'+ itemQuantity +'" ><p>'+ itemQuantity +'</p></td><td><input name="itemAmount[]" type="hidden" value="'+ itemAmount +'" ><p>'+ itemAmount +'</p></td><td><button id="'+ itemAmount +'" type="button" class="btn btn-xs btn-danger remove-item" ><i class="fa fa-close"></i></button></td></tr>');
                    }

                    // Update turnover input value with a new value.
                    $('#turnover').val(turnover + itemAmount);
                    $('#balance').val(turnover + itemAmount);
                    
                } else {
                    $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'خطأ !',
                        // (string | mandatory) the text inside the notification
                        text: 'يبدو أن هناك بعض الحقول المطلوبة فارغة',
                        class_name: 'gritter-error'
                    });
                }
            });

            // Remove item from table row.
            $(document).on('click', '.remove-item', function () {
                var turnover = Number($('#turnover').val()),
                    itemQuantityRm = Number($(this).attr('id'));

                // Remove Item.
                $(this).parent().parent().remove();
                // Update turnover input value with a new value.
                $('#turnover').val(turnover - itemQuantityRm);
                $('#balance').val(turnover - itemQuantityRm);

            });

            // balanceTotal
            $('#paid').on('keypress keydown keyup', function() {
                balanceTotal();
            });

            // Print button used printThis jQuery plugin.        
            $(document).on('click','.print-btn',function(){
                JsBarcode(".barcode").init();

                $('#print-bill').printThis({
                    debug: false,               // show the iframe for debugging
                    importCSS: true,            // import parent page css
                    importStyle: true,         // import style tags
                    printContainer: true,       // print outer container/$.selector
                    loadCSS: ["<?php echo e(asset('assets/css/ace.min.css')); ?>","<?php echo e(asset('public/assets/css/ace-rtl.min.css')); ?>"],                // path to additional css file - use an array [] for multiple
                    pageTitle: "",              // add title to print page
                    removeInline: false,        // remove inline styles from print elements
                    removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
                    printDelay: 3333,            // variable print delay
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

            // Save bill: 
            $(document).on('submit', '#save-bill',function (e) {
                e.preventDefault();

                var url  = $(this).attr('action'),
                    data = $(this).serialize(),
                    blancedText = '';

                if ($('#turnover').val() != '00') {
                    $.post(url, data, function(data, status){

                        console.log(data);

                        $.gritter.add({
                            // (string | mandatory) the heading of the notification
                            title: 'تم بنجاح !',
                            // (string | mandatory) the text inside the notification
                            text: data.message,
                            class_name: 'gritter-success'
                        });

                        $('.bill-table-items').html('');

                        $('.bill-date').text(data.date);
                        $('.bill-deliveryDate').text(data.deliveryDate);

                        // Loop a items.
                        $.each(data.items,function(id,item) {
                            $('.bill-table-items').append('<tr><td>'+ item.itemName +'</td><td>'+ item.itemPrice +'ج</td><td>'+ item.itemQuantity +'</td><td>'+ item.itemAmount +'ج</td></tr>');
                        });

                        if(data.paid > data.turnover) {
                            blancedText = 'المتبقي';
                        } else {
                            blancedText = 'الباقي';
                        }

                        // Add 
                        $('.bill-table-items').append('<tr><th colspan="3">الإجمالي</th><th>'+ data.turnover +'</th></tr><tr><th colspan="3">المدفوع</th><th>'+ data.paid +'</th></tr><tr><th colspan="3">'+blancedText+'</th><th>'+ data.balance +'</th></tr>');

                        // Add value to the barcode.  
                        $('.test-print').attr('jsbarcode-value',data.bill_id);

                        // JsBarcode("#test-print", data.bill_id, {
                        //     format: "pharmacode",
                        //     lineColor: "#0aa",
                        //     width:4,
                        //     height:40,
                        //     displayValue: false
                        // });

                        $.gritter.add({
                            // (string | mandatory) the heading of the notification
                            title: 'تنفيذ',
                            // (string | mandatory) the text inside the notification
                            text: 'جاري اتمام عملية الطباعة الان......',
                            class_name: 'gritter-info gritter-center'
                        });

                        JsBarcode(".barcode").init();

                        $('#print-bill').printThis({
                            debug: false,               // show the iframe for debugging
                            importCSS: true,            // import parent page css
                            importStyle: true,         // import style tags
                            printContainer: true,       // print outer container/$.selector
                            loadCSS: ["<?php echo e(asset('/assets/css/ace.min.css')); ?>","<?php echo e(asset('assets/css/ace-rtl.min.css')); ?>"],                // path to additional css file - use an array [] for multiple
                            pageTitle: "",              // add title to print page
                            removeInline: false,        // remove inline styles from print elements
                            removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
                            printDelay: 1500,            // variable print delay
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

                        $('#daily-counter').val(data.billDayCounter);
                        $('#id-bill').val(data.id);
                        $('.append-item tr').remove();
                        $('#agent-name').val('');
                        $('#agent-phone').val('');
                        restInputs();
                    });
                } else {
                    $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'تنبيه !',
                        // (string | mandatory) the text inside the notification
                        text: 'يبدو أنك لم تقم بإضافة اي عناصر بالفاتورة',
                        class_name: 'gritter-warning'
                    });
                }
            });

            /**
             * This gives us the result of multiplying the price by quantity.
             */
            function total() {
                var quantity = $('#item-quantity'), // Item quantity input.
                    price = $('#item-price').val(); // Item price input value.

                // Make sure there is a value in the Quantity field.
                if(quantity.val() != '') {
                    $('#item-amount').val(Number(quantity.val()) * Number(price));
                } else {
                    $('#item-amount').val('00');
                }
            }

            /**
             * This gives us the result of multiplying the price by quantity.
             */
            function validationInputs() {
                var isValid = true;

                switch ('') {
                    case $('#agent-name').val():
                        isValid = false;
                        break;
                    case $('#item-name').val():
                        isValid = false;
                        break;
                    case $('#item-quantity').val():
                        isValid = false;
                }
                return isValid;
            }

            /**
             * Rest input value to empty.
             */
            function restInputs() {
                $('#item-name').select2('val','');
                $('#item-name').select2('open').select2('close');
                $('#item-name').val('');
                $('#item-price').val('00');
                $('#item-quantity').val('1');
                $('#item-amount').val('00');
                $('#turnover').val('00');
                $('#paid').val('0');
                $('#balance').val('00')
            }

            /**
             * Custom format date string.
             */ 
            function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [year, month, day].join('-');
            }

            /**
             *
             * Calculate balance total.  
             *
             */
            function balanceTotal() {
               var  turnover = Number($('#turnover').val()),
                    paid = Number($('#paid').val()),
                    balance = $('#balance');

                balance.val(Math.abs(turnover - paid));

                //
                if (paid > turnover) {
                    $('#balanceLabal').text('المتبقي');
                } else {
                    $('#balanceLabal').text('الباقي');
                }
            }

            // Add prototype.
            Date.prototype.addDays = function(days) {
                this.setDate(this.getDate() + parseInt(days));
                return this;
            };

            // Create data picker input.
            $('.date-picker').datepicker({
                lang: 'ar',
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            })

            function PrintElem(elem)
            {
                var mywindow = window.open('', 'PRINT', 'height=400,width=600');

                mywindow.document.write('<html><head><title>' + document.title  + '</title>');
                mywindow.document.write('</head><body >');
                mywindow.document.write('<h1>' + document.title  + '</h1>');
                mywindow.document.write(document.getElementById(elem).innerHTML);
                mywindow.document.write('</body></html>');

                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10*/

                mywindow.print();
                mywindow.close();

                return true;
            }

        })( jQuery );
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>