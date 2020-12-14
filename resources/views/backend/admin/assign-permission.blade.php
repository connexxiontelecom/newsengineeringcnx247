@extends('layouts.app')

@section('title')
    Assign Permission
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\message\message.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
               <div class="card-header">
                <h5><small class="text-uppercase">Assign Permission(s) to </small><label for="" class="label label-info text-uppercase">{{$role->name}} </label> </h5>
                <br>
                <a href="{{route('roles')}}" class="btn btn-mini btn-secondary mt-2"> <i class="ti-back-left mr-2"></i> Back</a>
               </div>
               <div class="card-block">
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
    <form action="{{route('store-permission')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-block accordion-block">
                        <div id="accordion" role="tablist" aria-multiselectable="true">

                            <div class="accordion-panel">
                                @foreach ($modules as $module)
                                    <div class="accordion-heading" role="tab" id="heading_{{$module->id}}">
                                        <h3 class="card-title accordion-title">
                                        <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$module->id}}" aria-expanded="false" aria-controls="collapseOne">
                                            {{$module->module_name ?? ''}}
                                        </a>
                                    </h3>
                                    </div>
                                    <div id="collapse_{{$module->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_{{$module->id}}">
                                        <div class="accordion-content accordion-desc">
                                            <div class="row">
                                                @foreach ($module->permission as $permit)
                                                    <div class="col-md-3">
                                                        <div class="checkbox-fade fade-in-primary">
                                                            <label>
                                                                <input type="checkbox" name="permission[]" {{$role->hasPermissionTo($permit->id) ? 'checked' : ''}} value="{{$permit->id}}">
                                                                <span class="cr">
                                                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                </span>
                                                                <span>{{$permit->name}}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="btn-group">
                                    <input type="hidden" name="role" value="{{$role->id}}">
                                    <a class="btn btn-danger btn-mini" href="{{url()->previous()}}"> <i class="ti-close mr-2"></i> Cance</a>
                                    <button class="btn btn-primary btn-mini" type="submit"> <i class="ti-check mr-2"></i> Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('extra-scripts')
<script type="text/javascript" src="\assets\pages\dashboard\custom-dashboard.js"></script>
<script type="text/javascript" src="\assets\pages\message\message.js"></script>
@endsection
