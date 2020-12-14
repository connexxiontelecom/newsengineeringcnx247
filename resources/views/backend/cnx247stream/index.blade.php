@extends('layouts.app')

@section('title')
    CNX247 Stream
@endsection

@section('extra-styles')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="d-inline-block text-c-pink m-r-10">{{number_format($lastMonth)}}</h2>
                            <div class="d-inline-block">
                                <p class="m-b-0">
                                    @if ($thisMonth < $lastMonth)
                                    <i class="feather icon-chevrons-up m-r-10 text-c-green"></i>
                                    @else
                                        <i class="feather icon-chevrons-down m-r-10 text-c-pink"></i>
                                    @endif
                                    @if ($lastMonth > 0 && $thisMonth > 0)
                                        {{ceil(($lastMonth/($thisMonth+$lastMonth)) * 100)}}%</p>
                                    @else
                                        0%</p>
                                    @endif
                                <p class="text-muted m-b-0">Last Month</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h2 class="d-inline-block text-c-green m-r-10">{{number_format($thisMonth)}}</h2>
                            <div class="d-inline-block">
                                <p class="m-b-0">
                                    @if ($thisMonth > $lastMonth)
                                    <i class="feather icon-chevrons-up m-r-10 text-c-green"></i>
                                    @else
                                        <i class="feather icon-chevrons-down m-r-10 text-c-pink"></i>
                                    @endif
                                    @if ($lastMonth > 0 && $thisMonth > 0)
                                        {{ceil(($thisMonth/($thisMonth+$lastMonth)) * 100)}}%</p>
                                    @else
                                        0%</p>
                                    @endif
                                    </p>
                                <p class="text-muted m-b-0">This Month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-xl-8">
            <div class="card widget-card-1">
                <div class="card-header">
                    <h5 class="float-left">Existing Rooms</h5>
                </div>
                <div class="card-block-small">
                    <div class="row">
                        <div class="col-md-12">
                            @if (session()->has('error'))
                                <div class="alert alert-danger background-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled text-white"></i>
                                    </button>
                                    {!! session()->get('error') !!}
                                </div>
                            @endif
                            @if (session()->has('success'))
                                <div class="alert alert-success background-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled text-white"></i>
                                    </button>
                                    {!! session()->get('success') !!}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/No.</th>
                                            <th>Room Name</th>
                                            <th>#</th>
                                            <th>Password</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $index = 1;
                                        @endphp
                                        @if (count($myRooms) > 0 )
                                        @foreach ($myRooms as $room)
                                            <tr>
                                                <td>{{$index++}}</td>
                                                <td>{{$room->room_name ?? ''}}</td>
                                                <td> <label for="" class="badge badge-info">3</label> </td>
                                                <td>
                                                    @if (empty($room->password) )
                                                        <i class="ti-unlock text-success" title="No password required"></i>
                                                    @else
                                                        <i class="ti-lock text-danger" title="Password required"></i>
                                                    @endif
                                                </td>
                                                <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($room->created_at)) ?? ''}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('join-room',$room->room_name) }}" class="btn-mini btn btn-primary">Join</a>
                                                        @if ($room->created_by == Auth::user()->id)
                                                         <a href="{{ route('delete-room',$room->room_name) }}" class="btn-mini btn btn-danger"> <i class="ti-trash"></i> </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>

                                        @endforeach

                                        @else
                                         <tr >
                                            <td colspan="5" class="text-center">No record found.</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-4">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-video-cam bg-c-pink card1-icon"></i>
                    <span class="text-c-pink f-w-600">Create New Room</span>
                    <div class="row mt-5">
                        <div class="col-sm-12 text-center">
                            <form action="{{ route('create-new-room') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Room Name <sup class="text-danger">*</sup></label>
                                    <input type="text" name="roomName" class="form-control" placeholder="Room Name" autocomplete="off">
                                    @error('roomName')
                                        <i class="mt-3 text-danger">{{ $message }}</i>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Password <i>(Optional)</i></label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    @error('password')
                                        <i class="mt-3 text-danger">{{ $message }}</i>
                                    @enderror
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <button class="input-group-addon btn btn-secondary btn-mini" type="submit">
                                        <i class="ti-check mr-2"></i> Create New Room
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('dialog-section')

@endsection
@section('extra-scripts')
<script>

</script>
@endsection
