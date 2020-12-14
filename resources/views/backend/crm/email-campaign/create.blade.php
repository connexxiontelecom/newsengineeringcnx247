@extends('layouts.app')

@section('title')
    Email Campaign
@endsection

@section('extra-styles')

<style>
/* The heart of the matter */

.horizontal-scrollable > .row {
            overflow-x: auto;
            white-space: nowrap;
    }

.horizontal-scrollable {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-block">
                @include('livewire.backend.crm.common._slab-menu')
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h4 class="sub-title">New Email Campaign</h4>
                <div class="btn-group d-flex justify-content-end">
                    <a href="" class="btn btn-mini btn-primary" type="button"><i class="ti-plus"></i> New Email Campaign</a>
                    <a href="{{route('bulk-sms')}}" class="btn btn-mini btn-danger"><i class="ti-email"></i> Campaigns</a>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success background-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card" style="margin-top:-30px;">
    <div class="card-block email-card">
        <form action="{{route('new-email-campaign')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-8 col-xl-8 offset-md-2">
                    <div class="form-group">
                        <label for="">To</label>
                        <input type="text" name="receivers" placeholder="Receiver(s)" class="form-control" value="{{old('receivers')}}">
                        @error('receivers')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" name="subject" placeholder="Subject" class="form-control" value="{{old('subject')}}">
                        @error('subject')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="content" class="content form-control" placeholder="Compose mail" value="{{old('content')}}"></textarea>
                        @error('content')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="btn-group d-flex justify-content-center">
                            <a href="submit" class="btn btn-mini btn-danger"> <i class="ti-close mr-2"></i> Cancel</a>
                            <button type="submit" class="btn btn-mini btn-primary"><i class="zmdi zmdi-mail-send mr-2"></i> Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
@endsection
