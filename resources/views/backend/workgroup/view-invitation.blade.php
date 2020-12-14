@extends('layouts.app')

@section('title')
    Workgroup Invitation Details
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\hover-effect\normalize.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\hover-effect\set2.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Workgroup Invitation</h5>
        <a class="btn btn-secondary btn-mini" href="{{route('workgroups')}}"> <i class="ti-back-left mr-2"></i> Workgroups</a>
    </div>
    <div class="card-block">
        <div class="col-md-12">
            @if (session()->has('success'))
                <div class="alert alert-success background-success" role="alert">
                    {!! session()->get('success') !!}
                </div>
            @endif
            @if (session()->has('decline'))
                <div class="alert alert-danger background-danger" role="alert">
                    {!! session()->get('decline') !!}
                </div>
            @endif
            <ul class="list-view">
                <li>
                    <form action="{{route('workgroup-action')}}" method="post">
                        @csrf
                        <div class="card list-view-media">
                            <div class="card-block">
                                <div class="media">
                                    <a class="media-left" href="{{route('view-profile', $invitation->invitedBy->url)}}">
                                        <img class="media-object card-list-img" src="/assets/images/avatars/thumbnails/{{$invitation->invitedBy->avatar ?? 'avatar.png'}}" alt="{{$invitation->invitedBy->first_name ?? ''}} {{$invitation->invitedBy->surname ?? ''}}">
                                    </a>
                                    <div class="media-body">
                                        <div class="col-xs-12">
                                            <h6 class="d-inline-block">
                                                {{$invitation->workgroupDetails->group_name}}</h6>
                                                @if ($invitation->status == 0)
                                                    <label class="label label-warning">Pending acceptance</label>
                                                @elseif($invitation->status == 1)
                                                    <label class="label label-success">Accepted</label>
                                                @elseif($invitation->status == 2)
                                                    <label class="label label-danger">Declined</label>
                                                @endif
                                        </div>
                                        <div class="f-13 text-muted m-b-15">
                                            <strong>Invited by: </strong>{{$invitation->invitedBy->first_name ?? ''}} {{$invitation->invitedBy->surname ?? ''}}
                                        </div>
                                        <p>{!! $invitation->message !!}</p>
                                        <div class="m-t-15">
                                            <div class="btn-group d-flex justify-content-end">
                                                <input type="hidden" name="workgroupId" value="{{$invitation->workgroup_id}}">
                                                <input type="hidden" name="slug" value="{{$invitation->slug}}">
                                                @if ($invitation->status == 0)
                                                    <button class="btn btn-danger btn-mini" type="submit" value="0" name="decline"> <i class="ti-close mr-2"></i> Decline</button>
                                                    <button class="btn btn-success btn-mini" type="submit" name="accept" value="1"> <i class="ti-check mr-2"></i> Accept</button>
                                                @elseif($invitation->status == 1)
                                                    <button class="btn btn-danger btn-mini" type="submit" value="0" name="decline"> <i class="ti-close mr-2"></i> Decline</button>
                                                @elseif($invitation->status == 2)
                                                    <button class="btn btn-success btn-mini" type="submit" name="accept" value="1"> <i class="ti-check mr-2"></i> Accept</button>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')

<script type="text/javascript" src="/assets/js/cus/axios.min.js"></script>
@stack('workgroup-shortcut-script')
@stack('custom-script')
@endsection
