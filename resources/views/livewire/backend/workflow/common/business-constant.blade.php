<div class="tab-pane" id="businessProcessConstants" role="tabpanel">
    <div class="card">
        
        <div class="card-block tab-content">
            <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xl-6 col-md-6 m-b-30">
                    <div class="card-header">
                        Set Business Process Constants
                    </div>
                    @if(session()->has('success'))
                    <div class="alert alert-success border-success" style="padding:5px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled"></i>
                        </button> {!! session('success') !!}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-warning border-warning" style="padding:5px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled"></i>
                        </button> {!! session('error') !!}
                    </div>
                @endif
                <form wire:submit.prevent="setBusinessConstant"> 
                    <div class="form-group">
                        <label class="text-muted">Department</label>
                        <select wire:model.lazy="department" class="form-control form-control-normal">
                            <option selected disabled>Select department</option>
                            @foreach($departments as $depart)
                                <option value="{{$depart->id}}">{{$depart->department_name ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div wire:ignore class="form-group">
                        <label class="text-muted">Processors</label>
                        <select  id="processors" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                            <option selected disabled>Add initial approver(s)</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-muted">Request Type</label>
                        <select wire:model.lazy="request_type" class="form-control">
                            <option disabled selected>Select type of request</option>
                            <option value="expense-report">Expense Report</option>
                            <option value="purchase-request">Purchase Request</option>
                            <option value="general-request">General Request</option>
                            <option value="leave-request">Leave Request</option>
                            <option value="business-trip">Business Trip</option>
                        </select>

                    </div>
                    <div class="preloader3 loader-block mb-3" wire:loading wire.target="setBusinessConstant">
                        <div class="circ1 loader-primary"></div>
                        <div class="circ2 loader-primary"></div>
                        <div class="circ3 loader-primary"></div>
                        <div class="circ4 loader-primary"></div>
                    </div>
                    <div class="btn-group d-flex justify-content-center">
                        <button class="btn btn-primary btn-sm" wire:loading.class="bg-gray" type="submit">
                            <i class="ti-save mr-2"></i>Submit
                        </button>
                    </div>
                </form>
                </div>
                <div class="col-sm-6 col-xl-6 col-md-6 m-b-30">
                    <div class="card-header">
                        Existing Processors
                    </div>
                    <div class="row card-block">
                        <div class="col-md-12 col-lg-12">
                            <div class="card card-block user-card ">
                                <ul class="scroll-list wave ">
                                    @foreach ($processor_list as $processor)
                                        <li>
                                            <h6>{{$processor->processor->first_name}} {{$processor->processor->surname ?? ''}}
                                                <small class="float-right">{{ $processor->department->department_name }}</small>
                                            </h6>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@push('business-scripts')
    <script>
        $(document).ready(function(){
            $('#processors').select2();
            $('#processors').on('change', function(e){
                var data = $('#processors').select2("val");
                @this.set('processors', data);
            });
        });
    </script>
@endpush