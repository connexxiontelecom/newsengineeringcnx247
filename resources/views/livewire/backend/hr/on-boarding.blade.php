<div>
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
                    <h4 class="sub-title">Staff onBoarding</h4>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger background-danger mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('error') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-top:-30px;">
        <div class="card-block email-card">
            <form wire:submit.prevent="onBoardStaff">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-xl-8 offset-md-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" wire:model="first_name" placeholder="First Name" class="form-control" value="{{old('first_name')}}">
                                    @error('first_name')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Surname</label>
                                    <input type="text" wire:model="surname" placeholder="Surname" class="form-control" value="{{old('surname')}}">
                                    @error('surname')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <input type="text" wire:model="email_address" placeholder="Email Address" class="form-control" value="{{old('email_address')}}">
                                    @error('email_address')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Mobile Number</label>
                                    <input type="text" wire:model="mobile_no" placeholder="Mobile Number" class="form-control" value="{{old('mobile_no')}}">
                                    @error('mobile_no')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Birth Date</label>
                                    <input type="date" wire:model="birth_date" placeholder="Birth Date" class="form-control" value="{{old('birth_date')}}">
                                    @error('birth_date')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Hire Date</label>
                                    <input type="date" wire:model="hire_date" placeholder="Hire Date" class="form-control" value="{{old('hire_date')}}">
                                    @error('hire_date')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input type="date" wire:model="start_date" placeholder="Start Date" class="form-control" value="{{old('start_date')}}">
                                    @error('start_date')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Position</label>
                                    <input type="text" wire:model="position" placeholder="Position" class="form-control" value="{{old('position')}}">
                                    @error('position')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Department</label>
                                    <select wire:model="department" class="form-control">
                                        @foreach ($departments as $depart)
                                            <option value="{{$depart->id}}">{{$depart->department_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted"><strong class="text-danger">Note:</strong> A random password will be generated and sent to staff via email. The concerned person is adviced to change default password upon successful login.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="btn-group d-flex justify-content-center">
                                <a href="submit" class="btn btn-mini btn-danger"> <i class="ti-close mr-2"></i> Cancel</a>
                                <button type="submit" class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i> Submit</button>
                                <div class="preloader3 loader-block" wire:loading wire.target="onBoardStaff">
                                    <div class="circ1 loader-primary"></div>
                                    <div class="circ2 loader-primary"></div>
                                    <div class="circ3 loader-primary"></div>
                                    <div class="circ4 loader-primary"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
