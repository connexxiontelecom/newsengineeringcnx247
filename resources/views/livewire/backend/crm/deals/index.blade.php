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
    <div class="col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">Deals</h5>
            </div>
            <div class="card-block p-b-0">
                <div class="row">
                    <div class="col-md-12" id="draggableMultiple">
                        <div class="row">
                            @if (count($deals) > 0)
                                @foreach ($deals as $deal)
                                    <div class="col-md-6">
                                        <div class="sortable-moves" style="">
                                            <img class="img-fluid p-absolute" src="/assets/images/avatars/thumbnails/avatar.png" alt="Client">
                                                <table class="table m-0">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Full Name</th>
                                                            <td>{{$deal->client->first_name ?? ''}} {{$deal->client->surname ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Mobile</th>
                                                            <td>{{$deal->client->mobile_no ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Email</th>
                                                            <td>{{$deal->client->email ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Website</th>
                                                            <td>{{$deal->client->website ?? ''}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            <div class="row">
                                                <div class="col-md-12 d-flex justify-content-end">
                                                    <div class="btn-group mr-3">
                                                        <a href="{{route('edit-client', $deal->client->slug)}}"><i class="ti-pencil text-warning p-2"></i></a>
                                                        <a href="{{route('view-deal', $deal->client->slug)}}"><i class="ti-eye text-primary p-2"></i></a>
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
    </div>
</div>
</div>
