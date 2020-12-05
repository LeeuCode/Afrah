<?php $__env->startSection('custom-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/select2.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>
    <div class="page-header">
        <h1>
            البحث
            <small>
                <i class="ace-icon fa fa-angle-double-left"></i>
                البحث في ارشيف الصور
            </small>
        </h1>
    </div>

    <div class="col-md-12">
        <?php if(Session::has('status')): ?> 
            <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <p>
                    <strong>
                        <i class="ace-icon fa fa-check"></i>
                        تم بنجاح!
                    </strong>
                    <?php echo e(Session::get('status')); ?>

                </p>
            </div>
        <?php endif; ?>
    </div>

    <div class="container-fluid" >
        <div class="row">
            <form id="custom-report" action="<?php echo e(url('report/show/custom')); ?>" method="POST" >
                <?php echo e(csrf_field()); ?>

                <div class="col-xs-12">
                    <div class="widget-box" id="widget-box-1">
                        <div class="widget-header">
                            <h5 class="widget-title">
                                <i class="fa fa-wpforms"></i>
                                تقرير مخصص
                            </h5>
                        </div>
        
                        <div class="widget-body">
                            <div class="widget-main" style="overflow: auto">
                                <div class="col-md-4 col-xs-12">
                                    
                                    <div class="form-group">
                                        <label for="item-name">الاصناف</label>
                                        <select name="item-name" id="" class="form-control" >
                                            <option value="">كل الاصناف</option>
                                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="col-md-3 col-xs-12">
                                    
                                    <div class="form-group">
                                        <label for="bill-date">من تاريخ</label>
                                        <input name="from" type="text" class="form-control date-picker" id="from" value="" autocomplete="off" >
                                    </div>
                                    
                                </div>

                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="bill-date">من تاريخ</label>
                                        <input name="to" type="text" class="form-control date-picker" id="to" value="" autocomplete="off" >
                                    </div>
                                </div>

                                <div class="col-md-2 col-xs-12">
                                    
                                    <div class="form-group">
                                        <label for="item-price" style="display: block;color: transparent;">الكمية</label>
                                        <button id="add-to-bill" class="btn btn-primary btn-block btn-xs" style="padding: 4px 6px 5px;">
                                            <i class="ace-icon fa fa-file-text-o align-top bigger-125"></i>
                                            أصدار التقرير
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

    <div class="col-md-12 col-xs-12 add-items-ajax">
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
    <script src="<?php echo e(asset('assets/js/printThis.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap-datepicker.min.js')); ?>"></script>
    
    <script>
        (function($) {

            //datepicker plugin
            $('.date-picker').datepicker({
                lang: 'ar',
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });

            $('#custom-report').on('submit',function (e) {
                e.preventDefault();

                var url  = $(this).attr('action'),
                    data = $(this).serialize();

                $.post(url, data, function(data, status){
                    $('.add-items-ajax').html(data);
                });
            });


            // Print button used printThis jQuery plugin.        
            $(document).on('click','.print-btn',function(){
                $('#print').printThis({
                    debug: false,               // show the iframe for debugging
                    importCSS: true,            // import parent page css
                    importStyle: true,         // import style tags
                    printContainer: true,       // print outer container/$.selector
                    loadCSS: ["/assets/css/ace.min.css","/assets/css/ace-rtl.min.css"],                // path to additional css file - use an array [] for multiple
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

        })(jQuery)
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>