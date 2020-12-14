@extends('layouts.app')

@section('title')
    New Phone Group
@endsection

@section('extra-styles')

<style>
/* The heart of the matter */

.horizontal-scrollable > .row {
            overflow-x: auto;
            white-space: nowrap;
    }

.horizontal-scrollable {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-block">
                @include('livewire.backend.crm.common._slab-menu')
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h4 class="sub-title">Create New Phone Group</h4>
                @if (session()->has('success'))
                    <div class="alert alert-success background-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-warning background-warning mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('error') !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card" style="margin-top:-30px;">
    <div class="card-block email-card">
        <div class="row">
            <div class="col-lg-3 col-xl-3 col-sm-4 col-md-4">
                @include('backend.crm.bulk-sms.common._navigation')
            </div>
            <div class="col-lg-9 col-xl-9 col-sm-8 col-md-8">
                <div class="card-block ">
                    <h5 class="sub-title">Create New Phone Group</h5>
                    <form action="{{route('phone-groups')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label>Phone Group Name</label>
                                    <input type="text" class="form-control" placeholder="Phone Group Name" name="phone_group_name" value="{{old('phone_group_name')}}"/>
                                    @error('phone_group_name')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone Numbers</label>
                                    <textarea class="form-control" rows="8" cols="50" name="phone_numbers" style="resize:none;" placeholder="Enter phone numbers separated by comma in any of these formats 070.., 23470... or +234. Duplicate numbers will be removed before saving.">{{old('phone_numbers')}}</textarea>
                                    @error('phone_numbers')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                                <hr>
                                <div class="form-group d-flex justify-content-center">
                                    <button type="submit" class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i>Save Phone Group</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')

@endsection
