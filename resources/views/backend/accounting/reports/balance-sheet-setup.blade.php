@extends('layouts.app')

@section('title')
    Balance Sheet
@endsection

@section('extra-styles')

@endsection

@section('content')
    <div class="card">
        <div class="card-block">
            <h5 class="sub-title">Accounting Period</h5>
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
            <p>Selecting accounting period to generate trial balance</p>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <form action="{{route('balance-sheet')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="input-group input-group-button">
                                <span class="input-group-addon btn btn-primary" id="basic-addon11">
                                    <span class="">Date</span>
                                </span>
                                    <input type="date" name="date" class="form-control" placeholder="From">
                                <span class="input-group-addon btn btn-primary" id="basic-addon12">
                                   <button class="btn  btn-primary" type="submit">Submit</button>
                                </span>
                                </div>
                                @error('from')
                                <i class="text-danger mt-2">{{$message}}</i> <br>
                                @enderror
                                @error('to')
                                <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')


@endsection
