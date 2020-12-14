<div class="row">
    <div class="col-md-12">
        <div class="sub-title">Announcement</div>
        <ul class="nav nav-tabs md-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#expenseReportTab" role="tab">Announcement</a>
                <div class="slide"></div>
            </li>
        </ul>      

        <div class="tab-content card-block">
            <div class="tab-pane active" id="expenseReportTab" role="tabpanel">
                
                 <div class="card">
                    <div class="card-header">
                        @include('backend.workflow.common._run-business-process')
                        <h5>Announcement</h5>
                        <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                    </div>
                    <div class="card-block">
                        @if(session()->has('success'))
                            <div class="alert alert-success border-success" style="padding:5px;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled"></i>
                                </button>
                                <strong>Success!</strong> {!! session('success') !!}
                            </div>
                        @endif

                    <form wire:submit.prevent="submitInternalMemo">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Subject</label>
                            <div class="col-sm-10">
                                <input wire:model.lazy="subject" type="text" class="form-control form-control-normal" placeholder="Subject">
                                @error('subject')
                                    <span class="mt-3">
                                        <i class="text-danger">{{ $message }}</i>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Content</label>
                           <div class="col-sm-10">
                                <textarea wire:model.lazy="content" class="form-control form-control-normal" placeholder="Content"></textarea>
                                @error('content')
                                    <span class="mt-3">
                                        <i class="text-danger">{{ $message }}</i>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">To</label>
                            <div class="col-sm-10 form-radio" wire:ignore>
                                    <div class="radio radio-inline">
                                        <label>
                                            <input class="target" type="radio" value="all" name="receiver" checked="checked">
                                            <i class="helper"></i>All employees
                                        </label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <label>
                                            <input class="target" type="radio" name="receiver" value="employees">
                                            <i class="helper"></i>Specific employees
                                        </label>
                                    </div>
                                    <div class="radio radio-inline radio-disable">
                                        <label>
                                            <input class="target" type="radio" name="receiver" value="department">
                                            <i class="helper"></i>Department
                                        </label>
                                    </div>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10 col-md-4" wire:ignore>
                                  <select wire:model.lazy="department" class="form-control form-control-normal">
                                      <option disabled selected>Select department</option>
                                      @foreach ($departments as $depart)
                                        <option value="{{$depart->id}}">{{$depart->department_name}}</option>
                                      @endforeach
                                  </select>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10 col-md-4" wire:ignore>
                                <select  id="employees" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                    <option selected disabled>Add person(s)</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Attachment <br> <i>(Optional)</i></label>
                            <div wire:ignore class="col-sm-10 col-md-2">
                                <button class="btn btn-primary btn-sm" type="button" id="attachFileBtn">
                                    <i class="ti-cloud-up mr-2"></i>Upload attachment</button>
                                <input type="file" hidden id="attachFile">
                            </div>
                        </div>
                        <div class=" row m-t-30 d-flex justify-content-center">
                            <div class="preloader3 loader-block mb-3" wire:loading wire:target="submitExpenseReport">
                                <div class="circ1 loader-primary"></div>
                                <div class="circ2 loader-primary"></div>
                                <div class="circ3 loader-primary"></div>
                                <div class="circ4 loader-primary"></div>
                            </div>
                            <div class="col-sm-10 col-md-12">
                                <div class="btn-group d-flex justify-content-center">
                                    <button class="btn btn-default btn-sm"><i class="ti-na text-danger mr-2"></i>Cancel</button>
                                    <button class="btn btn-primary btn-sm" wire:loading.class="bg-gray" type="submit"><i class="ti-save mr-2"></i>Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@push('memo-script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.target', function(e){
                var data = $("[name='receiver']:checked").val();
                @this.set('target', data);
            });
        });
    </script>
@endpush