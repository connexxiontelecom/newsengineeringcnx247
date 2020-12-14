<div class="modal fade" id="newResignationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h6 class="modal-title text-uppercase">New Resignation</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" placeholder="Subject" id="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Effective Date</label>
                        <input type="datetime-local" id="effective_date" class="form-control col-md-6">
                    </div>
                    <div class="form-group">
                        <label for="">Attachment</label>
                        <input type="file" id="attachment" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="" id="resignation_content" cols="5" rows="5" class="form-control content" placeholder="Type here..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="mr-2 ti-close"></i>Close</button>
                    <button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="submitResignationBtn"><i class="mr-2 ti-check"></i>Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newComplaintModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h6 class="modal-title">New Complaint</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" placeholder="Subject" id="complaint_subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="" id="complaint_content" cols="5" rows="5" class="form-control content" placeholder="Type here..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
                    <button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="submitComplaintBtn"><i class="mr-2 ti-check"></i>Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
