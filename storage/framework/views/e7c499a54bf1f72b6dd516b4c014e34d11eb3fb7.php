<?php echo $__env->make('theme.components.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo e(url('index/')); ?>">الرئيسية</a>
                </li>
                <?php echo $__env->yieldContent('breadcrumb'); ?>
            </ul><!-- /.breadcrumb -->

            <!-- <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div>/.nav-search -->

        </div>

        <div class="page-content">
            <?php echo $__env->yieldContent('container'); ?>
        </div>
    </div>
</div>

<?php echo $__env->make('theme.components.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>