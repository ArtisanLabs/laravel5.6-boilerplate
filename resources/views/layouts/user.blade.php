@php
	function elapsedTime($updatedAt) {
		$time = new \DateTime($updatedAt);
		$now = new \DateTime(\Carbon\Carbon::now());
		$interval = $time->diff($now);

		if($interval->d == 1) {
			return $elapsed = $interval->days." day";
		}elseif ($interval->d > 1){
			return $elapsed = $interval->days." days";
		}elseif ($interval->h > 1 && $interval->d == 0) {
			return $elapsed = $interval->h." hours";
		} elseif ($interval->h == 0 && $interval->d == 0) {
			if($elapsed = $interval->i == 1) {
				return $elapsed = $interval->i." minute";
			}
			return $elapsed = $interval->i." minutes";
		} else {
			if ($elapsed = $interval->h == 1) {
				return $elapsed = $interval->h." hour";
			}
			return $elapsed = $interval->h." hours";
		}
	}
	$unreadNotifications = auth()->user()->unreadNotifications;

@endphp
		<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ env('APP_NAME') }}</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	{{--Laravel CSRF--}}
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('plugins/adminlte/adminlte.min.css') }}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
	<!-- Date Picker -->
	<link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
			</li>
			<li class="nav-item d-none d-sm-inline-block">
				<a href="{{ route('home') }}" class="nav-link">Home</a>
			</li>
		</ul>

		<!-- SEARCH FORM -->
		<form class="form-inline ml-3">
			<div class="input-group input-group-sm">
				<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-navbar" type="submit">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</div>
		</form>

		<!-- Right navbar links -->
		<ul class="navbar-nav ml-auto">
			<!-- Messages Dropdown Menu -->
			<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i class="fa fa-comments-o"></i>
					<span class="badge badge-danger navbar-badge">{{ $unreadNotifications->count() }}</span>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<a href="#" class="dropdown-item">
						<!-- Message Start -->
						@if(count($unreadNotifications) > 0)
							@foreach($unreadNotifications->take(3) as $item)
								<div class="media">
									<img src="{{ asset('img/avatar.png') }}" alt="User Avatar"
									     class="img-size-50 mr-3 img-circle">
									<div class="media-body">
										<h3 class="dropdown-item-title">
											{{ $item->data['title'] }}
											<span class="float-right text-sm text-danger"><i
														class="fa fa-star"></i></span>
										</h3>
										<p class="text-sm">{{ (strlen($item->data['message']) > 25) ? substr($item->data['message'], 0, 25).'...' : $item->data['message'] }}</p>
										<p class="text-sm text-muted"><i
													class="fa fa-clock-o mr-1"></i>{{ elapsedTime($item->updated_at) }}
											ago</p>
									</div>
								</div>
								<div class="dropdown-divider"></div>
							@endforeach
						@else
							<i class="fa fa-envelope mr-2"></i>You have no new messages.

							<span class="float-right text-muted text-sm"><i class="fa fa-refresh"></i></span>
					@endif

					<!-- Message End -->
					</a>
					<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
				</div>
			</li>
			<!-- Notifications Dropdown Menu -->
			<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i class="fa fa-bell-o"></i>
					<span class="badge badge-warning navbar-badge">15</span>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<span class="dropdown-item dropdown-header">{{ number_format($unreadNotifications->count()) }}
						Notifications</span>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item">
						@if(count($unreadNotifications) > 0)
							<i class="fa fa-envelope mr-2"></i> {{ number_format($unreadNotifications->count()) }} new
							messages

							<span class="float-right text-muted text-sm">
							{{ elapsedTime($unreadNotifications->first()->updated_at) }}
						</span>
						@else
							<i class="fa fa-envelope mr-2"></i>You have no new messages.

							<span class="float-right text-muted text-sm"><i class="fa fa-refresh"></i></span>
						@endif
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item">
						<i class="fa fa-users mr-2"></i> 8 friend requests
						<span class="float-right text-muted text-sm">12 hours</span>
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item">
						<i class="fa fa-file mr-2"></i> 3 new reports
						<span class="float-right text-muted text-sm">2 days</span>
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
				</div>
			</li>
		</ul>
	</nav>
	<!-- /.navbar -->

	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="{{ route('home') }}" class="brand-link">
			<img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
			     style="opacity: .8">
			<span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
		</a>

		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar user panel (optional) -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img src="{{ asset('img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
				</div>
				<div class="info">
					<a href="{{ route('home') }}" class="d-block">{{ auth()->user()->name }}</a>
				</div>
			</div>

			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
				    data-accordion="false">
					<!-- Add icons to the links using the .nav-icon class
						 with font-awesome or any other icon font library -->
					<li class="nav-item has-treeview">
						<a href="{{ route('home') }}" class="nav-link">
							<i class="nav-icon fa fa-dashboard"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li class="nav-item has-treeview menu-open">
						<a href="#" class="nav-link">
							<i class="nav-icon fa fa-cogs"></i>
							<p>
								Account
								<i class="right fa fa-angle-left"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="" class="nav-link">
									<i class="fa fa-user nav-icon"></i>
									<p>Profile</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('user.password') }}" class="nav-link">
									<i class="fa fa-key nav-icon"></i>
									<p>Change Password</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item has-treeview">
						<a href="{{ route('user.notifs') }}" class="nav-link">
							<i class="nav-icon fa fa-envelope"></i>
							<p>Inbox</p>
							<span class="right badge badge-danger">{{ $unreadNotifications->count() }} new</span>
						</a>
					</li>
					<li class="nav-item has-treeview">
						<a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
							<i class="nav-icon fa fa-lock"></i>
							<p>Logout</p>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</a>
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		@yield('content')
	</div>
	<!-- /.content-wrapper -->
	<footer class="main-footer text-center">
		<strong>Copyright &copy; {{ date('Y') }} <a href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>.</strong>
		All rights reserved.
	</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('plugins/adminlte/adminlte.min.js') }}"></script>
</body>
</html>
