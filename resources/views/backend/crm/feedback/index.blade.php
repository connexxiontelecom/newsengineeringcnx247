@extends('layouts.app')

@section('title')
    Feedback
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
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
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Feedback</h5>
                                    <span>Feedback from clients</span>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Content</th>
                                                <th>Rating</th>
                                                <th>Feature</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $serial = 1;
                                                @endphp
                                                @foreach ($feedbacks as $feedback)
                                                    <tr>
                                                        <td>{{$serial++}}</td>
                                                        <td>{{$feedback->full_name ?? ''}}</td>
                                                        <td>
                                                            {{$feedback->email ?? ''}}
                                                        </td>
                                                        <td>
                                                            {{ strlen($feedback->content) > 30 ? substr($feedback->content,0,30).'...' : $feedback->content }}
                                                        </td>
                                                        <td>
                                                            <label for="" class="label label-info">{{$feedback->rating}}</label>
                                                        </td>
                                                        <td>
                                                            @if ($feedback->favourite == 0)
                                                                <i class="ti-heart text-danger favourite" data-id="{{$feedback->id}}" data-value="1" style="cursor: pointer;"></i>
                                                            @else
                                                                <i class="ti-heart-broken text-danger dislike" data-id="{{$feedback->id}}" data-value="0" style="cursor: pointer;"></i>

                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{date('d F, Y',strtotime($feedback->created_at))}}
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="javascript:void(0);" class="viewFeedback" data-toggle="modal" data-target="#viewFeedbackModal" data-content="{{$feedback->content}}" data-fullname="{{$feedback->full_name}}" data-email="{{$feedback->email}}" data-rating="{{$feedback->rating}}" data-date="{{date('d F, Y', strtotime($feedback->created_at))}}" class="mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Learn more"> <i class="icofont icofont-eye-alt text-primary"></i> </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Content</th>
                                                <th>Rating</th>
                                                <th>Feature</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection

@section('dialog-section')
<div class="modal fade" id="viewFeedbackModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="icofont icofont-email text-white"></i> Feedback Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p><strong>Full name: </strong><span id="name-text"></span></p>
                <p><strong>Email: </strong><span id="email-text"></span></p>
                <p><strong>Feedback: </strong><span id="feedback-text"></span></p>
                <p><strong>Rating: </strong><label class="label label-primary" id="rating-text"></label></p>
                <p><strong>Date: </strong><label id="date-text" class="label label-danger"></label></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>

<script src="\assets\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
<script src="\assets\pages\data-table\js\jszip.min.js"></script>
<script src="\assets\pages\data-table\js\pdfmake.min.js"></script>
<script src="\assets\pages\data-table\js\vfs_fonts.js"></script>
<script src="\bower_components\datatables.net-buttons\js\buttons.print.min.js"></script>
<script src="\assets\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>

<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>

<script src="\assets\pages\data-table\js\data-table-custom.js"></script>

<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>

<script>
    $(document).ready(function(){
        $(document).on('click', '.favourite', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var value = $(this).data('value');
            axios.post('/feedback-status', {
                id:id,
                value:value
            })
            .then(response=>{
                $.notify(response.data.message, "success");
                //$('#').load(location.href + " #");
            });
        });
        $(document).on('click', '.dislike', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var value = $(this).data('value');
            axios.post('/feedback-status', {
                id:id,
                value:value
            })
            .then(response=>{
                $.notify(response.data.message, "success");
                //$('#').load(location.href + " #");
            });
        });

        $(document).on('click', '.viewFeedback', function(e){
            e.preventDefault();
            $('#name-text').text($(this).data('fullname'));
            $('#rating-text').text($(this).data('rating'));
            $('#feedback-text').text($(this).data('content'));
            $('#date-text').text($(this).data('date'));
            $('#email-text').text($(this).data('email'));
        });
    });
</script>
@endsection
