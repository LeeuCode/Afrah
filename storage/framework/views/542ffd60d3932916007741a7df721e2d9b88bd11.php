<?php $__env->startSection('container'); ?>

<div class="page-header">
    <h1>
        إعدادات النظام
        <small>
            <i class="ace-icon fa fa-angle-double-left"></i>
            جميع الإعدادات العامه للنظام
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
    <form action="<?php echo e(url('settings/save')); ?>" method="POST" class="form-horizontal" role="form">
        <?php echo e(csrf_field()); ?>


        <div class="form-group" >
            <label class="col-sm-3 control-label no-padding-right" for="site-name"> اسم الاستوديو </label>

            <div class="col-sm-9">
                <input name="site_name" value="<?php echo e(get_option('site_name')); ?>" type="text" id="site-name" placeholder="أكتب اسم الاستوديو هنا" class="col-xs-10 col-sm-5" required autocomplete="off" >
            </div>
        </div>

        <div class="form-group" >
            <label class="col-sm-3 control-label no-padding-right" for="archive-path"> مسار الارشيف </label>

            <div class="col-sm-9">
                <input name="archive_path" value="<?php echo e(get_option('archive_path')); ?>" type="text" id="archive-path" placeholder="أكتب مسار الارشيف هنا" class="col-xs-10 col-sm-5 text-left" dir="ltr" required autocomplete="off" >
            </div>
        </div>

        <div class="form-group" >
            <label class="col-sm-3 control-label no-padding-right" for="archive-path"> اسم مجلد الارشيف </label>

            <div class="col-sm-9">
                <input name="archive_folder" value="<?php echo e(get_option('archive_folder')); ?>" type="text" id="archive-path" placeholder="أكتب اسم مجلد الارشيف هنا" class="col-xs-10 col-sm-5 text-left" dir="ltr" required autocomplete="off" >
            </div>
        </div>

        <div class="form-group" >
            <label class="col-sm-3 control-label no-padding-right" for="phones"> ارقام هواتف الاستوديو</label>

            <div class="col-sm-9">
                <input name="phones" value="<?php echo e(get_option('phones')); ?>" type="text" id="phones" placeholder="أكتب ارقام هواتف الاستديو مصحوبه بالعلامة - هنا" class="col-xs-10 col-sm-5 text-left" dir="ltr" required autocomplete="off" >
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="clearfix form-actions">
            <div class="col-md-offset-5 col-md-9">
                <button class="btn btn-info" type="submit">
                    <i class="ace-icon fa  fa-save bigger-110"></i>
                    حفظ
                </button>
            </div>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>