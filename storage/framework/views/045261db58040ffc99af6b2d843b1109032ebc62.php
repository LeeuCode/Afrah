<?php $__env->startSection('custom-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/select2.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>

    <div class="page-header">
        <h1>
            باقي فاتورة
            <small>
                <i class="ace-icon fa fa-angle-double-left"></i>
                تحصيل باقي فاتورة
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

    <div class="col-xs-12">
        <form action="<?php echo e(url('remainder/store')); ?>" method="POST" class="form-horizontal" role="form">
            <?php echo e(csrf_field()); ?>


            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="item-name">رقم الفاتورة</label>

                <div class="col-sm-5">
                    <select name="bill_id" type="text" id="bill-id" class="col-xs-10 col-sm-5 text-center" >
                        <option value=""></option>
                        <?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <option value="<?php echo e($bill->id); ?>" ><?php echo e($bill->id); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="form-group" >
                <label  class="col-sm-3 control-label no-padding-right" for="balance"> الباقي </label>

                <div class="col-sm-2">
                    <input disabled name="balance" type="text" id="balance" placeholder="00" class="col-xs-10 col-sm-12 text-center">
                </div>
            </div>

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="amount">دفع</label>

                <div class="col-sm-2">
                    <input name="amount" type="text" id="amount" placeholder="00" class="col-xs-10 col-sm-12 text-center">
                </div>
                <label class="col-sm-2 control-label no-padding-right" style="text-align: right" for="amount">ج</label>
                
            </div>

            <div class="clearfix"></div>
            <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
                    <button class="btn btn-info" type="submit">
                        <i class="ace-icon fa  fa-save bigger-110"></i>
                        حفظ
                    </button>

                    &nbsp; &nbsp; &nbsp;
                    <a href="<?php echo e(url('/')); ?>" class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        العوده لإنشاء فاتورة
                    </a>
                </div>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>

    <script src="<?php echo e(asset('assets/js/select2.min.js')); ?>"></script>

    <script>
        (function($) {
            // Option to select input
            $('#bill-id').select2({
                dir: "rtl",
                placeholder: "00",
            });

            $("#bill-id").on('change',function() {
                var id = $(this).val();

                $.get("<?php echo e(url('get/turnover')); ?>/"+id, function(data, status){
                    $('#balance').val(data.balance);
                });

            });
        })(jQuery)
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>