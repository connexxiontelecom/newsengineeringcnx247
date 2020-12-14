@extends('layouts.app')

@section('title')
    Add New Event
@endsection

@section('extra-styles')
<link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('backend.events.common._event-slab')
    </div>
</div>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-block">
                <h5 class="m-0 sub-title">
                    Add New Event
                </h5>
                <div class="row mt-3">
                    <div class="col-md-12 btn-add-task">
                        <form action="{{route('my-new-event')}}" method="post">
                            @if (session()->has('success'))
                                <div class="alert alert-success background-success mt-3">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled text-white"></i>
                                    </button>
                                    {!! session()->get('success') !!}
                                </div>
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 form-group ">
                                    <label class="">Event Name</label>
                                    <input type="text" id="event_name" name="event_name" value="{{old('event_name')}}" class="form-control form-control-normal mb-2" placeholder="Event Name">
                                    @error('event_name')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class=" row">
                                <div class="col-sm-12 0form-group">
                                    <label class="">Event Description</label>
                                    <textarea id="event_description" name="event_description" cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Event Description">{{old('event_description')}}</textarea>
                                    @error('event_description')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class=" row">
                                <div class="col-sm-12 col-md-4 form-group">
                                    <label class="">Event Date</label>
                                    <input type="datetime-local" id="event_date" name="event_date" value="{{old('event_date ')}}" class="form-control form-control-normal" placeholder="Event Start date">
                                    @error('event_date')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                                </div>
                                <div class="col-sm-10 col-md-4 form-group">
                                    <label class="">Event End Date</label>
                                    <input type="datetime-local" id="event_end_date" name="event_end_date" class="form-control form-control-normal" placeholder="Event End date">
                                    @error('event_end_date')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                                </div>
                                <div class="col-sm-10 col-md-4 form-group">
                                    <label class="">Color</label>
                                    <input type="color" id="color" name="color" class="form-control form-control-normal" placeholder="Color">
                                    @error('color')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="mb-3">
                                        Attendee(s):
                                        <select name="audience" required required id="audience" class="form-control">
                                            <option disabled selected>Select Attendee(s)</option>
                                            <option value="0">To All Employees</option>
                                            <option value="1">To Specific Employee(s)</option>
                                        </select>
                                        @error('audience')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div id="event-persons-wrap" class="col-md-6 col-sm-6">
                                    <select id="attendees" name="attendees[]" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                        <option value="{{ Auth::user()->id }} " selected>{{ Auth::user()->first_name }} {{ Auth::user()->surname ?? '' }}</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button class="btn btn-primary btn-mini" type="submit" id="submitEvent"> <i class="ti-check mr-2"></i> Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<!-- Select 2 js -->
<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js">
</script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
<script>
    $(document).ready(function(){
        $('#event-persons-wrap').hide();
        $(document).on('change', '#audience', function(e){
            e.preventDefault();
            if($(this).val() == 1){
                $('#event-persons-wrap').show();
            }else{
                $('#event-persons-wrap').hide();
            }
        });
    });
</script>
@endsection
