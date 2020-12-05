<?php $__env->startSection('container'); ?>
    <div class="page-header">
        <h1>
            المستخدمون
            <small>
                <i class="ace-icon fa fa-angle-double-left"></i>
                جميع المستخدمون في النظام
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
                <th>اسم المستخدم</th>
                <th>البريد الإلكتروني</th>
                <th>تاريخ الإنشاء</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($users) > 0): ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ky=>$user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                        <td><p><?php echo e($user->name); ?></p></td>
                        <td>
                            <p><?php echo e($user->email); ?></p>
                        </td>
                        <td><?php echo e(date('d/m/Y',strtotime($user->created_at))); ?></td>
                        <td>
                            <form action="<?php echo e(url('user/delete/').'/'.$user->id); ?>" method="POST" >
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('DELETE')); ?>

                                <a href="<?php echo e(url('user/edit').'/'.$user->id); ?>" class="btn btn-xs btn-info">
                                    <i class="fa fa-pencil-square"></i>
                                </a>
                                <?php if(Auth::user()->id != $user->id & $user->role != 1): ?>
                                    <button type="submit" class="btn btn-xs btn-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                <?php endif; ?>
                            </form>
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

    <?php echo e($users->links()); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>