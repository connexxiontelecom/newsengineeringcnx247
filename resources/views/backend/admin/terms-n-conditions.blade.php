@extends('layouts.app')

@section('title')
    Terms and Conditions
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
                    <div id="termsContainer">
                        <h5 class="sub-title">{{config('app.name')}}'s Terms & Conditions</h5>
                        {!! $terms->terms !!}
                    </div>
                    <div class="form-group d-flex justify-content-center" style="position: relative; bottom:0px;">
                        <div class="btn-group">
                            <input type="hidden" value="{{$terms->id}}" name="id">
                            <a class="btn btn-mini btn-warning" href="{{route('edit-terms-n-conditions', $terms->id)}}"><i class="ti-pencil mr-2"></i> Edit Terms</a>
                            <button class="btn btn-mini btn-danger" id="printTerms" type="button"><i class="ti-printer mr-2"></i> Print Terms</button>

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
        $(document).on('click', '#printTerms', function(event){
            $('#termsContainer').printThis({
                header:"<p></p>",
                footer:"<p></p>",
            });
        });
    });
</script>
@endsection
