@extends('layouts.app')

@section('title')
    Project Budget
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col-xl-4 col-lg-12 push-xl-8 task-detail-right">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-clock-time m-r-10"></i>project Duration
                </h5>
                <div class="btn-group mt-2 d-flex justify-content-center" role="group">
                    <button type="button"  class="btn btn-success btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Start Date">
                        <i class="ti-alarm-clock"></i>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($project->start_date))}} @ {{date('h:ia', strtotime($project->start_date))}}
                    </button>
                    <button type="button"  class="btn btn-danger btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Due Date">
                        <i class="ti-alarm-clock"></i>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($project->end_date))}} @ {{date('h:ia', strtotime($project->end_date))}}
                    </button>
                </div>
            </div>
        </div>
        <div class="card card-border-primary" style="margin-top:-30px;">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-ui-note m-r-10"></i> Project Details
                </h5>
            </div>
            <div class="card-block task-details">
                <table class="table table-border table-xs">
                    <tbody>
                        <tr>
                            <td>
                                <i class="icofont icofont-id-card"></i> Created:
                            </td>
                            <td class="text-right">{{date('d F, Y', strtotime($project->created_at))}}</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="icofont icofont-spinner-alt-5"></i> Priority:
                            </td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a href="javascript:void(0);">
                                        {{$project->priority->name}}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="icofont icofont-ui-love-add"></i> Created by:
                            </td>
                            <td class="text-right">
                                <a href="{{ route('view-profile', $project->user->url) }}">{{$project->user->first_name}}  {{$project->user->surname ?? ''}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="icofont icofont-spinner-alt-3"></i> Revisions:</td>
                            <td class="text-right">{{count($project->postReviews)}}</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="icofont icofont-washing-machine"></i> Status:
                            </td>
                            <td class="text-right">{{$project->postStatus->name ?? '-'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-12 pull-xl-4 filter-bar">
			@include('backend.project.common._project-detail-slab')
        <div class="card">
            <div class="card-block">
                <h5 style="text-transform:uppercase;">
                    Budget
                </h5>
                @if(session()->has('success'))
                    <div class="alert alert-success background-success" role="alert">
                        {!! session()->get('success') !!}
                    </div>
                @endif
                <hr>
                <div class="">
                    <form action="{{route('store-project-budget')}}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Budget Head</label>
                                    <input type="text" class="form-control" name="budget_head" placeholder="Budget Head">
                                    @error('budget_head')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input type="number" step="0.01" class="form-control" name="amount" placeholder="Amount">
                                    @error('amount')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <div class="form-group">
                                    <label for="">Comment <i>(Optional)</i> </label>
                                    <textarea class="form-control" name="comment" placeholder="Comment" style="resize: none;"></textarea>
                                    @error('comment')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="projectId" value="{{$project->id}}">
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <button class="btn btn-primary btn-mini" type="submit"><i class="ti-check mr-2"></i>Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card comment-block">
            <div class="card-block">
                <h5 class="sub-title">
                    <i class="icofont icofont-comment m-r-5"></i> {{$project->post_title ?? ''}} Budgets
                </h5>
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Budget Title</th>
                            <th>Budget Amount</th>
                            <th>Actual Amount</th>
                            <th>Remarks/Comment</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $serial = 1;
                            @endphp
                            @foreach ($budgets as $item)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$item->budget_title ?? ''}}</td>
                                    <td>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($item->budget_amount,2) ?? ''}}</td>
                                    <td>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($item->actual_amount,2) ?? ''}}</td>
                                    <td>{{ $item->comment ?? ''}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Budget Title</th>
                            <th>Budget Amount</th>
                            <th>Actual Amount</th>
                            <th>Remarks/Comment</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('dialog-section')

@endsection
@section('extra-scripts')
<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>

<script src="\assets\pages\data-table\js\data-table-custom.js"></script>
@endsection
