<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Add New Work Experience</h5>
                <form wire:submit.prevent="addNewWorkExperience">
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="">Organization Name</label>
                        <input type="text" class="form-control" placeholder="Organization Name" wire:model.debounce.900000ms="organization_name">
                        @error('organization_name')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Job Role</label>
                        <input type="text" class="form-control" placeholder="Job Role" wire:model.debounce.900000ms="job_role">
                        @error('job_role')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" class="form-control" placeholder="Location" wire:model.debounce.900000ms="location">
                        @error('location')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Start Date</label>
                                <input type="date" class="form-control" placeholder="Start Date" wire:model.debounce.900000ms="start_date">
                                <label class="label label-primary">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($start_date))}}</label>
                                @error('start_date')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">End Date</label>
                                <input type="date" class="form-control" placeholder="End Date" wire:model.debounce.900000ms="end_date">
                                <label class="label label-primary">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($end_date))}}</label>
                                @error('end_date')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Role Description</label>
                            <textarea class="form-control" placeholder="Type brif description of your job role...." wire:model.debounce.90000000ms="role_description" style="resize:none;"></textarea>
                            @error('role_description')
                                <i>{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <button class="btn btn-mini btn-danger" wire:click="cancelEdit" type="button"> <i class="ti-close"></i> Cancel</button>
                            <button class="btn btn-mini btn-primary" type="submit"> <i class="ti-check"></i> {{$btn_text}}</button>
                            <div class="preloader3 loader-block" wire:loading wire.target="addNewWorkExperience">
                                <div class="circ1 loader-primary"></div>
                                <div class="circ2 loader-primary"></div>
                                <div class="circ3 loader-primary"></div>
                                <div class="circ4 loader-primary"></div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Work Experience</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Organization</th>
                            <th>Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($experiences as $experience)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$experience->organisation ?? ''}}</td>
                                    <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($experience->created_at))}}</td>
                                    <td>
                                        <a href="javascript:void(0);" wire:click="editExperience({{$experience->id}})"> <i class="ti-pencil text-warning"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


