<div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try{ace.settings.loadState('main-container')}catch(e){}
        </script>

        <div id="sidebar" class="sidebar responsive ace-save-state">
            <script type="text/javascript">
                try{ace.settings.loadState('sidebar')}catch(e){}
            </script>

            <ul class="nav nav-list">
                <?php if(Auth::user()->role === 1 || Auth::user()->role === 2): ?>
                <li <?php echo Request::path() == '/' ? 'class="active"' : ''; ?> >
                    <a href="<?php echo e(url('/')); ?>">
                        <i class="menu-icon fa fa-pencil-square-o"></i>
                        <span class="menu-text"> انشاء فاتورة </span>
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php endif; ?>

                <?php if(Auth::user()->role === 1 || Auth::user()->role === 2): ?>
                <li <?php echo Request::path() == 'bills' ? 'class="active"' : ''; ?> >
                    <a href="<?php echo e(url('bills')); ?>">
                        <i class="menu-icon fa fa-file-text-o"></i>
                        <span class="menu-text">كل الفواتير</span>
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php endif; ?>

                <?php if(Auth::user()->role === 1 || Auth::user()->role === 2): ?>
                <li <?php echo Request::path() == 'remainder' ? 'class="active"' : ''; ?> >
                    <a href="<?php echo e(url('remainder')); ?>" >
                        <i class="menu-icon fa fa-money"></i>
                        <span class="menu-text">
                            تحصيل باقي فاتورة
                        </span>

                        <!-- <b class="arrow fa fa-angle-down"></b> -->
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php endif; ?>

                <?php if(Auth::user()->role === 1): ?>
                <li <?php echo Request::path() == 'items' ? 'class="active"' : ''; ?> >
                    <a href="<?php echo e(url('items')); ?>" >
                        <i class="menu-icon fa fa-cubes"></i>
                        <span class="menu-text"> الأصناف </span>
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php endif; ?>

                <?php if(Auth::user()->role === 1): ?>
                <li <?php echo Request::path() == 'item/create' ? 'class="active"' : ''; ?> >
                    <a href="<?php echo e(url('item/create')); ?>" >
                        <i class="menu-icon fa fa-barcode"></i>
                        <span class="menu-text">
                            تكويد الأصناف
                        </span>
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php endif; ?>

                
                <li <?php echo Request::path() == 'copying/create' ? 'class="active"' : ''; ?> >
                    <a href="<?php echo e(url('copying/create')); ?>" >
                        <i class="menu-icon fa fa-clone"></i>
                        <span class="menu-text">
                            نسخ الصور للتصميم
                        </span>
                    </a>
                    <b class="arrow"></b>
                </li>

                <li <?php echo Request::path() == 'copying/search' ? 'class="active"' : ''; ?> >
                    <a href="<?php echo e(url('copying/search')); ?>" >
                        <i class="menu-icon fa fa-search"></i>
                        <span class="menu-text">
                            البحث في ارشيف الصور
                        </span>
                    </a>
                    <b class="arrow"></b>
                </li>

                <?php if(Auth::user()->role === 1): ?>
                <li <?php echo Request::path() == 'report/daily' ? 'class="active"' : ''; ?> >
                    <a href="<?php echo e(url('report/daily')); ?>" >
                        <i class="menu-icon fa fa-file-text-o"></i>
                        <span class="menu-text">
                            التقرير اليومي
                        </span>
                        <!-- <b class="arrow fa fa-angle-down"></b> -->
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php endif; ?>

                <?php if(Auth::user()->role === 1): ?>
                <li <?php echo Request::path() == 'report/custom' ? 'class="active"' : ''; ?> >
                    <a href="<?php echo e(url('report/custom')); ?>" >
                        <i class="menu-icon fa fa-bar-chart"></i>
                        <span class="menu-text">
                            تقرير مخصص
                        </span>

                        <!-- <b class="arrow fa fa-angle-down"></b> -->
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php endif; ?>

                <?php if(Auth::user()->role === 1): ?>
                <li <?php echo Request::path() == 'user/create' ? 'class="active"' : ''; ?> >
                    <a href="<?php echo e(url('user/create')); ?>" >
                        <i class="menu-icon fa fa-user-plus"></i>
                        <span class="menu-text">
                            أضافة مستخدم جديد
                        </span>

                        <!-- <b class="arrow fa fa-angle-down"></b> -->
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php endif; ?>

                <?php if(Auth::user()->role === 1): ?>
                <li <?php echo Request::path() == 'users' ? 'class="active"' : ''; ?> >
                    <a href="<?php echo e(url('users')); ?>" >
                        <i class="menu-icon fa fa-group"></i>
                        <span class="menu-text">
                            المستخدمين
                        </span>

                        <!-- <b class="arrow fa fa-angle-down"></b> -->
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php endif; ?>


                <?php if(Auth::user()->role === 1): ?>
                <li <?php echo Request::path() == 'backUp' ? 'class="active"' : ''; ?> >
                    <a href="<?php echo e(url('backUp')); ?>" >
                        <i class="menu-icon fa fa-database"></i>
                        <span class="menu-text">
                            النسخ الاحتياطي
                        </span>
                        <!-- <b class="arrow fa fa-angle-down"></b> -->
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php endif; ?>

                <?php if(Auth::user()->role === 1): ?>
                <li <?php echo Request::path() == 'settings' ? 'class="active"' : ''; ?> >
                    <a href="<?php echo e(url('settings')); ?>" >
                        <i class="menu-icon fa fa-sliders"></i>
                        <span class="menu-text">
                            اعدادات النظام
                        </span>
                        <!-- <b class="arrow fa fa-angle-down"></b> -->
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php endif; ?>
            </ul><!-- /.nav-list -->

            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
            </div>
        </div>

