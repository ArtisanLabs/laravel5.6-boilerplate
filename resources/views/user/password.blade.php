@extends('layouts.user')

@section('content')

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Update Password Section</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
						<li class="breadcrumb-item active">Update Password</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- left column -->
				<div class="col-md-12 col-sm-12 col-xs-12">
					<!-- general form elements -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Update Password</h3>
						</div>
						<!-- /.card-header -->
					<!-- form start -->
						<div class="row">
							<div class="col-md-6 offset-md-3">
								<div style="padding-top: 10px">
									@include('inc.messages')
								</div>
								<form role="form" action="{{ route('user.password') }}" method="POST">
									@csrf
									<div class="card-body">
										<div class="form-group">
											<label for="password">Current Password</label>
											<input type="password"
											       class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
											       id="password" name="password"
											       placeholder="Current Password" required minlength="8">

											@if ($errors->has('password'))
												<span class="invalid-feedback">
			                                        <strong>{{ $errors->first('password') }}</strong>
			                                    </span>
											@endif
										</div>
										<div class="form-group">
											<label for="newPassword">New Password</label>
											<input type="password"
											       class="form-control {{ $errors->has('newPassword') ? ' is-invalid' : '' }}"
											       id="newPassword" name="newPassword"
											       placeholder="New Password" required minlength="8">

											@if ($errors->has('newPassword'))
												<span class="invalid-feedback">
			                                        <strong>{{ $errors->first('newPassword') }}</strong>
			                                    </span>
											@endif
										</div>
										<div class="form-group">
											<label for="confirmPassword">Confirm Password</label>
											<input type="password"
											       class="form-control {{ $errors->has('confirmPassword') ? ' is-invalid' : '' }}"
											       id="confirmPassword" name="confirmPassword"
											       placeholder="Confirm New Password" required minlength="8">

											@if ($errors->has('confirmPassword'))
												<span class="invalid-feedback">
			                                        <strong>{{ $errors->first('confirmPassword') }}</strong>
			                                    </span>
											@endif
										</div>
									</div>
									<!-- /.card-body -->
									<div class="card-footer ">
										<button type="submit" class="btn btn-primary btn-block">Update Password</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- /.card -->
				</div>
				<!--/.col (left) -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
@endsection