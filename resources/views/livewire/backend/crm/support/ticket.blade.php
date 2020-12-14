<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="sub-title">Support Ticket</h4>
                    <div class="btn-group d-flex justify-content-end">
                        <a href="{{route('ticket')}}" class="btn btn-mini btn-primary" type="button"><i class="ti-plus"></i> New Support Ticket</a>
                        <a href="{{route('ticket-history')}}" class="btn btn-mini btn-danger"><i class="ti-support"></i> Ticket History</a>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-top:-30px;">
        <div class="card-block email-card">
            <form wire:submit.prevent="submitSupportTicket">
                <div class="row">
                    <div class="col-lg-8 col-xl-8 offset-md-2">
                        <div class="form-group">
                            <label for="">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-user"></i></span>
                                <input type="text" class="form-control" readonly placeholder="Full Name" value="{{Auth::user()->first_name ?? ''}} {{Auth::user()->surname ?? ''}}">
                            </div>
                            @error('full_name')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Subject</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-check"></i></span>
                                <input type="text" class="form-control" placeholder="Subject" wire:model.debounce.90000ms="subject">
                            </div>
                            @error('subject')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-check"></i></span>
                                <select  wire:model.debounce.90000ms="category" class="form-control col-md-4">
                                    <option selected disabled>Select category</option>
                                    <option value="1">Sales & Marketing</option>
                                    <option value="2">Technical support</option>
                                    <option value="3">Others</option>
                                </select>
                            </div>
                            @error('category')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Attachment <i>(Optional)</i></label>
                            <input type="file"  wire:model.debounce.90000ms="attachment" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="">Content</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-email"></i></span>
                                <textarea  wire:model.debounce.90000ms="content" class="content form-control" rows="5" style="resize: none;" placeholder="Compose mail" value="{{old('content')}}"></textarea>
                            </div>
                            @error('content')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="btn-group d-flex justify-content-center">
                                <a href="{{url()->previous()}}" class="btn btn-mini btn-danger"> <i class="ti-close mr-2"></i> Cancel</a>
                                <button type="submit" class="btn btn-mini btn-primary"><i class="zmdi zmdi-mail-send mr-2"></i> Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
