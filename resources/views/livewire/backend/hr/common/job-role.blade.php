<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="sub-title">Add New Job Role</h5>
            </div>
            <div class="card-block">
                <form wire:submit.prevent="submitJobRole">
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
                    <div class="form-group">
                        <label for="">Job Role</label>
                        <input type="text" wire:model.lazy="job_role" class="form-control" placeholder="Job Role">
                        @error('job_role')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Department</label>
                        <select wire:model.lazy="department" class="form-control">
                            <option disabled selected>Select department</option>
                            @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->department_name ?? '' }}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Role Description</label>
                        <textarea wire:model.lazy="role_description" placeholder="Job description" style="resize: none;" cols="30" rows="10" class="form-control"></textarea>
                        @error('role_description')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button class="btn btn-mini btn-primary" type="submit"> <i class="ti-check"></i> Submit</button>
                        <div class="preloader3 loader-block" wire:loading wire.target="submitJobRole">
                            <div class="circ1 loader-primary"></div>
                            <div class="circ2 loader-primary"></div>
                            <div class="circ3 loader-primary"></div>
                            <div class="circ4 loader-primary"></div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="sub-title">Job Roles</h5>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Job Role</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($job_roles as $role)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$role->role_name}}</td>
                                    <td>{{$role->department->department_name}}</td>
                                    <td>{{date('d F, Y', strtotime($role->created_at))}}</td>
                                    <td>
                                        <a href=""> <i class="ti-pencil text-warning"></i> </a>
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


