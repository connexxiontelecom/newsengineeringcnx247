@extends('layouts.app')

@section('title')
    CNX247 Stream
@endsection

@section('extra-styles')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-xl-4 offset-md-4">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-lock bg-c-pink card1-icon"></i>
                    <span class="text-c-pink f-w-600">Security Check</span>
                    <div class="row mt-5">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted"><strong class="text-primary">{{$roomName}}</strong> is a private room. Kindly enter password for this room to gain access.</p>
                            <form action="{{ route('security-check') }}" method="post">
                                @if (session()->has('error'))
                                    <div class="alert alert-danger background-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="icofont icofont-close-line-circled text-white"></i>
                                        </button>
                                        {!! session()->get('error') !!}
                                    </div>
                                @endif
                                @csrf
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    @error('password')
                                        <i class="mt-3 text-danger">{{ $message }}</i>
                                    @enderror
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <input type="hidden" name="roomName" value="{{$roomName}}">
                                    <input type="hidden" name="identity" value="{{$identity}}">
                                    <button class="input-group-addon btn btn-secondary btn-mini" type="submit">
                                        <i class="ti-check mr-2"></i> Submit
                                    </button>
                                </div>
                            </form>
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
<script>

</script>
@endsection
