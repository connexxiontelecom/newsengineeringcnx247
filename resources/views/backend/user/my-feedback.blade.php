@extends('layouts.app')

@section('title')
    My Feedback
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\assets\pages\j-pro\css\demo.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\j-pro\css\font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\j-pro\css\j-pro-modern.css">
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <!-- Review Product card start -->
        <div class="card">
            <div class="card-header">
                <h5>Feedback</h5>
                <span>We strive to provide effective and efficient service. Please let us know if we are measuring up.</span>
               @if (session()->has('success'))
                    <div class="alert alert-success background-success" role="alert">
                        {!! session()->get('success') !!}
                    </div>
               @endif
            </div>
            <div class="card-block">
                <div class="j-wrapper j-wrapper-640">
                    <form action="{{route('my-feedback')}}" method="post" class="j-pro" id="j-pro" novalidate="">
                        @csrf
                        <div class="j-content">
                            <div class="j-unit">
                                <label class="j-label">Name</label>
                                <div class="j-input">
                                    <label class="j-icon-right" for="name">
                                        <i class="icofont icofont-user"></i>
                                    </label>
                                    <input type="text" id="name" name="full_name" placeholder="Full Name" value="{{old('full_name', Auth::user()->first_name.' '.Auth::user()->surname ?? '') }} ">
                                    @error('full_name')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="j-unit">
                                <label class="j-label">Email</label>
                                <div class="j-input">
                                    <label class="j-icon-right" for="email">
                                        <i class="icofont icofont-envelope"></i>
                                    </label>
                                    <input type="email" placeholder="Email Address" name="email" value="{{old('email', Auth::user()->email ?? '')}}">
                                    @error('email')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="j-unit">
                                <label class="j-label">Review message</label>
                                <div class="j-input">
                                    <textarea placeholder="Type your feedback here...." spellcheck="false" name="feedback"></textarea>
                                    @error('feedback')
                                        <i class="text-danger mt-3">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="j-rating-group mb-4">
                                <label class="j-label">Rating</label>
                                <div class="j-ratings">
                                    <input id="5q" type="radio" name="rating" value="5" checked>
                                    <label for="5q">
                                        <i class="icofont icofont-star"></i>
                                    </label>
                                    <input id="4q" type="radio" name="rating" value="4">
                                    <label for="4q">
                                        <i class="icofont icofont-star"></i>
                                    </label>
                                    <input id="3q" type="radio" name="rating" value="3">
                                    <label for="3q">
                                        <i class="icofont icofont-star"></i>
                                    </label>
                                    <input id="2q" type="radio" name="rating" value="2">
                                    <label for="2q">
                                        <i class="icofont icofont-star"></i>
                                    </label>
                                    <input id="1q" type="radio" name="rating" value="1">
                                    <label for="1q">
                                        <i class="icofont icofont-star"></i>
                                    </label>
                                </div>
                                @error('rating')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="j-footer">
                            <button type="submit" class="btn btn-primary btn-mini">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')

@endsection
