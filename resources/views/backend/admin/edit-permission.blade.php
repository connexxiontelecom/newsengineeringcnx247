@extends('layouts.app')

@section('title')
    Edit Permission
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\message\message.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-uppercase">Edit Permission</h5>
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
                    <form action="{{route('save-permission-changes')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Permission Name</label>
                            <input type="text" class="form-control" placeholder="Permission Name" value="{{old('permission_name', $permission->name)}}" name="permission_name">
                            @error('permission_name')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Module</label>
                            <select name="module" class="form-control">
                                <option selected disabled>Select module</option>
                                @foreach ($modules as $module)
                                    <option value="{{$module->id}}">{{$module->module_name}}</option>
                                @endforeach
                                @error('module')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </select>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <input type="hidden" value="{{$permission->id}}" name="permissionId">
                            <button class="btn btn-mini btn-primary" type="submit"> <i class="ti-check mr-2"></i> Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Permission List</h5>
                </div>
                <div class="card-block">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Module</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </thead>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$permission->moduleManager->module_name}}</td>
                                <td>{{$permission->name}}</td>
                                <td>
                                    <a href="{{route('edit-permission', $permission->id)}}" class=""> <i class="ti-pencil text-warning"></i> </a>
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
