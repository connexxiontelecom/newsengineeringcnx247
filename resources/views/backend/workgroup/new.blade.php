@extends('layouts.app')

@section('title')
    Create New Workgroup
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/css/component.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/animate.css/css/animate.css">
    <link href="\assets\pages\jquery.filer\css\jquery.filer.css" type="text/css" rel="stylesheet">
    <link href="\assets\pages\jquery.filer\css\themes\jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet">
@endsection

@section('content')
<div class="card">
    <div class="card-block">
        <h5 class="sub-title">Create New Workgroup</h5>
        <div class="row">
                    @if(session()->has('success'))
                        <div class="alert alert-success border-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled"></i>
                            </button>

                        {!! session('success') !!}

                        </div>
                    @endif
                    <div class="col-md-8">
                        <form action="{{route('new-workgroup')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="">Workgroup Name</label>
                                <input type="text" name="workgroup_name" value="{{old('workgroup_name')}}" class="form-control form-control-normal" placeholder="Workgroup Name">
                                @error('workgroup_name')
                                    <i class="text-danger" style="font-size: 12px;">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class=" form-group">
                                <label class="">Members</label>
                                <select name="workgroup_members[]" value="{{old('workgroup_members')}}" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                    <option selected disabled>Add Member(s)</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('workgroup_members')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="">Moderators</label>
                                <select name="moderators[]" value="{{old('moderators')}}" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                    <option selected disabled>Add Moderator(s)</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('moderators')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="">Group Image</label>
                                <input type="file" name="group_image" value="{{old('group_image')}}" class="form-control-file">
                                @error('group_image')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="">Description</label>
                                <textarea name="description" cols="10" rows="5" style="resize: none;" class="form-control form-control-normal content" placeholder="In few words, describe this workgroup">{{old('description')}}</textarea>
                                @error('description')
                                    <i class="text-danger" style="font-size: 12px;">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="col-sm-12 d-flex justify-content-center">
                                <div class="btn-group">
                                    <a href="{{url()->previous()}}" class="btn btn-danger waves-effect btn-mini"> <i class="ti-close mr-2"></i> Close</a>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-mini"> <i class="ti-check mr-2"></i> Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-4">
                            <div class="fb-timeliner">
                                <h2 class="recent-highlight bg-info">Recently Created</h2>
                                <div class="card">
                                    <div class="card-block p-t-10">
                                        <div class="task-right">
                                            @foreach ($workgroups as $group)
                                                <div class="user-box assign-user taskboard-right-users">
                                                    <div class="media">
                                                        <div class="media-left media-middle photo-table">
                                                            <a href="">
                                                                <img class="media-object img-radius" src="/assets/images/workgroup/thumbnail/{{$group->group_image ?? 'cnx247.jpg'}}" alt="{{$group->group_name ?? 'CNX247'}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <a href="{{ route('view-workgroup', $group->url) }}">{{ $group->group_name ?? ''}}</a> <br/>
                                                            - {{date('d F, Y', strtotime($group->created_at) )}} @ <small> {{ date('h:ia', strtotime($group->created_at)) }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>

        </div>
    </div>
</div>

@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/js/modal.js"></script>
<script type="text/javascript" src="/assets/js/modalEffects.js"></script>
<script type="text/javascript" src="/assets/js/classie.js"></script>
<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
@stack('custom-scripts')
@endsection
