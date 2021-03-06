@if(session('error'))
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h5><i class="icon fa fa-ban"></i> Error!</h5>
		{{ session('error') }}
	</div>
@endif

@if(session('success'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h5><i class="icon fa fa-check"></i> Success!</h5>
		{{ session('success') }}
	</div>
@endif

@if(session('info'))
	<div class="alert alert-info alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h5><i class="icon fa fa-info-circle"></i> Info!</h5>
		{{ session('info') }}
	</div>
@endif

