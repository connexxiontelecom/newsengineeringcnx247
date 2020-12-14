@extends('layouts.app')

@section('title')
    Frequently Asked Questions
@endsection

@section('extra-styles')
<link rel="stylesheet" href="{{asset('assets/css/cus/parsley.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/cus/progressBar.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                @include('backend.admin.common._nav-slab')
            </div>
        </div>

    </div>
</div>
   <div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title"> Frequently Asked Questions</h5>
                <div class="btn-group d-flex justify-content-end mb-2">
                    <button class="btn-warning btn btn-mini"><i class="ti-reload mr-2" onclick="location.reload();"></i>Reload</button>
                    <button class="btn-primary btn btn-mini" data-target="#faqsModal" data-toggle="modal"><i class="ti-plus mr-2"></i>Add New FAQ</button>
                </div>
                <div class="row mt-3" id="faqsWrapper">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">FAQs</h5>
                            </div>
                            <div class="card-block accordion-block">
                                <div id="accordion" role="tablist" aria-multiselectable="true">
                                    @foreach ($faqs as $faq)
                                        <div class="accordion-panel">
                                            <div class="accordion-heading" role="tab" id="heading_{{$faq->id}}">
                                                <h3 class="card-title accordion-title">
                                                    <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$faq->id}}" aria-expanded="true" aria-controls="collapse_{{$faq->id}}">
                                                        {{$faq->question ?? ''}} <label for="" class="label label-primary ml-2">{{ucfirst($faq->category)}}</label>
                                                    </a>
                                                </h3>
                                            </div>
                                            <div id="collapse_{{$faq->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_{{$faq->id}}">
                                                <div class="accordion-content accordion-desc">
                                                    {!! $faq->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
<div class="modal fade" id="faqsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h6 class="modal-title">Add New Question</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="faqsForm" data-parsley-validate>
                    <div class="form-group">
                        <label for="">Question</label>
                        <input type="text" placeholder="Question" id="question" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="product">Product</option>
                            <option value="general">General</option>
                            <option value="payment">Payment</option>
                            <option value="support">Support</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="" id="answer" cols="5" rows="5" class="form-control content" placeholder="Type answer here..."></textarea>
                    </div>
                    <hr>
                    <div class="btn-group d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
                        <button type="submit" class="btn btn-primary waves-effect btn-mini waves-light" id="submitFaqBtn"><i class="mr-2 ti-check"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script src="{{asset('/assets/js/cus/parsley.min.js')}}"></script>
<script src="{{asset('/assets/js/cus/progressBar.js')}}"></script>
<script type="text/javascript" src="/assets/pages/accordion/accordion.js"></script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
<script>
$(document).ready(function(){
            var theme = null;
         $('#faqsForm').parsley().on('field:validated', function() {


        }).on('form:submit', function() {
            var config = {
                        onUploadProgress: function(progressEvent) {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };
                var form_data = new FormData();
                form_data.append('question',$('#question').val());
                form_data.append('category',$('#category').val());
                form_data.append('answer',tinymce.get('answer').getContent());
                $('#submitFaqBtn').text('Processing...');
                 axios.post('/faq/new',form_data, config)
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#submitFaqBtn').text('Done');
                    setTimeout(function () {
                        $("#submitFaqBtn").text("Save");
                        $('#question').val('');
                        $('#faqsModal').modal('hide');
                        $('#accordion').load(location.href + ' #accordion');
                    }, 2000);

                })
                .catch(error=>{
                    $.notify('Error! Something went wrong.', 'error');
                    setTimeout(function () {
                        $("#submitFaqBtn").text("Save");
                    }, 2000);
                });

                return false;
            });

        });
</script>
@endsection
