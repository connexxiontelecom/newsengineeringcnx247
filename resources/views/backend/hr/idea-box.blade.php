@extends('layouts.app')

@section('title')
    Idea Box
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\jquery.toolbar.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\custom-toolbar.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-block">
                @include('livewire.backend.hr.common._slab-menu')
            </div>
        </div>
    </div>
</div>
   <div class="row">
       <div class="col-md-12">
           <div class="card">
            <div class="card-block">
                <div class="sub-title">Idea Box</div>
                <button class="btn btn-mini btn-primary float-right mb-3" type="button" data-toggle="modal" data-target="#myIdeaModal"><i class="ti-plus mr-2"></i>Submit New Idea</button>
                    <div class="col-md-12 mt-5">
                        <div class="dt-responsive table-responsive">
                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Visibility</th>
                                    <th>Content</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($ideas as $idea)
                                        <tr>
                                            <td>{{$serial++}}</td>
                                            <td>{{$idea->subject ?? ''}}</td>
                                            <td>
                                                @if ($idea->visibility == 1)
                                                    <label for="" class="label label-danger">Anonymous</label>
                                                @else
                                                    <label for="" class="label label-primary">{{$idea->user->first_name ?? ''}} {{$idea->user->surname ?? ''}}</label>
                                                @endif
                                            </td>
                                            <td>
                                                {!!  strlen($idea->content) > 80 ? substr($idea->content, 0,80).'...' : $idea->content !!}
                                            </td>
                                            <td>
                                                @if ($idea->status == 0)
                                                    <label for="" class="label label-warning">processing</label>
                                                @else
                                                    <label for="" class="label label-success">Done</label>
                                                @endif
                                            </td>
                                            <td>
                                                {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($idea->created_at))}}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="javascript:void(0);" class="viewIdea" data-toggle="modal" data-target="#viewIdeaModal" data-content="{{$idea->content}}" data-subject="{{$idea->subject}}"> <i class="ti-eye text-warning mr-2"></i> View</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Visibility</th>
                                    <th>Content</th>
                                    <th>Status</th>
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
@endsection

@section('dialog-section')
<div class="modal fade" id="myIdeaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h6 class="modal-title text-uppercase"> <i class="icofont icofont-brain-alt mr-2 text-white"></i> New Idea</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="">
                        <div class="form-group">
                            <label for="">Subject</label>
                            <input type="text" placeholder="Subject" id="subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">Anonymous?</legend>
                                <div class="col-md-8 offset-md-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="visibility" value="1" checked>
                                        <label class="form-check-label" for="gridRadios1">
                                            Yes, please
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="visibility" value="0">
                                        <label class="form-check-label" for="gridRadios1">
                                            No, I rather say my name
                                        </label>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Content</label>
                            <textarea name="" id="myIdea" cols="5" rows="5" class="form-control content" placeholder="Type your idea here..."></textarea>
                        </div>
                    </form>

                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="mr-2 ti-close"></i>Close</button>
                    <button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="submitIdeaBtn"><i class="mr-2 ti-check"></i>Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewIdeaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h6 class="modal-title text-uppercase"> <i class="icofont icofont-brain-alt mr-2 text-white"></i> Idea</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="sub-title" id="ideaSubject"></h5>
                        <p id="ideaContent"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="mr-2 ti-close"></i>Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>

<script>
    $(document).ready(function(){
        $(document).on('click', '#submitIdeaBtn', function(e){
            e.preventDefault();
            var subject = $('#subject').val();
            var visibility = $("input[name='visibility']:checked").val();
            var content = tinymce.get('myIdea').getContent();
            if(subject == '' || visibility == '' || content == ''){
                $.notify("Ooops! Kindly complete the form before submitting.", "error");
            }else{
                $('#submitIdeaBtn').text('Processing...');
                axios.post('/submit-idea',{
                    subject:subject,
                    visibility:visibility,
                    content:content
                })
                .then(response=>{
                    $.notify(response.data.message, "success");
                    $('#submitIdeaBtn').text('Submit');
                    $('#myIdeaModal').modal('hide');
                    $('#simpletable').load(href.location + ' #simpletable');
                })
                .catch(error=>{
                    $('#submitIdeaBtn').text('Submit');
                    var errs = Object.values(error.response.data.errors);
                    $.notify(errs, 'error');
                });
            }
        });

        $(document).on('click', '.viewIdea', function(e){
            e.preventDefault();
            $('#ideaSubject').text($(this).data('subject'));
            $('#ideaContent').html($(this).data('content'));
        });
    });
</script>
@endsection
