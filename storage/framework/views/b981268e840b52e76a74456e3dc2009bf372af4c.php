<?php $__env->startSection('container'); ?>
    <div class="page-header">
        <h1>
            الفواتير
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
    <table id="simple-table" class="table  table-bordered table-hover">
        <thead>
            <tr>
                <th>رقم الفاتورة</th>
                <th>اسم العميل</th>
                <th>المدفوع</th>
                <th>الإجمالي</th>
                <th>تاريخ الإنشاء</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($bills) > 0): ?>
                <?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                        <td style="width: 80px" class="text-center">
                            <span class="badge badge-grey" ><?php echo e($bill->id); ?></span>
                        </td>
                        <td><p><?php echo e($bill->agentName); ?></p></td>
                        <td>
                            <span class="badge badge-primary"><?php echo e($bill->paid); ?></span>
                        </td>
                        <td>
                            <span class="badge badge-success"><?php echo e($bill->turnover); ?></span>
                        </td>
                        <td><?php echo e(date('Y-m-d',strtotime($bill->created_at))); ?></td>
                        <td class="text-center" >
                            <a href="<?php echo e(url('bill/view').'/'.$bill->id); ?>" class="btn btn-xs btn-info">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php else: ?> 
                <tr>
                    <td class="text-center" colspan="6" >
                        <i>لا توجد اي فواتير تم أضافتها حتي الأن.</i>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php echo e($bills->links()); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>