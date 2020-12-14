<div>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @include('livewire.backend.crm.common._slab-menu')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-lg-8 col-sm-12 offset-md-2 offset-lg-2">
            <div class="card">
                <div class="btn-group mt-3 btn-group d-flex justify-content-end mr-3" >
                    <a href="{{route('clients')}}" class="btn btn-primary btn-mini waves-effect waves-light">
                        <i class="ti-user"></i>All Clients
                    </a>
                </div>
                <div class="card-block">
                    <h5 class="sub-title">Add New Client</h5>
                    <span>All fields marked with <sup class="text-danger">*</sup> are compulsory.</span>
                    <form action="" wire:submit.prevent="addNewClient" class="mt-3">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="">Company Name</label>
                                    <input type="text" placeholder="Company Name" wire:model.debounce.900000ms="company_name" class="form-control">
                                    @error('company_name')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h4 class="sub-title mt-3">Contact Person</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">First Name <sup class="text-danger">*</sup> </label>
                                    <input type="text" class="form-control" placeholder="First Name" wire:model="first_name">
                                    @error('first_name')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Surname <sup class="text-danger">*</sup> </label>
                                    <input type="text" class="form-control" placeholder="Surname" wire:model="surname">
                                    @error('surname')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Position </label>
                                    <input type="text" class="form-control" placeholder="Position" wire:model="position">
                                    @error('position')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Mobile No. <sup class="text-danger">*</sup> </label>
                                <input type="text" class="form-control" placeholder="Mobile No." wire:model="mobile_no">
                                @error('mobile_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">

                            <div class="col-md-6">
                                <label for="">Email Address  <sup class="text-danger">*</sup> </label>
                                <input type="text" class="form-control" placeholder="Email Address " wire:model="email">
                                @error('email')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Website</label>
                                <input type="text" class="form-control" placeholder="Website" wire:model="website">
                                @error('website')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <h4 class="sub-title mt-3">Address</h4>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="">Street 1 <sup class="text-danger">*</sup> </label>
                                <input type="street_1" class="form-control" placeholder="Street 1" wire:model="street_1">
                                @error('street_1')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Street 2</label>
                                <input type="text" class="form-control" placeholder="Street 2" wire:model="street_2">
                                @error('street_2')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="">Country  <sup class="text-danger">*</sup> </label> <br>
                                <select name="" id="" class="form-control" wire:model="country">
                                    <option selected disabled wire:ignore>Select Country</option>
                                    @foreach($countries as $count)
                                        <option value="{{$count->id}}">{{ucfirst(strtolower($count->name))}}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">City  <sup class="text-danger">*</sup> </label> <br>
                                <input type="text" placeholder="City" class="form-control" wire:model="city">
                                @error('city')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="">Postal Code <sup class="text-danger">*</sup> </label>
                                <input type="text" class="form-control" placeholder="Postal Code" wire:model="postal_code">
                                @error('postal_code')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="">Note</label>
                                <textarea class="form-control" placeholder="Leave a Note" wire:model="note"></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="btn-group d-flex justify-content-center">
                                    <a href="{{url()->previous() }}" class="btn btn-secondary btn-mini">Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-mini">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
