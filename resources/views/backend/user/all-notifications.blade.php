@extends('layouts.app')

@section('title')
    Your Notifications
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\jquery.toolbar.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\custom-toolbar.css">
@endsection

@section('content')

<div class="card">
    <div class="card-block">
        <h5 class="sub-title">Your Notifications</h5>
        <div class="row">
            <div class="col-md-12">
                <a href="{{url()->previous()}}" class="btn btn-mini mb-3 btn-secondary float-right"> <i class="ti-back-left mr-2"></i> Back</a>
            </div>
        </div>
        <div class="col-md-12">
            <ul class="list-view">
                @foreach ($unread as $notification)
                    <li>
                        <div class="card list-view-media" style="margin-bottom:5px;">
                            <div class="card-block">
                                <div class="media">
                                    <a class="media-left" href="#">
                                        <img class="media-object card-list-img img-30" src="/assets/images/avatars/thumbnails/{{$notification->data['avatar'] ?? '/assets/images/avatars/thumbnails/avatar.png'}}" alt="{{$notification->data['post_author']}}">
                                    </a>
                                    <div class="media-body">
                                        <div class="col-xs-12">
                                            @switch($notification->data['post_type'])
                                                @case('project')
                                                    <a href="{{route('view-project', $notification->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">{{$notification->data['post_title'] ?? 'No title'}} </a>
                                                        @break
                                                @case('task')
                                                    <a href="{{route('view-task', $notification->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">{{$notification->data['post_title'] ?? 'No title'}}</a>
                                                        @break
                                                @case('message')
                                                    <a href="{{route('view-post-activity-stream', $notification->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">{{$notification->data['post_title'] ?? 'No title'}}</a>
                                                        @break
                                                @case('event')
                                                    <a href="{{route('view-post-activity-stream', $notification->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">{{$notification->data['post_title'] ?? 'No title'}}</a>
                                                        @break
                                                @case('file')
                                                    <a href="{{route('view-post-activity-stream', $notification->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">{{$notification->data['post_title'] ?? 'No title'}}</a>
                                                        @break
                                                @case('appreciation')
                                                    <a href="{{route('view-post-activity-stream', $notification->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">{{$notification->data['post_title'] ?? 'No title'}}</a>
                                                        @break
                                                @case('announcement')
                                                    <a href="{{route('view-post-activity-stream', $notification->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">{{$notification->data['post_title'] ?? 'No title'}}</a>
                                                        @break
                                                @case('chat')
                                                    <a href="{{route('chat-n-calls')}}" class="nav-link" wire:click="markNotificationAsRead">{{$notification->data['post_title'] ?? 'No title'}}</a>
                                                        @break
                                                @case('query')
                                                        <a href="{{route('view-query',$notification->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">
                                                        @break
                                                @case('expense-report')
                                                        <a href="{{route('view-workflow-task',$notification->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">
                                                        @break
                                                @case('leave-request')
                                                        <a href="{{route('view-workflow-task',$notification->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">
                                                        @break
                                                @case('purchase-request')
                                                        <a href="{{route('view-workflow-task',$notification->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">
                                                        @break
                                                @case('business-trip')
                                                        <a href="{{route('view-workflow-task',$notification->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">
                                                        @break
                                                @case('memo')
                                                        <a href="{{route('view-internal-memo',$notification->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">
                                                        @break
                                                @case('workgroup')
                                                @default
                                                        <a href="{{route('view-workgroup-invitation',$notification->data['url'])}}"  wire:click="markNotificationAsRead" class="nav-link">{{$notification->data['post_title'] ?? 'No title'}}</a>
                                            @endswitch

                                        </div>
                                        {!! $notification->data['post_content'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')


@endsection
