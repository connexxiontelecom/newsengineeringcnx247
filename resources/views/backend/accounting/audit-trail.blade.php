@extends('layouts.app')

@section('title')
	Audit Trail
@endsection

@section('extra-styles')
	<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">

@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			@if (session()->has('success'))
				<div class="alert alert-success background-success mt-3">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="icofont icofont-close-line-circled text-white"></i>
					</button>
					{!! session()->get('success') !!}
				</div>
			@endif
				@if (session()->has('error'))
				<div class="alert alert-warning background-warning mt-3">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="icofont icofont-close-line-circled text-white"></i>
					</button>
					{!! session()->get('error') !!}
				</div>
			@endif
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="card">
						<div class="card-block">
							<h5 class="sub-title">Audit Trail</h5>
							<div class="row">
								<div class="col-md-6 offset-md-3">
									<form action="{{route('audit-trail')}}" method="post">
										@csrf
										<div class="form-group">
											<label for="">Para</label>
											<select name="search_parameter" id="search_parameter" class="form-control">
												<option selected disabled>--Select--</option>
												<option value="1">Keyword phrase</option>
												<option value="2">By user</option>
												<option value="3">By date range</option>
											</select>
											@error('search_parameter')
												<i class="text-danger mt-2">{{$message}}</i>
											@enderror
										</div>
										<input type="text" id="keyword_phrase" placeholder="Enter keyword phrase" name="keyword_phrase" class="form-control">
										<select name="user" id="user" class="form-control">
											<option selected disabled>--Select user--</option>
											@foreach($users as $user)
												<option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
											@endforeach
										</select>
										<div class="input-group input-group-button" id="date_range">
												<span class="input-group-addon btn btn-primary" id="basic-addon9">
														<span class="">From</span>
												</span>
											<input type="date" class="form-control" name="start_date" placeholder="Start Date">
											<span class="input-group-addon btn btn-primary" id="basic-addon9">
														<span class="">To</span>
												</span>
											<input type="date"  class="form-control" name="end_date" placeholder="End Date">
										</div>
										<div class="form-group d-flex justify-content-center mt-3">
											<div class="btn-group">
												<a href="" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</a>
												<button class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i>Submit</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						@if($status == 1)
							<div class="dt-responsive table-responsive">
								<table id="simpletable" class="table table-striped table-bordered nowrap">
									<thead>
									<tr>
										<th>#</th>
										<th>Date</th>
										<th>User</th>
										<th>Log</th>
									</tr>
									</thead>
									<tbody>
									@php
										$serial = 1;
									@endphp
									@foreach($logs as $log)
										<tr>
											<td>{{$serial++}}</td>
											<td>{{!is_null($log->created_at) ? date('d M, Y', strtotime($log->created_at)) : '-'}}</td>
											<td>{{$log->getUser->first_name ?? ''}} {{$log->getUser->surname ?? ''}}</td>
											<td>{{$log->activity ?? ''}}</td>
										</tr>
									@endforeach
									</tbody>
									<tfoot>
									<tr>
										<th>#</th>
										<th>Date</th>
										<th>User</th>
										<th>Log</th>
									</tr>
									</tfoot>
								</table>
							</div>
						@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')
	<script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
	<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
	<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
	<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
	<script src="\assets\pages\data-table\js\data-table-custom.js"></script>
	<script>
		$(document).ready(function(){
			$('#keyword_phrase').hide();
			$('#user').hide();
			$('#date_range').hide();

			$('#search_parameter').on('change', function(e){
				e.preventDefault();
				switch($(this).val() ){
					case '1':
						$('#user').hide();
						$('#date_range').hide();
						$('#keyword_phrase').show();
					break;
					case '2':
						$('#user').show();
						$('#date_range').hide();
						$('#keyword_phrase').hide();
					break;
					case '3':
						$('#user').hide();
						$('#date_range').show();
						$('#keyword_phrase').hide();
					break;

				}
			});
		});
	</script>
@endsection
