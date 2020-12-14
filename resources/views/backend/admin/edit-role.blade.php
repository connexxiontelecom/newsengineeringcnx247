@extends('layouts.app')

@section('title')
    Edit Role
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\message\message.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-uppercase">Edit Role/Plan</h5>
                </div>
                <div class="card-block">
                    <p class="text-muted"><strong class="text-danger">Note:</strong> This section can be used for both roles and pricing plan</p>
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <form action="{{route('save-role-changes')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Role Name</label>
                            <input type="text" class="form-control" placeholder="Role Name" name="role_name" value="{{old('role_name', $role->name)}}">
                            @error('role_name')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Role or Plan?</label>
                            <div class="form-radio">
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="type" value="1" checked="checked">
                                            <i class="helper"></i>Role
                                        </label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="type" value="0">
                                            <i class="helper"></i>Plan
                                        </label>
                                    </div>
                            </div>
                            @error('role_name')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <input type="hidden" name="roleId" value="{{$role->id}}">
                            <button class="btn btn-mini btn-primary" type="submit"> <i class="ti-check mr-2"></i> Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Role/Pricing Plan List</h5>
                </div>
                <div class="card-block">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Role</th>
                            <th>Type</th>
                            <th>Action</th>
                        </thead>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$role->name}}</td>
                                <td>
                                    @if ($role->type == 1)
                                        <label class="label label-primary">Role</label>
                                    @elseif($role->type == 0)
                                        <label class="label label-danger">Pricing Plan</label>
                                    @endif
                                </td>
                                <td>
                                    @if ($role->type == 1)
                                    <a href="{{route('assign-role-to-permission', $role->id)}}" class="btn btn-primary btn-mini waves-effect waves-light">
                                        <small class="text-uppercase">Assign Permission</small>
                                    </a>
                                    @elseif($role->type == 0)
                                    <a href="{{route('assign-role-to-permission', $role->id)}}" class="btn btn-danger btn-mini waves-effect waves-light">
                                        <small class="text-uppercase">Assign Access Level</small>
                                    </a>
                                    @endif
                                    <a href="{{route('edit-role', $role->id)}}" class="ml-4"><i class="ti-pencil text-warning"></i></a>
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
