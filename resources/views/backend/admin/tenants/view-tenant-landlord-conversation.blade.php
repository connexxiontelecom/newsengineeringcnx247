@extends('layouts.app')

@section('title')
    Conversation Details
@endsection

@section('extra-styles')

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                @include('backend.admin.common._nav-slab')
            </div>
        </div>

    </div>
</div>
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="card-header">
                        @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <p>
                                <a href="{{route('tenants')}}" class="btn btn-secondary btn-mini"> <i class="ti-back-left mr-2"></i> Back</a>
                            </p>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-header-text">{{$conversation->subject}}</h5>
                                </div>
                                <div class="card-block">
                                    <div class="view-info">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                {!! $conversation->content !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-block">
                                    <h6 class="recent-highlight">Sent by:</h6>
                                    <div class="user-box assign-user taskboard-right-users">
                                        <div class="media">
                                            <div class="media-left media-middle photo-table">
                                                <a href="{{route('view-profile', $conversation->user->url)}}">
                                                    <img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$conversation->user->avatar ?? 'avatar.png'}}" alt="{{$conversation->user->first_name}}">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="{{route('view-profile', $conversation->user->url)}}">{{$conversation->user->first_name}} {{$conversation->user->surname ?? ''}}</a>
                                                - <small>{{date('d F, Y', strtotime($conversation->created_at))}} @ {{date('h:ia', strtotime($conversation->created_at))}}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>
                                        @if ($conversation->type == 1 )
                                            <label for="" class="label-danger label">Reminder</label>
                                        @else
                                            <label for="" class="label-primary label">Email</label>
                                        @endif
                                    </p>
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

@endsection
