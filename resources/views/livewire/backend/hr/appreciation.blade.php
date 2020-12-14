<div>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center m-l-0">
                        <div class="col-auto">
                            <i class="icofont icofont-medal-alt f-30 text-c-lite-green"></i>
                        </div>
                        <div class="col-auto">
                            <h6 class="text-muted m-b-10">Last Year</h6>
                            <h2 class="m-b-0">{{number_format($lastYear)}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center m-l-0">
                        <div class="col-auto">
                            <i class="icofont icofont-medal-alt f-30 text-c-green"></i>
                        </div>
                        <div class="col-auto">
                            <h6 class="text-muted m-b-10">This Year</h6>
                            <h2 class="m-b-0">{{number_format($thisYear)}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center m-l-0">
                        <div class="col-auto">
                            <i class="icofont icofont-medal-alt f-30 text-success"></i>
                        </div>
                        <div class="col-auto">
                            <h6 class="text-muted m-b-10">Last Month</h6>
                            <h2 class="m-b-0">{{number_format($lastMonth)}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center m-l-0">
                        <div class="col-auto">
                            <i class="icofont icofont-medal-alt f-30 text-c-blue"></i>
                        </div>
                        <div class="col-auto">
                            <h6 class="text-muted m-b-10">This Month</h6>
                            <h2 class="m-b-0">{{number_format($thisMonth)}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @include('livewire.backend.hr.common._slab-menu')
                </div>
            </div>
        </div>
   </div>

</div>
<div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">Appreciation</h5>
                </div>
                <div class="card-block accordion-block">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="accordion-panel">
                            <div class="accordion-heading" role="tab" id="headingOne">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <button class="btn btn-mini btn-round btn-light" type="button">
                                        <i class="icofont icofont-plus"></i> Add New Appreciation
                                    </button>
                                </a>
                            </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne" style="">
                                <div class="accordion-content accordion-desc">
                                    <form >
                                        <div class="form-group">
                                            <label class="">Content</label>
                                                <textarea id="appreciation_text"  cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Type content here..."></textarea>
                                                @error('appreciation_text')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="">Persons:</label>
                                                <select id="appreciating" class="js-example-basic-multiple col-sm-8 col-md-8" multiple="multiple">
                                                    <option value="32 " selected>To all employees</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 d-flex justify-content-center">
                                                <button class="btn btn-primary btn-mini" type="submit" id="submitAppreciation">Submit</button>

                                            </div>
                                            <div class="col-md-12 d-flex justify-content-center mt-1 ">
                                                <div class="preloader3 loader-block appreciation-cus-preloader">
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
                        <div class="accordion-panel">
                            <div class="accordion-heading" role="tab" id="headingTwo">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Appreciation Log
                                </a>
                            </h3>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="accordion-content accordion-desc">
                                    <div class="card">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table ">
                                                            <thead>
                                                                <th>#</th>
                                                                <th>Responsible Person</th>
                                                                <th>From</th>
                                                                <th>Content</th>
                                                                <th>Date</th>
                                                            </thead>
                                                            @php
                                                                $index = 1;
                                                            @endphp
                                                            @foreach ($appreciations as $appreciate)
                                                                @foreach ($appreciate->responsiblePersons as $person)
                                                                    <tr>
                                                                        <td>{{ $index++}}</td>
                                                                        <td><img src="{{ $person->user->avatar ?? '/assets/images/user.png' }}" class="img-30" alt="{{ $person->user->first_name }}">
                                                                            {{ $person->user->first_name }} {{ $person->user->surname ?? '' }}</td>
                                                                        <td><img src="{{ $appreciate->user->avatar ?? '/assets/images/user.png' }}" class="img-30" alt="{{ $appreciate->user->first_name }}">
                                                                            {{$appreciate->user->first_name}} {{$appreciate->surname ?? ''}}</td>
                                                                        <td> <a href="#">{!! strlen($appreciate->post_content) > 43 ? substr($appreciate->post_content, 0, 43).'...' : $appreciate->post_content !!}</a> </td>
                                                                        <td>
                                                                            <label for="" class="label label-info">{{date('d F, Y', strtotime($appreciate->created_at)) ?? ''}}</label>
                                                                        </td>
                                                                    </tr>

                                                                @endforeach
                                                            @endforeach
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
@push('appreciation-script')
    <script src="/assets/js/cus/appreciation.js"></script>
@endpush
