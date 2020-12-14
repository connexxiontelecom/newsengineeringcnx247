@extends('layouts.app')

@section('title')
    Add New Supplier
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('backend.procurement.supplier.common._procurement-slab')
    </div>
</div>
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
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="sub-title">Add New Supplier</h5>
                                <form action="{{route('new-supplier')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Company Name</label>
                                                <input type="text" name="company_name" placeholder="Company Name" value="{{old('company_name')}}"  class="form-control">
                                                @error('company_name')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Company Email</label>
                                                <input type="text" name="company_email" value="{{old('company_email')}}" placeholder="Company Email"  class="form-control">
                                                @error('company_email')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Company Phone</label>
                                                <input type="text" name="company_phone" placeholder="Company Phone" value="{{old('company_phone')}}"  class="form-control">
                                                @error('company_phone')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Company Address</label>
                                                <textarea name="company_address" placeholder="Company Address" style="resize: none;" class="form-control">{{old('address')}}</textarea>
                                                @error('company_address')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Industry</label>
                                                <select name="industry" id="" class="form-control">
                                                    <option selected disabled >Select industry</option>
                                                    @foreach ($industries as $industry)
                                                        <option value="{{$industry->id}}">{{$industry->industry ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                                @error('industry')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Team size</label>
                                                <input type="number" step="0.01" class="form-control" placeholder="Team size" name="team_size">
                                                @error('team_size')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="sub-title">Contact Person</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">First Name</label>
                                                <input type="text" placeholder="First Name" name="first_name" value="{{old('first_name')}}" class="form-control">
                                                @error('first_name')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Email Address</label>
                                                <input type="text" placeholder="Email Address" name="email_address" value="{{old('email_address')}}" class="form-control">
                                                @error('email_address')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Position</label>
                                                <input type="text" placeholder="Position" name="position" value="{{old('position')}}" class="form-control">
                                                @error('position')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Mobile Number</label>
                                                <input type="text" placeholder="Mobile Number" name="mobile_no" value="{{old('mobile_no')}}" class="form-control">
                                                @error('mobile_no')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
																		</div>

                                    @if($status == 1)
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Vendor Account</label>
                                                <select name="vendor_account" class="js-example-basic-single col-sm-12 form-control" >
                                                    <option selected disabled>Select vendor account</option>
                                                    @foreach($accounts as $account)
                                                        <option value="{{$account->glcode}}">{{$account->account_name ?? ''}} - {{$account->glcode ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
																		</div>
																		@else
																		<div class="row mb-4">
																			<div class="col-md-6">
																					<div class="form-group">
																						<label for="">Kindly generate accounts under chart of accounts to complete this process.</label>
																					</div>
																			</div>
																		</div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="sub-title">Additional Information</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Comment</label>
                                                <textarea name="comment" id="comment" style="resize: none;" placeholder="Comment" class="form-control"></textarea>
                                                @error('comment')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <div class="btn-group">
                                                <button class="btn btn-mini btn-danger" ><i class="ti-close mr-2"></i> Cancel</button>
                                                <button class="btn btn-mini btn-primary" type="submit" ><i class="ti-check mr-2"></i> Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
@endsection
