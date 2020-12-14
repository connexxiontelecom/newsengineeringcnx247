<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Add New Education</h5>
                <form wire:submit.prevent="addNewEducation">
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="">Institution</label>
                        <input type="text" class="form-control" placeholder="Institution" wire:model.debounce.900000ms="institution">
                        @error('institution')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Program</label>
                        <input type="text" class="form-control" placeholder="Program" wire:model.debounce.900000ms="program">
                        @error('program')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control" placeholder="Address" wire:model.debounce.900000ms="address">
                        @error('address')
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
                            <label>Qualification</label>
                            <select class="form-control col-md-12" wire:model.debounce.90000ms="qualification">

                            </select>
                            @error('qualification')
                                <i>{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <button class="btn btn-mini btn-danger" wire:click="cancelEdit" type="button"> <i class="ti-close"></i> Cancel</button>
                            <button class="btn btn-mini btn-primary" type="submit"> <i class="ti-check"></i> {{$btn_text}}</button>
                            <div class="preloader3 loader-block" wire:loading wire.target="addNewEducation">
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
                <h5 class="sub-title">Education</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Institution</th>
                            <th>Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($educations as $education)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$education->institution ?? ''}}</td>
                                    <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($education->created_at))}}</td>
                                    <td>
                                        <a href="javascript:void(0);" wire:click="editEducation({{$education->id}})"> <i class="ti-pencil text-warning"></i> </a>
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


