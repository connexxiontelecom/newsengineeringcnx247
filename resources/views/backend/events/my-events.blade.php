@extends('layouts.app')

@section('title')
    My events
@endsection

@section('extra-styles')

@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('backend.events.common._event-slab')
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h5 class="m-0 sub-title">
                    My Events
                </h5>

            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')

@endsection
