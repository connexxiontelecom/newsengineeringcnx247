@extends('layouts.auth-layout')

@section('title')
    Oops!
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')
<div class="container mt-100 mt-60">
	<div class="row row align-items-center">
		<div class="col-lg-7 col-md-6 order-2 order-md-1 mt-4 mt-sm-0 pt-2 pt-sm-0">
			<div class="section-title">
				<img src="/assets/images/logo.png" alt="logo.png" height="75" width="120">
					<h4 class="title mb-4">Ooops!</h4>
					<p>It appears you verified your account.</p>
					<p>Please let us know if you have any concerns.</p>
					<p>Thank you, <br> <strong>{{ config('app.name') }}.</strong></p>
					<p class="text-inverse text-left m-b-0">Proceed to <a href="{{ route('signin') }}" class="mt-3 h6 text-primary"><strong class="f-w-600">Signin <i class="mdi mdi-chevron-right"></i></strong></a></p>

			</div>
	</div>
	</div>

</div>
@endsection
