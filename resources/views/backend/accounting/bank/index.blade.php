@extends('layouts.app')

@section('title')
    Banks
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-block">
					<div class="card-header">
						@if (session()->has('success'))
							<div class="alert alert-success background-success mt-3">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<i class="icofont icofont-close-line-circled text-white"></i>
								</button>
								{!! session()->get('success') !!}
							</div>
						@endif

						@if($errors->any())

							<div class="alert alert-success background-success mt-3">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<i class="icofont icofont-close-line-circled text-white"></i>
								</button>
								{{$errors->first()}}
							</div>

						@endif

					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="card">
								<div class="card-header">
									<h5 class="sub-title">Setup Bank</h5>
								</div>
								<div class="card-block">
									<form action="{{route('add-new-bank')}}" method="post">
										@csrf
										<div class="form-group">
											<label for="">Bank Name</label>
											<input type="text" name="bank_name" placeholder="Bank Name" class="form-control">
											@error('bank_name')
											<i class="text-danger mt-2">{{$message}}</i>
											@enderror
										</div>
										<div class="form-group">
											<label for="">Account Number </label>
											<input type="text" name="bank_account_number" placeholder="Account Number" class="form-control">
											@error('bank_account_number')
											<i class="text-danger mt-2">{{$message}}</i>
											@enderror
										</div>

										<div class="form-group">
											<label for="">Bank Branch/ Address</label>
											<textarea class="form-control" name="bank_branch" placeholder="Bank Address/Branch">
											</textarea>
											@error('bank_branch')
											<i class="text-danger mt-2">{{$message}}</i>
											@enderror

										</div>
										<div class="form-group">
											<label for="">Bank GL Code</label>
											<select class="form-control" name="bank_gl_code">
												<option selected disabled>--Select bank--</option>
												@foreach($bank_details as $bank_detail):
												<option value="{{$bank_detail->glcode}}">{{$bank_detail->glcode ?? ''  }} - {{$bank_detail->account_name ?? ''}}</option>
												@endforeach;
											</select>
											@error('bank_gl_code')
											<i class="text-danger mt-2">{{$message}}</i>
											@enderror
										</div>

										<div class="form-group">
											<div class="btn-group d-flex justify-content-center">
												<a href="{{url()->previous()}}" class="btn btn-mini btn-danger"> <i class="ti-close mr-2"></i> Cancel</a>
												<button type="submit" class="btn btn-mini btn-success"> <i class="ti-check mr-2"></i> Submit</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-sm-8">
							<div class="card">
								<div class="card-header">
									<h5>Banks</h5>
									<span>Registered banks with their respective codes</span>

								</div>
								<div class="card-block">
									<div class="dt-responsive table-responsive">
										<table id="simpletable" class="table table-striped table-bordered nowrap">
											<thead>
											<tr>
												<th>#</th>
												<th>Bank Name</th>
												<th>Bank Account Number</th>
												<th> GL Code</th>
												<th> Bank Branch</th>
												<th>Date</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
											@php
												$serial = 1;
											@endphp
											@foreach($banks as $bank)
												<tr>
													<td>{{$serial++}}</td>
													<td>{{$bank->bank_name}}</td>
													<td>{{$bank->bank_account_number}}</td>
													<td>{{$bank->bank_gl_code}} - {{$bank->account_name ?? ''}}</td>
													<td>{{$bank->bank_branch}}</td>
													<td>{{date('d F, Y', strtotime($bank->created_at))}}</td>
													<td>
														<a href="javascript:void(0);" data-toggle="modal" data-target="#edit-bank{{$bank->id}}"> <i class="ti-pencil text-warning"></i> </a>
													</td>
												</tr>
											@endforeach
											</tbody>
											<tfoot>
											<tr>
												<th>#</th>
												<th>Bank Name</th>
												<th>Bank Account Number</th>
												<th> GL Code</th>
												<th> Bank Branch</th>
												<th>Date</th>
												<th>Action</th>
											</tr>
											</tfoot>
										</table>
									</div>
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

    @foreach($banks as $bank)

         <div class="modal fade" id="edit-bank{{$bank->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $bank->bank_name." (". $bank->bank_account_number .")" }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-block">
                            <form action="{{route('update-bank')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Bank Name</label>
                                    <input type="text" name="bank_name" value="{{ $bank->bank_name }}"  placeholder="Bank Name" class="form-control">
                                    @error('bank_name')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>

                                <input type="hidden" name="edit_mode"  value="1" class="form-control">

                                <input type="hidden" name="bank_id" value="{{ $bank->id  }}" class="form-control">
                                <div class="form-group">
                                    <label for="">Account Number </label>
                                    <input type="text" name="bank_account_number"  value="{{ $bank->bank_account_number  }}"  placeholder="Account Number" class="form-control">
                                    @error('bank_account_number')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Bank Branch/ Address</label>
                                    <textarea class="form-control" name="bank_branch"  placeholder="Bank Address/Branch">

                                            {{ $bank->bank_branch  }}
                                           </textarea>
                                    @error('bank_branch')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror

                                </div>


                                <div class="form-group">
                                    <label for="">Bank GL Code</label>
                                    <select class="form-control" name="bank_gl_code">
                                        @foreach($bank_details as $bank_detail):

                                        <option value="{{$bank_detail->glcode}}"  @if($bank_detail->glcode == $bank->bank_gl_code): {{'selected'}}   @endif > {{$bank_detail->glcode ?? ''  }} - {{$bank_detail->account_name ?? ''}}  </option>


                                        @endforeach;
                                    </select>

                                    @error('bank_gl_code')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <div class="btn-group d-flex justify-content-center">
                                        <a href="javascript:void(0);"  class="btn btn-mini btn-danger"> <i class="ti-close mr-2"></i> Cancel</a>
                                        <button type="submit" class="btn btn-mini btn-success"> <i class="ti-check mr-2"></i> Save Changes </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    @endforeach

@endsection

@section('extra-scripts')
    <script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>

    <script src="\assets\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
    <script src="\assets\pages\data-table\js\jszip.min.js"></script>
    <script src="\assets\pages\data-table\js\pdfmake.min.js"></script>
    <script src="\assets\pages\data-table\js\vfs_fonts.js"></script>
    <script src="\bower_components\datatables.net-buttons\js\buttons.print.min.js"></script>
    <script src="\assets\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>

    <script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>

    <script src="\assets\pages\data-table\js\data-table-custom.js"></script>


@endsection
