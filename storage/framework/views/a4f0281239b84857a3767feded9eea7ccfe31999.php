<?php $__env->startSection('container'); ?>
    <div class="page-header">
        <h1>
            الأصناف
            <small>
                <i class="ace-icon fa fa-angle-double-left"></i>
                جميع الأنصاف في النظام
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
                <th>اسم الصنف</th>
                <th>السعر</th>
                <th>التسليم بعد</th>
                <th>تاريخ الإنشاء</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($items) > 0): ?>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                        <td><p><?php echo e($item->name); ?></p></td>
                        <td><?php echo e($item->price); ?></td>
                        <td>
                            <span class="badge badge-success"><?php echo e($item->delivery); ?></span>
                        </td>
                        <td><?php echo e(date('d/m/Y',strtotime($item->created_at))); ?></td>
                        <td>
                            <a href="<?php echo e(url('item/edit').'/'.$item->id); ?>" class="btn btn-xs btn-info">
                                <i class="fa fa-pencil-square"></i>
                            </a>
                            
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php else: ?> 
                <tr>
                    <td class="text-center" colspan="5" >
                        <i>لا توجد اي أصناف تم أضافتها حتي الأن.</i>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php echo e($items->links()); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>