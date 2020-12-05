<?php $__env->startSection('container'); ?>
    <div class="page-header">
        <h1>
            النسخ الاحطياتي
            <small>
                <i class="ace-icon fa fa-angle-double-left"></i>
                كل الفواتير بالنظام
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

    <ul class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" href="#home">
                <i class="blue ace-icon fa fa-upload bigger-120"></i>
                تصدير
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#menu1">
                <i class="green ace-icon  fa fa-download  bigger-120"></i>
                استيراد
            </a>
        </li>
    </ul>
    
    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <h3>تصدير البيانات</h3>
            <p></p>
            <form action="<?php echo e(url('backUp/export')); ?>" method="POST">
                <?php echo e(csrf_field()); ?>

                <input type="submit" class="btn btn-info" name="export" id="" value="تصدير  قاعدة البيانات">
            </form>
        </div>
        <div id="menu1" class="tab-pane fade">
            <form method="post" action="<?php echo e(url('backUp/import')); ?>" enctype="multipart/form-data" id="frm-restore">
                <?php echo e(csrf_field()); ?>

                <div class="form-row">
                    <div>Choose Backup File</div>
                    <div>
                        <input type="file" name="backup_file" class="input-file" />
                    </div>
                </div>
                <div>
                    <input type="submit" name="restore" value="Restore"
                        class="btn-action" />
                </div>
            </form>
        </div>
    </div>
        
<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>