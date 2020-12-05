<!DOCTYPE html>
<html lang="ar">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Studio Lite</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<link rel="icon" href="{{ asset('img/logo.png') }}" >

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
		<!-- <link rel="stylesheet" href="{{ asset('assets/rtl/bootstrap-rtl.min.css') }}" /> -->

		<link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />

		@yield('custom-css')

		<link rel="stylesheet" href="{{ asset('assets/css/jquery.gritter.min.css')  }}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />
		<!-- <link rel="stylesheet" href="{{ asset('assets/rtl/ace-rtl.css') }}" /> -->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}" />
		<![endif]-->

		<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
		<script src="{{ asset('assets/js/respond.min.js') }}"></script>
		<![endif]-->

		<script>
			window.Laravel = <?php echo json_encode([
				'csrfToken' => csrf_token(),
			]); ?>
		</script>

	</head>

	<body class="no-skin rtl">
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-right" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-right">
					<a href="{{ url('/') }}" class="navbar-brand">
						<small>
							<i class="fa fa-camera-retro"></i>
							Studio Lite
						</small>
					</a>
				</div>

				<?php 
					$bills = \App\Models\Bill::whereDate('deliveryDate',date('Y-m-d'))->get();
				?>

				<div class="navbar-buttons navbar-header pull-left" role="navigation">
					<ul class="nav ace-nav">
						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell {{ (count($bills) > 0) ? 'icon-animated-bell' : '' }}"></i>
								@if(count($bills) > 0)
								<span class="badge badge-important">{{ count($bills) }}</span>
								@endif
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									{{ count($bills) }} الطلبات
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">

										@if (count($bills) > 0)
											@foreach ($bills as $bill)
												<li>
													<a href="#">
														<div class="clearfix">
															<span class="pull-right">
																{{-- <i class="btn btn-xs no-hover btn-pink fa fa-comment"></i> --}}
																{{ $bill->agentName }}
															</span>
															<span class="pull-left badge badge-info">{{ $bill->id }}</span>
														</div>
													</a>
												</li>
											@endforeach
										@else
											<li>
												<a href="#">
													<div class="clearfix">
														<i class="pull-right">
															{{-- <i class="btn btn-xs no-hover btn-pink fa fa-comment"></i> --}}
															لا توجد اي طلبات تحت التصميم حتي الان
														</i>
													</div>
												</a>
											</li>
										@endif
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										كل الطلبات تحت التصميم
										<i class="ace-icon fa fa-arrow-left"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								{{-- <img class="nav-user-photo" src="{{ asset('assets/images/avatars/user.jpg') }}" alt="Jason's Photo" /> --}}
								<span class="user-info">
									<small>مرحباً,</small>
									{{ Auth::user()->name }}
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="{{ url('user/edit').'/'.Auth::user()->id }}">
										<i class="ace-icon fa fa-cog"></i>
										أعدادات الحساب
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="{{ url('/logout') }}">
										<i class="ace-icon fa fa-power-off"></i>
										تسجيل الخروج
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

@include('theme.components.sidebar')