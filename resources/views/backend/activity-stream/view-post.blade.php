@extends('layouts.app')

@section('title')
    {{$post->post_title ?? ''}}
@endsection

@section('extra-styles')

@endsection

@section('content')

@livewire('backend.activity-stream.view-post')

@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')


@endsection
