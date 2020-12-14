<div class="row">
    <div class="col-md-12">
        <form wire:submit.prevent="updateProfile">
            @if (session()->has('success'))
                <div class="alert alert-success background-success mt-3">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="icofont icofont-close-line-circled text-white"></i>
                    </button>
                    {!! session()->get('success') !!}
                </div>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">First Name</label>
                        <input wire:model.debounce.50000ms="first_name" type="text" placeholder="First Name" class="form-control">
                        @error('first_name')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Surname</label>
                        <input type="text" wire:model.debounce.50000ms="surname" placeholder="Surname" class="form-control">
                        @error('surname')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Email Address</label>
                        <input type="email" placeholder="Email Address" value="{{Auth::user()->email}}" readonly class="form-control">
                        @error('email_address')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Mobile No.</label>
                        <input type="text" wire:model.debounce.50000ms="mobile" placeholder="Mobile No." class="form-control">
                        @error('mobile')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Position</label>
                        <input type="text" wire:model.debounce.50000ms="position"  placeholder="Position" class="form-control">
                        @error('position')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Employee ID</label>
                        <input type="text" wire:model.debounce.50000ms="employee_id" placeholder="Employee ID" class="form-control">
                        @error('employee_id')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Birth Date</label>
                        <input type="date" wire:model.debounce.50000ms="birth_date" placeholder="Birth Date" class="form-control">
                        @error('birth_date')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Department</label>
                        <select wire:model.debounce.50000ms="department"  class="form-control">
                            @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->department_name}}</option>
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
                <div class="col-md-4">
                    <label for="">Gender</label>
                    <div class="form-radio">
                        <div class="radio radio-inline">
                            <label>
                                <input type="radio" name="gender" wire:model.debounce.50000ms="gender" value="1" checked="checked">
                                <i class="helper"></i>Male
                            </label>
                        </div>
                        <div class="radio radio-inline">
                            <label>
                                <input type="radio" name="gender" wire:model.debounce.50000ms="gender" value="0">
                                <i class="helper"></i>Female
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Hire Date</label>
                        <input type="date" placeholder="Hire Date" wire:model.debounce.50000ms="hire_date" class="form-control">
                        @error('hire_date')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Start Date</label>
                        <input type="date"  placeholder="Start Date" class="form-control">
                        @error('start_date')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Confirm Date</label>
                        <input type="date" placeholder="Confirm Date" wire:model.debounce.50000ms="confirm_date" class="form-control">
                        @error('confirm_date    ')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" placeholder="Address" wire:model.debounce.50000ms="address" class="form-control">
                        @error('address')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group d-flex justify-content-center">
                        <a href="{{url()->previous()}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</a>
                        <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i>Save Changes</button>
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
