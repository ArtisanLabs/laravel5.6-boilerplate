@extends('layouts.user')

@section('content')
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Inbox</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
						<li class="breadcrumb-item active">Inbox</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-3">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Folders</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-widget="collapse"><i
										class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body p-0">
						<ul class="nav nav-pills flex-column">
							<li class="nav-item active">
								<a href="#" class="nav-link">
									<i class="fa fa-inbox"></i> Inbox
									<span class="badge bg-success float-right">{{ number_format($unreadNotifs->count()) }}</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="fa fa-envelope-o"></i> All Notifs
									<span class="badge bg-primary float-right">{{ number_format($allNotifs) }}</span>
								</a>
							</li>
						</ul>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /. box -->
			</div>
			<!-- /.col -->
			<div class="col-md-9">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">My Inbox</h3>

						<div class="card-tools">
							<div class="input-group input-group-sm">
								<input type="text" class="form-control" placeholder="Search Mail">
								<div class="input-group-append">
									<div class="btn btn-primary">
										<i class="fa fa-search"></i>
									</div>
								</div>
							</div>
						</div>
						<!-- /.card-tools -->
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
						@if($unreadNotifs->count() > 0)
							@foreach($unreadNotifs as $unreadNotif)
								<div class="table-responsive mailbox-messages">
									<table class="table table-hover table-striped">
										<tbody>
										<tr>
											<td class="mailbox-name"><a href="read-mail.html">{{ $unreadNotif->data['title'] }}</a></td>
											<td class="mailbox-subject">{{ $unreadNotif->data['message'] }}</td>
											<td class="mailbox-date">{{ @elapsedTime($unreadNotif->updated_at->format('d M Y - H:i:s')) }}</td>
										</tr>
										</tbody>
									</table>
									<!-- /.table -->
								</div>
						@endforeach
					@else
					@endif
					<!-- /.mail-box-messages -->
					</div>
					<!-- /.card-body -->
					<div class="card-footer p-0">
						<div class="mailbox-controls">
							<!-- Check all button -->
							<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
										class="fa fa-square-o"></i>
							</button>
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i>
								</button>
								<button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i>
								</button>
								<button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i>
								</button>
							</div>
							<!-- /.btn-group -->
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
							<div class="float-right">
								1-50/200
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-sm"><i
												class="fa fa-chevron-left"></i></button>
									<button type="button" class="btn btn-default btn-sm"><i
												class="fa fa-chevron-right"></i></button>
								</div>
								<!-- /.btn-group -->
							</div>
							<!-- /.float-right -->
						</div>
					</div>
				</div>
				<!-- /. box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
@endsection