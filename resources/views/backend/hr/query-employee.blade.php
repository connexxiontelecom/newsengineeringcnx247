@extends('layouts.app')

@section('title')
    Query Employee
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

<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="sub-title">Query Employee <label for="" class="label label-primary">{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}</label></h4>
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

    <div class="card p-3" style="margin-top:-20px;">
        <div class="card-block email-card">
            <form action="{{route('store-query-employee')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-xl-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Subject</label>
                                    <input type="text" name="subject" placeholder="Subject" class="form-control" value="{{old('subject')}}">
                                    @error('subject')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Query Type</label>
                                    <select name="query_type"  class="form-control">
                                        <option disabled selected>Select query type</option>
                                        <option value="0">Warning</option>
                                        <option value="1">Query</option>
                                    </select>
                                    @error('query_type')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12" wire:ignore>
                                <div class="form-group">
                                    <label for="">Query Content</label>
                                    <textarea  name="query_content"  class="content form-control"></textarea>
                                    @error('query_content')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="btn-group d-flex justify-content-center">
                                <a href="{{route('employees')}}" class="btn btn-mini btn-danger"> <i class="ti-close mr-2"></i> Cancel</a>
                                <button type="submit" class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i> Submit</button>
                                <input type="hidden" name="employee_id" value="{{$employee->id}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-4 col-md-4">
                        <div class="card rounded-card user-card">
                            <div class="card-block">
                                <div class="img-hover">
                                    <img class="img-fluid img-radius" src="/assets/images/avatars/medium/{{$employee->avatar ?? 'avatar.png'}}" alt="{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}">
                                </div>
                                <div class="user-content">
                                    <a href="{{route('view-profile', $employee->url)}}">
                                        <h4 class="">{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}</h4>
                                    </a>
                                    <p class="m-b-0 text-muted">{{$employee->position ?? '-'}}</p>
                                </div>

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
