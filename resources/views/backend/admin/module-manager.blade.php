@extends('layouts.app')

@section('title')
    Module Manager
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\message\message.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-uppercase">Add New Module</h5>
                </div>
                <div class="card-block">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <form action="{{route('new-module')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Module Name</label>
                            <input type="text" class="form-control" placeholder="Module Name" name="module_name"> 
                            @error('module_name')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <button class="btn btn-mini btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Module List</h5>
                </div>
                <div class="card-block">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Module</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </thead>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($modules as $module)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$module->module_name}}</td>
                            <td>{{$module->slug}}</td>
                            <td>
                                action
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra-scripts')
<script type="text/javascript" src="\assets\pages\dashboard\custom-dashboard.js"></script>
<script type="text/javascript" src="\assets\pages\message\message.js"></script>
@endsection