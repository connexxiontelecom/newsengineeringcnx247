@extends('layouts.app')

@section('title')
    Privacy Policy
@endsection

@section('extra-styles')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-block">

                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <div id="privacyContainer">
                        <h5 class="sub-title">{{config('app.name')}}'s Privacy Policy</h5>
                        {!! $privacy->privacy_policy ?? '' !!}
                    </div>
                    <div class="form-group d-flex justify-content-center" style="position: relative; bottom:0px;">
                        <div class="btn-group">
                            <button class="btn btn-mini btn-danger" id="printPrivacy" type="button"><i class="ti-printer mr-2"></i> Print Privay Policy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra-scripts')
<script src="{{asset('/assets/js/cus/printThis.js')}}"></script>
<script>
    $(document).ready(function(){
        //print terms
        $(document).on('click', '#printPrivacy', function(event){
            $('#privacyContainer').printThis({
                header:"<p></p>",
                footer:"<p></p>",
            });
        });
    });
</script>
@endsection
