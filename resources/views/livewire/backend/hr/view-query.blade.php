<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="sub-title">Query @if ($query->status == 1)
                        <label for="" class="label label-success float-right">Open</label>
                    @else
                        <label for="" class="label label-danger float-right">Closed</label>

                    @endif</h4>
                    <div class="btn-group float-right">
                        <a href="{{route('queries')}}" class="btn btn-mini btn-secondary"> <i class="ti-back-left mr-2"></i> Back</a>
                        @if ($query->queried_by == Auth::user()->id && $query->status == 1)
                            <button type="button" wire:click="closeQuery({{$query->id}})" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Close Query</button>
                        @endif
                        <a href="#reply-query" class="btn btn-success btn-mini"><i class="ti-comments mr-2"></i>Reply Query</a>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="resignContainer">
        <div class="row invoice-contact ">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="invoice-box row">
                    <div class="col-sm-12 ">
                        <table class="table table-responsive invoice-table table-borderless">
                            <tbody>
                                <tr>
                                    <td><img height="72" width="120" src="{{asset('/assets/images/company-assets/logos/'.Auth::user()->tenant->logo ?? 'logo.png')}}" class="m-b-10" alt="{{Auth::user()->tenant->company_name ?? ''}}"></td>
                                </tr>
                                <tr>
                                    <td>{{Auth::user()->tenant->street_1 ?? 'Address here'}}  {{Auth::user()->tenant->postal_code ?? 'Postal code here'}}, {{Auth::user()->tenant->city ?? 'City here'}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email: </strong><a href="mailto:{{Auth::user()->tenant->email}}" target="_top"><span class="__cf_email__" data-cfemail="690d0c0406290e04080005470a0604">[{{Auth::user()->tenant->email}}]</span>, </a> <br> <strong>Phone: </strong>{{Auth::user()->tenant->phone}} <br> <strong>Date: </strong>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($query->created_at))}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="row invoive-info">
                <div class="col-md-4 col-xs-12 invoice-client-info">
                    <h6 class="m-0">{{$query->queriedEmployee->first_name ?? ''}} {{$query->queriedEmployee->surname ?? ''}}</h6>
                    <p class="m-0 m-t-10">{{$query->queriedEmployee->address ?? 'Address here'}}</p>
                    <p class="m-0">{{$query->queriedEmployee->mobile ?? 'Mobile number here'}}</p>
                    <p><a href="mailto:{{$query->queriedEmployee->email ?? 'Email here'}}" class="__cf_email__" data-cfemail="eb8f8e8684ab939291c5888486">[{{$query->queriedEmployee->email ?? 'Email here'}}]</a></p>
                    <!-- <h6>Employee Information :</h6> -->
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {!! $query->query_content !!}
                </div>
            </div>

        </div>
    </div>
    <div class="card" style="margin-top:-25px;">
        <div class="card-block">
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">

                        <div class="btn-group ">
                            <a href="{{route('queries')}}" class="btn btn-mini btn-danger"><i class="ti-close"></i> Cancel</a>
                            <button class="btn-primary btn-mini btn" id="printQuery"><i class="ti-printer mr-2"></i> Print</button>
                        </div>

                </div>
            </div>
        </div>
    </div>

    <div class="card" id="reply-query">
        <div class="card-block">
            <div class="row">
                <div class="col-md-12 messages-content">
                   <h5 class="sub-title">Reply Query</h5>
                   <div>
                       @if (count($replies) > 0)
                        @foreach ($replies as $reply)
                        @if ($reply->from_id == Auth::user()->id)
                            <div class="media">
                                <div class="media-body text-right">
                                    <p class="msg-reply bg-primary">{!! $reply->reply !!}</p>
                                    <p><i class="icofont icofont-wall-clock f-12"></i> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($reply->created_at))}} at {{date('h:ia', strtotime($reply->created_at))}}</p>
                                </div>
                                <div class="media-right friend-box">
                                    <a href="{{route('view-profile', $reply->sender->url)}}">
                                        <img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$reply->sender->avatar ?? 'avatar.png'}}" alt="{{$reply->sender->first_name ?? ''}} {{$reply->sender->surname ?? ''}}">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="media">
                                <div class="media-left friend-box">
                                    <a href="{{route('view-profile', $reply->receiver->url)}}">
                                        <img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$reply->receiver->avatar ?? 'avatar.png'}}" alt="{{$reply->receiver->first_name ?? ''}} {{$reply->receiver->surname ?? ''}}">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <p class="msg-send">{!! $reply->reply !!}.</p>
                                    <p><i class="icofont icofont-wall-clock f-12"></i> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($reply->created_at))}} at {{date('h:ia', strtotime($reply->created_at))}}</p>
                                </div>
                            </div>
                        @endif
                        @endforeach
                       @else
                           <h5 class="text-center text-muted mb-3">No records found....</h5>
                       @endif

                     </div>
                </div>
                    <div class="col-md-12">
                        @if ($query->status == 1)
                            <div class="form-group">
                                <div class="input-group">
                                    <textarea wire:model.900000ms="query_reply" style="height: 60px; resize:none; outline:none;" id="alighaddon2" class="form-control new-msg" placeholder="Reply query"></textarea>
                                    <span class="input-group-addon bg-white" wire:click="submitReply"><i class="icofont icofont-paper-plane f-18 text-primary"></i></span>
                                </div>
                            </div>
                        @else
                            <p class="text-center text-danger">You can't reply this query. It's currently closed. Thank you.</p>
                        @endif

                    </div>
                </div>
        </div>
    </div>
</div>
@push('print-query-script')
<script src="{{asset('/assets/js/cus/printThis.js')}}"></script>
<script>
    $(document).ready(function(){
        $(document).on('click', '#printQuery', function(event){
        $('#queryContainer').printThis({
            header:"<p></p>",
                footer:"<p></p>",
            });
        });
    });
</script>
@endpush
