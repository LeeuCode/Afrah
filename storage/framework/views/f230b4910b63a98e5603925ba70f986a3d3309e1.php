<?php $__env->startSection('breadcrumb'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>

    <div id="print-bill" >
        <div class="page-header">
            <h1>
                التقرير اليومي
                <small>
                    <i class="ace-icon fa fa-angle-double-left"></i>
                    الأصناف التي تم بيعها خلال اليوم
                </small>
            </h1>
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
                        <th>الاجمالي</th>
                    </tr>
                </thead>
                <tbody class="table">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr>
                            <td><?php echo e($item->name); ?></td>
                            <td><?php echo e($item->price); ?>ج</td>
                            <td><?php echo e($item->quantityItem); ?></td>
                            <td><?php echo e(($item->price * $item->quantityItem)); ?>ج</td>
                        </tr>
                        <?php $total += ($item->price * $item->quantityItem); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php if(count($items) > 0): ?>
                        <tr style="background-color: #f7f5f5;">
                            <th class="text-left" colspan="3">إجمالي المبلغ المتحصل </th>
                            <th><?php echo e($total); ?>ج</th>
                        </tr>
                    <?php else: ?> 
                        <tr>
                            <td class="text-center" colspan="4" >
                                <i>لا يوجد اي منتجات تم بيعها حتي الأن.</i>
                            </td>
                        </tr>
                    <?php endif; ?>
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
                    <?php $__currentLoopData = $remainders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $remainder): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr>
                            <td ><?php echo e($remainder->id); ?></td>
                            <td><?php echo e($remainder->bill->agentName); ?>ج</td>
                            <td><?php echo e($remainder->amount); ?></td>
                        </tr>
                        <?php $rmTotal += $remainder->amount; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php if(count($remainders) > 0): ?>
                        <tr style="background-color: #f7f5f5;">
                            <th class="text-left" colspan="2">إجمالي المبلغ المتحصل </th>
                            <th><?php echo e($rmTotal); ?>ج</th>
                        </tr>
                    <?php else: ?> 
                        <tr>
                            <td class="text-center" colspan="4" >
                                <i>لا يوجد اي منتجات تم بيعها حتي الأن.</i>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="col-md-12 col-xs-12">
            <table class="table table-bordered table-hover">
                <tbody class="table">

                    <?php if($total > 0): ?>
                    <tr>
                        <th>إجمالي المتحصل من بيع الأصناف</th>
                        <th><?php echo e($total); ?>ج</th>
                    </tr>
                    <?php endif; ?>

                    <?php if($rmTotal >0): ?>
                    <tr>
                        <th>إجمالي المتحصل من باقي الفواتير</th>
                        <th><?php echo e($rmTotal); ?>ج</th>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <th colspan="2" class="text-center" >إجمالي المبلغ بخزينة الاستوديو <h3><?php echo e($total + $rmTotal); ?>ج</h3></th>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
    
    <script src="<?php echo e(asset('assets/js/printThis.js')); ?>"></script>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>