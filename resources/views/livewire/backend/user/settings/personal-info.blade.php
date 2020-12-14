<div class="row">
    <div class="col-md-12">
        @if(session()->has('success'))
            <div class="alert alert-success background-success" style="padding:5px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                 {!! session('success') !!}
            </div>
        @endif
        <form wire:submit.prevent="updateProfile">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>First Name</label>
                        <input class="form-control" type="text" wire:model.debounce.90000ms="first_name" placeholder="First Name">
                        @error('first_name')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Surname</label>
                        <input class="form-control" type="text" wire:model.debounce.90000ms="surname" placeholder="Surname">
                        @error('surname')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input class="form-control" type="text" wire:model.debounce.90000ms="email" readonly placeholder="Email Address">
                        @error('email')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Mobile No.</label>
                        <input class="form-control" type="text" wire:model.debounce.90000ms="mobile" placeholder="Mobile Number">
                        @error('mobile')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Birth Date</label>
                        <input class="form-control" type="date" wire:model.debounce.90000ms="birth_date" placeholder="Birth Date">
                        <label class="label label-primary">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($birth_date))}}</label>
                        @error('birth_date')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Position</label>
                        <input class="form-control" type="text" wire:model.debounce.90000ms="position" placeholder="Position">
                        @error('position')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Hire Date</label>
                        <input class="form-control" type="date" wire:model.debounce.90000ms="hire_date" placeholder="Hire Date">
                        <label class="label label-primary">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($hire_date))}}</label>
                        @error('hire_date')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Start Date</label>
                        <input class="form-control" type="date" wire:model.debounce.90000ms="start_date" placeholder="Start Date">
                        <label class="label label-primary">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($start_date))}}</label>
                        @error('start_date')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Confirm Date</label>
                        <input class="form-control" type="date" wire:model.debounce.90000ms="confirm_date" placeholder="Confirm Date">
                        <label class="label label-primary">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($confirm_date))}}</label>
                        @error('confirm_date')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Marital Status</label>
                        <select id="" class="form-control" wire:model.debounce.50000ms="marital_status">
                            <option disabled selected wire:ignore>Select marital status</option>
                            @foreach ($marital_statuses as $stat)
                                <option value="{{$stat->id}}">{{$stat->name ?? ''}}</option>
                            @endforeach
                        </select>
                        @error('marital_status')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Gender</label>
                        <select  id="" class="form-control" wire:model.debounce.50000ms="gender">
                            <option disabled selected wire:ignore>Select gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                        @error('gender')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" style="resize:none;" wire:model.debounce.90000ms="address" placeholder="Address"></textarea>
                        @error('address')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Department</label>
                        <select wire:model.debounce.9000ms="department" class="form-control">
                            <option disabled selected>Select Department</option>
                            @foreach($departments as $depart)
                             <option value="{{$depart->id}}">{{$depart->department_name}}</option>
                            @endforeach
                        </select>
                        @if (count($departments) <= 0)
                            <small class="text-danger">There's no departments. Visit HR Configurations to add departments</small>
                        @endif
                        @error('department')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr>
                    <div class="btn-group d-flex justify-content-center">
                        <a href="{{route('my-profile')}}" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i> Close</a>
                        <button type="submit" class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i> Save changes</button>
                        <div class="preloader3 loader-block" wire:loading wire.target="updateProfile">
                            <div class="circ1 loader-primary"></div>
                            <div class="circ2 loader-primary"></div>
                            <div class="circ3 loader-primary"></div>
                            <div class="circ4 loader-primary"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
