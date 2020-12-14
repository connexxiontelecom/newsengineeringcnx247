<div>
    <div class="row">
        <div class="col-md-12 col-xl-4">
            <div class="card widget-statstic-card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5>Active</h5>
                        <p class="p-t-10 m-b-0 text-c-yellow">Current number of employees</p>
                    </div>
                </div>
                <div class="card-block">
                    <i class="feather icon-sliders st-icon bg-c-yellow"></i>
                    <div class="text-left">
                        <h3 class="d-inline-block">{{number_format(count($employees))}}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card widget-statstic-card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5>Terminated</h5>
                        <p class="p-t-10 m-b-0 text-c-pink">Employment terminated.</p>
                    </div>
                </div>
                <div class="card-block">
                    <i class="feather icon-users st-icon bg-c-pink txt-lite-color"></i>
                    <div class="text-left">
                        <h3 class="d-inline-block">{{number_format(count($terminated))}}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card widget-statstic-card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5>Resigned</h5>
                        <p class="p-t-10 m-b-0 text-c-blue">Those who resigned.</p>
                    </div>
                </div>
                <div class="card-block">
                    <i class="feather icon-shopping-cart st-icon bg-c-blue"></i>
                    <div class="text-left">
                        <h3 class="d-inline-block">{{number_format(count($resigned))}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12  filter-bar">
            <div class="card">
                <div class="card-block">
                    <form wire:submit.prevent="sortEmployeeByHire">
                        <div class="row">
                            <div class="col-sm-6 ">
                                <label for="">Hire Date</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon btn btn-light">
                                        <span class="">From</span>
                                    </span>
                                    <input type="date" wire:model.debounce.90000ms="hire_from" class="form-control" placeholder="From">
                                    <span class="input-group-addon btn btn-light">
                                        <span class="">To</span>
                                    </span>
                                    <input type="date" wire:model.debounce.90000ms="hire_to" class="form-control" placeholder="To">
                                        <button class="input-group-addon" style="cursor: pointer;" type="submit">Search</button>
                                </div>
                                @error('hire_from')
                                <i class="text-danger">{{$message}}</i> <br>
                                @enderror
                                @error('hire_to')
                                <i class="text-danger">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                    </form>
                    <form wire:submit.prevent="sortEmployeeByConfirmDate">
                        <div class="row">
                            <div class="col-sm-6 ">
                                <label for="">Confirm Date</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon btn btn-light">
                                        <span class="">From</span>
                                    </span>
                                    <input type="date" wire:model.debounce.90000ms="confirm_from" class="form-control" placeholder="From">
                                    <span class="input-group-addon btn btn-light">
                                        <span class="">To</span>
                                    </span>
                                    <input type="date" wire:model.debounce.90000ms="confirm_to" class="form-control" placeholder="To">
                                        <button class="input-group-addon" style="cursor: pointer;" type="submit">Search</button>
                                </div>
                                @error('confirm_from')
                                <i class="text-danger">{{$message}}</i> <br>
                                @enderror
                                @error('confirm_to')
                                <i class="text-danger">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-block">
            <div class="row mb-2">
                <div class="col-md-12">
                    <h5 class="mb-2 sub-title">Employees</h5>
                </div>
                <div class="col-sm-4 ">
                    <div class="input-group input-group-primary">
                        <select wire:model.lazy="department" id="" class="form-control">
                            @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->department_name ?? ''}}</option>
                            @endforeach
                        </select>
                        <span class="input-group-addon" wire:click="sortByDepartment">
                        <i class="icofont icofont-filter"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row users-card">

                @if (count($employees) > 0)
                    @foreach ($employees as $emp)
                    <div class="col-lg-6 col-xl-3 col-md-6">
                        <div class="card rounded-card user-card">
                            <div class="card-block">
                                <div class="img-hover">
                                    <img class="img-fluid img-radius" src="/assets/images/avatars/medium/{{$emp->avatar ?? '/assets/images/avatars/medium/avatar.png'}}" alt="{{$emp->first_name ?? ''}}  {{$emp->surname ?? ''}}">
                                    <div class="img-overlay img-radius">
                                        <span>
                                            <a href="{{route('view-profile', $emp->url)}}" class="btn btn-sm btn-primary"><i class="ti-eye"></i></a>
                                        </span>
                                    </div>
                                </div>
                                <div class="user-content">
                                    <a href="{{route('view-profile', $emp->url)}}"><h5 class="">{{$emp->first_name ?? ''}}  {{$emp->surname ?? ''}}</h5></a>
                                    <p class="m-b-0 text-muted">{{$emp->position ?? 'Kindly update profile'}}</p>
                                    <br>
                                    @if ($emp->account_status == 1)
                                        <label for="" class="label label-success">Active</label>
                                    @elseif($emp->account_status == 2)
                                        <label for="" class="label label-danger">Terminated</label>
                                    @endif
                                </div>

                            </div>
                        </div>
                        </div>
                    @endforeach

                @else
                    <div class="col-lg-12 col-xl-12 col-md-12">
                        <h5 class="text-muted text-center">There's no result for your search or no employee.</h5>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center" style="cursor: pointer;">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
