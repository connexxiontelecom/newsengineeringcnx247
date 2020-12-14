<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Self-Performance Assessment Questions</h5>
                    <button class="btn btn-mini btn-primary float-right mb-2" type="button" data-toggle="modal" data-target="#selfQuestionModal"><i class="ti-plus mr-2"></i> Add New Question</button>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>#</th>
                                <th>Question</th>
                                <th>Added By</th>
                                <th>Date</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('dialog-section')
        <div class="modal fade" id="selfQuestionModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h6 class="modal-title bg-primary">Add New Question</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Question</label>
                            <textarea class="form-control" placeholder="Type question here..." wire:model.debounce.90000ms="question"></textarea>
                            @error('question')
                                <i>{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group d-flex justify-content-center">
                            <input type="hidden" id="projectId">
                            <button type="button" class="btn btn-danger btn-mini waves-effect " data-dismiss="modal"><i class="ti-close mr-2"></i>Close</button>
                                <button type="submit" class="btn btn-primary btn-mini waves-effect waves-light"><i class="ti-check mr-2"></i>Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>


