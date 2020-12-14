@extends('layouts.frontend-layout')

@section('title')
    Check-in or out
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')
       @include('frontend.logistics.partials._header-menu')
        <section class="section mt-60">
            <div class="container mt-lg-3">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">{!! session()->get('success') !!}</div>
                        @endif
                        <h5>Log</h5>
                        <a href="{{route('logistics-check-in')}}" class="btn btn-soft-primary float-right mb-4"> Check-in </a>
                        <div class="table-responsive bg-white shadow rounded">
                            <table class="table mb-0 table-center">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Check-in</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Check-out</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($logs as $log)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td><span class="badge badge-pill badge-primary">{{!is_null($log->check_in) ? date('d F, Y h:ia', strtotime($log->check_in)) : '-'}}</span></td>
                                            <td>{{$log->destination ?? ''}}</td>
                                            <td><span class="badge badge-pill badge-danger">{{!is_null($log->check_out) ? date('d F, Y h:ia', strtotime($log->check_out)) : 'pending'}}</span></td>
                                            <td>{{!is_null($log->created_at) ? date('d F, Y h:ia', strtotime($log->created_at)) : '-'}}</td>
                                            <td>
                                                @if (is_null($log->check_out))
                                                    <a href="{{route('logistics-check-out', $log->id)}}" class="btn btn-success btn-sm"> Check-out</a>
                                                @else
                                                   <small> No Action Required</small>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </section>
@endsection
