<!DOCTYPE html>
<html lang="ar">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Studio Lite | تسجيل الدخول</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')); ?>" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/css/fonts.googleapis.com.css')); ?>" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/css/ace.min.css')); ?>" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo e(asset('assets/css/ace-part2.min.css')); ?>" />
		<![endif]-->
		

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo e(asset('assets/css/ace-ie.min.css')); ?>" />
        <![endif]-->
        
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>" />

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo e(asset('assets/js/html5shiv.min.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/js/respond.min.js')); ?>"></script>
		<![endif]-->
	</head>

	<body class="login-layout light-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-camera-retro blue"></i>
									<span class="red">Studio</span>
									<span class="white" id="id-text2">Lite</span>
								</h1>
								<h4 class="blue" id="id-company-text">&copy; LeeuCode</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger text-right">
												<i class="ace-icon fa fa-coffee green"></i>
												من فضلك قم بادخل البيانات
											</h4>

											<div class="space-6"></div>

											<form  method="POST" action="<?php echo e(url('/login')); ?>" >
                                                <?php echo e(csrf_field()); ?>

												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name="email" value="<?php echo e(old('email')); ?>" required autofocus class="form-control text-left" placeholder="اسم المستخدم او البريد الالكتلاوني" />
															<i class="ace-icon fa fa-user"></i>
                                                        </span>
                                                        <?php if($errors->has('email')): ?>
                                                            <span class="help-block">
                                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                                            </span>
                                                        <?php endif; ?>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="password" required class="form-control text-left" placeholder="أكتب كلمة مرور المستخدم" />
															<i class="ace-icon fa fa-lock"></i>
                                                        </span>
                                                        <?php if($errors->has('password')): ?>
                                                            <span class="help-block">
                                                                <strong><?php echo e($errors->first('password')); ?></strong>
                                                            </span>
                                                        <?php endif; ?>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> />
															<span class="lbl"> تذكرني</span>
														</label>

														<button type="submit" class="pull-left btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">تسجيل الدخول</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
                                            </form>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
							</div><!-- /.position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo e(asset('assets/js/jquery-2.1.4.min.js')); ?>"></script>
		<!-- <![endif]-->

		<!--[if IE]>
            <script src="<?php echo e(asset('assets/js/jquery-1.11.3.min.js')); ?>"></script>
        <![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo e(asset('assets/js/jquery.mobile.custom.min.js')); ?>'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		
	</body>
</html>

