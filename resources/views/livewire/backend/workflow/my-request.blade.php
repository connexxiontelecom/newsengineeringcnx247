
	<div class="card">
			<div class="card-block">
					<h5 class="sub-title">My Requests</h5>
					@include('backend.workflow.common._run-business-process')
					<div class="dropdown-primary dropdown open mt-2 mb-3">
							<button class="btn btn-primary btn-sm dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-filter mr-2"></i> {{$current_action ?? 'Filter'}}</button>
							<div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
									<a class="dropdown-item waves-light waves-effect" href="javascript:void(0);" wire:click="allWorkflows">All</a>
									<a class="dropdown-item waves-light waves-effect" href="javascript:void(0);" wire:click="inprogressWorkflows">In-progress</a>
									<a class="dropdown-item waves-light waves-effect" href="javascript:void(0);" wire:click="approvedWorkflows">Approved</a>
									<a class="dropdown-item waves-light waves-effect" href="javascript:void(0);" wire:click="declinedWorkflows">Declined</a>
							</div>
					</div>
					@if ($loaderStatus == 1)
					<img src="/assets/images/loader.gif" height="70" width="70" alt="">

					@endif
					<div class="dt-responsive table-responsive">
							<table id="datatable-request" class="table table-bordered table-striped table-md">
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
													$index = 1;
											@endphp
											@foreach ($my_requests as $mine)
											<tr>
													<td>{{$index++}}</td>
													<td>
															<a href="{{ route('view-workflow-task', $mine->post_url) }}">{!! strlen($mine->post_title) > 18 ? substr($mine->post_title, 0,15).'...' : $mine->post_title !!}</a>
													</td>
													<td>
															{!! strlen(strip_tags($mine->post_content) ) > 25 ? substr(strip_tags($mine->post_content), 0,25).'...' : strip_tags($mine->post_content)  !!}
													</td>
													<td>
															@if($mine->post_status == 'in-progress')
																	<label class="badge badge-warning text-white special-badge"><small class="text-uppercase">in-progress</small></label>
															@elseif($mine->post_status == 'approved')
																	<label class="badge badge-success special-badge"><small class="text-uppercase">approved</small></label>

															@elseif($mine->post_status == 'declined')
																	<label class="badge badge-danger special-badge"><small class="text-uppercase">declined</small></label>
															@endif
													</td>
													<td> <small class="text-uppercase">{{date('d M, Y | h:i a', strtotime($mine->created_at))}}</small> </td>
											</tr>


											@endforeach
									</tbody>
							</table>
							<div class="col-md-12 col-lg-12 d-flex justify-content-center" style="cursor: pointer;">

							</div>
					</div>
			</div>
	</div>

	@push('my-request-scripts')
			<script>
				   $(document).ready(function() {
            $('#datatable-request').DataTable();
        } );
			</script>
	@endpush
