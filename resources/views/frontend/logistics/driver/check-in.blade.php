@extends('layouts.frontend-layout')

@section('title')
    Check-in
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')
       @include('frontend.logistics.partials._header-menu')
        <section class="section mt-60">
            <div class="container mt-lg-3">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">{!! session()->get('success') !!}</div>
                        @endif
                        <div class="component-wrapper rounded shadow">
                            <div class="p-4 border-bottom">
                                <h4 class="title mb-0"> Check-in </h4>
                            </div>

                            <div class="p-4">
                                <form action="{{route('logistics-check-in')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group position-relative">
                                                <label>Your Name <span class="text-danger">*</span></label>
                                                <i data-feather="user" class="fea icon-sm icons"></i>
                                                <input name="name" id="name" value="{{Auth::user()->first_name ?? ''}} {{Auth::user()->surname ?? ''}}" readonly type="text" class="form-control pl-5" placeholder="Full name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group position-relative">
                                                <label>Check-in Date-time <span class="text-danger">*</span></label>
                                                <i data-feather="calendar" class="fea icon-sm icons"></i>
                                                <input name="check_in_date_time" id="check_in_date_time" readonly type="text" value="{{date('d F, Y h:ia', strtotime(now()))}}" class="form-control pl-5" placeholder="Check-in Date-time">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group position-relative">
                                                <label>Destination</label>
                                                <i data-feather="map" class="fea icon-sm icons"></i>
                                                <input name="destination" id="destination" class="form-control pl-5" placeholder="Destination">
                                                @error('destination')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group position-relative">
                                                <label>Comments</label>
                                                <i data-feather="message-circle" class="fea icon-sm icons"></i>
                                                <textarea name="comments" id="comments" rows="4" style="resize: none;" class="form-control pl-5" placeholder="Your Message :"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="submit" id="submit" name="send" class="btn btn-primary" value="Check-in">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
