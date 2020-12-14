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
        <div class="col-md-12 col-xl-12 filter-bar">
            <nav class="navbar navbar-light bg-faded m-b-30 p-10">
                <div class="input-group col-md-8 offset-md-1 mt-2">
                    <input type="text" class="form-control" placeholder="Search for lead">
                    <span class="input-group-addon btn-mini " id="basic-addon5"><i class="ti-search mr-2"></i> Search lead</span>
                </div>
            </nav>
        </div>
   </div>

   <div class="row">
    <div class="col-lg-12 col-xl-12">
        <!-- Draggable Multiple List card start -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">Leads</h5>
            </div>
            <div class="card-block p-b-0">
                <div class="row">
                    <div class="col-md-12" id="draggableMultiple">
                        <div class="row">
                            @if (count($leads) > 0)
                                @foreach ($leads as $lead)
                                    <div class="col-md-6">
                                        <div class="sortable-moves" style="">
                                            <img class="img-fluid p-absolute" src="/assets/images/avatars/thumbnails/avatar.png" alt="Client">
                                                <table class="table m-0">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Full Name</th>
                                                            <td>{{$lead->client->first_name ?? ''}} {{$lead->client->surname ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Mobile</th>
                                                            <td>{{$lead->client->mobile_no ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Email</th>
                                                            <td>{{$lead->client->email ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Website</th>
                                                            <td>{{$lead->client->website ?? ''}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            <div class="row">
                                                <div class="col-md-12 d-flex justify-content-end">
                                                    <div class="btn-group mr-3">
                                                        <a href="{{route('edit-client', $lead->client->slug)}}"><i class="ti-pencil text-warning p-2"></i></a>
                                                        <a href="{{route('view-lead', $lead->client->slug)}}"><i class="ti-eye text-primary p-2"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <h4 class="text-center">No record found.</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Draggable Multiple List card end -->
    </div>
    <!-- Container-fluid ends -->
</div>
</div>
