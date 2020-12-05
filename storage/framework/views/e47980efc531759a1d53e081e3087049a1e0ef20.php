<?php $__env->startSection('breadcrumb'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>

    <div class="page-header">
        <h1>
            أضافة مستخدم
            <small>
                <i class="ace-icon fa fa-angle-double-left"></i>
                أضافة مستخدم جديد إلي النظام
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
        <form id="add-user" action="<?php echo e(url('user/store')); ?>" method="POST" class="form-horizontal" role="form">
            <?php echo e(csrf_field()); ?>


            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="name"> اسم المستخدم </label>

                <div class="col-sm-9">
                    <input name="name" type="text" id="name" placeholder="أكتب اسم المستخدم هنا" class="col-xs-10 col-sm-5" required autofocus autocomplete="off" >
                </div>
            </div>

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="email"> البريد الالكتروني </label>

                <div class="col-sm-9">
                    <input name="email" type="text" id="email" placeholder="أكتب البريد الإلكتروني للمستخدم هنا" class="col-xs-10 col-sm-5" required autocomplete="off" >
                </div>
            </div>

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="password"> كلمة مرور المستخدم </label>

                <div class="col-sm-9">
                    <input name="password" type="password" id="password" placeholder="**********" class="col-xs-10 col-sm-5" required>
                </div>
            </div>

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="password-repat"> إعد كتابة كلمة المرور</label>

                <div class="col-sm-9">
                    <input name="password_repat" type="password" id="password-repat" placeholder="**********" class="col-xs-10 col-sm-5" required>
                </div>
            </div>

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="role">صلحية المستخدم</label>

                <div class="col-sm-4">
                    <select name="role" id="role" class="form-control col-xs-10 col-sm-5" required >
                        <option value="">أختار الصلحية للمستخدم</option>
                        <option value="1">مدير</option>
                        <option value="2">بائع</option>
                        <option value="3">مصمم</option>
                    </select>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="clearfix form-actions">
                <div class="col-md-offset-5 col-md-9">
                    <button class="btn btn-info save" type="submit">
                        <i class="ace-icon fa  fa-save bigger-110"></i>
                        حفظ
                    </button>
                </div>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>

    <script>
        (function($) {
            $('#add-user').on('submit',function (e) {
                

                var pass = $('input[name=password]').val(),
                    password_repat = $('input[name=password_repat]').val();

                if (pass != password_repat) {
                   alert('كلمت السر غير متطابقة');
                   e.preventDefault();
                   return false;
                } else {
                    return true;
                }
            });

        })(jQuery)
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>