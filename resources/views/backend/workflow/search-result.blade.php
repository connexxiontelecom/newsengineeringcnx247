@extends('layouts.app')

@section('title')
    Search Result
@endsection

@section('extra-styles')

@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="card">
				<div class="card-block">
					<div class="col-lg-12 col-xl-12">
						<ul class="nav nav-tabs md-tabs" role="tablist">
								<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Workflow Tasks</a>
										<div class="slide"></div>
								</li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content card-block">
								<div class="tab-pane active" id="home3" role="tabpanel">
								<h5 class="sub-title">Search Result  for <small><label for="" class="label label-info">{{$search ?? ''}}</label></small></h5>
									@include('backend.workflow.common._run-business-process')
									@if(session()->has('success'))
									<div class="alert alert-success border-success">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<i class="icofont icofont-close-line-circled"></i>
											</button>
											{!! session('success') !!}
									</div>
									@endif
									<div class="row">
									<div class="col-md-6">
										<form action="{{route('search-workflow-assignment')}}" method="post">
											@csrf
											<div class="input-group input-group-button">
													<input type="text" class="form-control" placeholder="Search item" name="search_item" id="search_item">
													<button type="submit" class="input-group-addon btn btn-primary" id="basic-addon10">
															<span class="">Search</span>
													</button>
											</div>

										</form>
									</div>
								</div>
									<div class="form-group col-sm-2 col-md-2 mb-3">
										<label for="">Filter</label>
										<select name="filter" id="filter-assignments" class="form-control">
											<option disabled selected>Filter request</option>
											<option value="all">All</option>
											<option value="declined">Declined</option>
											<option value="approved">Approved</option>
											<option value="in-progress">In-progress</option>
										</select>
									</div>
									<div class="dt-responsive table-responsive mt-4">
											<table id="datatable-assignment" class="table table-striped table-bordered nowrap">
													<thead>
															<tr class="text-uppercase">
																	<th>#</th>
																	<th>Title</th>
																	<th>Description</th>
																	<th>Status</th>
																	<th>Date</th>
															</tr>
													</thead>
													<tbody>
															@php
																	$i = 1;
															@endphp
															@if(count($results) > 0)
																@foreach ($results as $request)
																		<tr class="table-row {{$request->post_status}} all">
																				<td class="serial-no">{{$i++}}</td>
																				<td>
																						<a href="{{ route('view-workflow-task', $request->post_url) }}">{!! strlen($request->post_title) > 18 ? substr($request->post_title, 0,15).'...' : $request->post_title !!}</a>
																				</td>
																				<td>
																						{!! strlen($request->post_content ) > 35 ? substr($request->post_content, 0,35).'...' : $request->post_content  !!}
																				</td>
																				<td>
																						@if($request->post_status == 'in-progress')
																								<label class="badge badge-warning text-white special-badge"><small class="text-uppercase">in-progress</small></label>
																						@elseif($request->post_status == 'approved')
																								<label class="badge badge-success special-badge"><small class="text-uppercase">approved</small></label>

																						@elseif($request->post_status == 'declined')
																								<label class="badge badge-danger special-badge"><small class="text-uppercase">declined</small></label>
																						@endif
																				</td>
																				<td> <small class="text-uppercase">{{date('d M, Y | h:i a', strtotime($request->created_at))}}</small> </td>

																		</tr>
																@endforeach
															@else
																		<tr>
																			<td colspan="5">No result found for this search keyword.</td>
																		</tr>
															@endif



													</tbody>

											</table>
									</div>
								</div>

						</div>
				</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('dialog-section')
<div class="modal fade" id="transactionPasswordModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
			<div class="modal-content">
					<div class="modal-header bg-warning">
							<h4 class="modal-title">Transaction Password</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span class="text-white" aria-hidden="true">&times;</span>
					</button>
					</div>
					<div class="modal-body">
						<div class="card">
							<div class="card-block">
								<div class="form-group">
									<label for="">Transaction Password</label>
									<input type="password" placeholder="Enter Transaction Password" name="transaction_password" id="transaction_password" class="form-control">
									<input type="hidden" id="post">
									<input type="hidden" id="action">
								</div>
								<div class="form-group">
										<div class="btn-group d-flex justify-content-center">
											<button class="btn-mini btn btn-danger"><i class="ti-close mr-2"></i> Cancel</button>
											<button class="btn-mini btn btn-primary" type="button" id="verifyThenAct"><i class="ti-check mr-2"></i> Submit</button>
										</div>
								</div>
							</div>
						</div>
					</div>
			</div>
	</div>
</div>
@endsection

@section('extra-scripts')

    <script>
        $(document).ready(function() {


						$(document).on('click', '.approve-request', function(e){
							e.preventDefault();
							$('#action').val('approved');
							$('#post').val($(this).val());
						});
						$(document).on('click', '.decline-request', function(e){
							e.preventDefault();
							$('#action').val('declined');
							$('#post').val($(this).val());
						});

						$(document).on('change', '#filter-assignments', function(e){
							e.preventDefault();
								$(this).find('option:selected').each(function(index){
							var serial = 1;
									var optionValue = $(this).attr('value');
									if(optionValue){
										$('.table-row').not('.'+optionValue).hide();
										$('.'+optionValue).show();
										var rows= $('.'+optionValue).length;
										/*$('.'+optionValue).each(function(index) {
											for(var i=0; i<rows; i++){
													$('.serial-no').text(i);
												}
										});*/
									}else if(optionValue == 'all'){
										$('.table-row').css('display', 'block');
									}else{
										$('.table-row').hide();
									}
								});
						});
						$(document).on('change', '#filter-my-request', function(e){
							e.preventDefault();
								$(this).find('option:selected').each(function(index){
							var serial = 1;
									var optionValue = $(this).attr('value');
									if(optionValue){
										$('.table-row').not('.'+optionValue).hide();
										$('.'+optionValue).show();
										var rows= $('.'+optionValue).length;
										/*$('.'+optionValue).each(function(index) {
											for(var i=0; i<rows; i++){
													$('.serial-no').text(i);
												}
										});*/
									}else if(optionValue == 'all'){
										$('.table-row').css('display', 'block');
									}else{
										$('.table-row').hide();
									}
								});
						});

						$(document).on('blur', '#search_item', function(e){
							e.preventDefault();
							var term = $(this).val();
							axios.post('/search-workflow-assignment',{term:term})
							.then(response=>{
								console.log(response.data)
							})
							.catch(error=>{

							});
						});

						$(document).on('click', '#verifyThenAct', function(e){
							e.preventDefault();
							$(this).text('Processing...');
							if($('#transaction_password').val() == ''){
								Toastify({
									text: "Ooops! Enter transaction password",
									duration: 3000,
									newWindow: true,
									close: true,
									gravity: "top",
									position: "right",
									backgroundColor: "linear-gradient(to right, #FF0000, #DE0000)",
									stopOnFocus: true,
									onClick: function(){}
								}).showToast();
								$(this).html("<i class='ti-check mr-2'></i> Submit");
							}else{
								axios.post('/workflow/approve-or-decline-request',{
									post:$('#post').val(),
									transaction_password:$('#transaction_password').val(),
									action:$('#action').val()
								})
								.then(response=>{
									Toastify({
										text: "Success! Request approved.",
										duration: 3000,
										newWindow: true,
										close: true,
										gravity: "top",
										position: "right",
										backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
										stopOnFocus: true,
										onClick: function(){}
									}).showToast();
									$(this).html("<i class='ti-check mr-2'></i> Submit");
									$('#transactionPasswordModal').modal('hide');
									location.reload();
								})
								.catch(error=>{
									Toastify({
										text: "Mis-match transaction password. Try again. You can set a new transaction password by following: Profile > Settings > Security.",
										duration: 7000,
										newWindow: true,
										close: true,
										gravity: "top",
										position: "right",
										backgroundColor: "linear-gradient(to right, #FF0000, #DE0000)",
										stopOnFocus: true,
										onClick: function(){}
									}).showToast();
									$(this).html("<i class='ti-check mr-2'></i> Submit");
								});
							}
						});
        } );

    </script>
@endsection
