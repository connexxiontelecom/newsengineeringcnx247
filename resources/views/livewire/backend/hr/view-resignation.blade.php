<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="sub-title">Resignation @if ($resign->status == 'in-progress')
                        <label for="" class="label label-warning float-right">{{ucfirst($resign->status)}}</label>
                    @elseif($resign->status == 'approved')
                        <label for="" class="label label-success float-right">{{ucfirst($resign->status)}}</label>
                    @else
                        <label for="" class="label label-danger float-right">{{ucfirst($resign->status)}}</label>

                    @endif</h4>
                    <div class="btn-group float-right">
                        <a href="{{route('resignation')}}" class="btn btn-mini btn-secondary"> <i class="ti-back-left mr-2"></i> Back</a>
                        @if ($resign->user_id == Auth::user()->id)
                            <button type="button" wire:click="cancel({{$resign->id}})" class="btn btn-warning btn-mini"><i class="ti-close mr-2"></i>Cancel</button>
                        @endif
                        @if ($resign->status == 'in-progress')
                            <a href="javascript:void(0);" class="btn btn-success btn-mini" wire:click="approve({{$resign->id}})"><i class="ti-check mr-2"></i>Approve</a>
                            <a href="javascript:void(0);" class="btn btn-danger btn-mini" wire:click="decline({{$resign->id}})"><i class="ti-close mr-2"></i>Decline</a>
                        @endif
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
                                    <td><strong>Email: </strong><a href="mailto:{{Auth::user()->tenant->email}}" target="_top"><span class="__cf_email__" data-cfemail="690d0c0406290e04080005470a0604">[{{Auth::user()->tenant->email}}]</span>, </a> <br> <strong>Phone: </strong>{{Auth::user()->tenant->phone}} <br> <strong>Date: </strong>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($resign->created_at))}}
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
                    <h6 class="m-0">{{$resign->user->first_name ?? ''}} {{$resign->user->surname ?? ''}}</h6>
                    <p class="m-0 m-t-10">{{$resign->user->address ?? 'Address here'}}</p>
                    <p class="m-0">{{$resign->user->mobile ?? 'Mobile number here'}}</p>
                    <p><a href="mailto:{{$resign->user->email ?? 'Email here'}}" class="__cf_email__" data-cfemail="eb8f8e8684ab939291c5888486">[{{$resign->user->email ?? 'Email here'}}]</a></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {!! $resign->content !!}
                    <p>Effective Date: <label for="" class="label label-danger">{{date('d F, Y', strtotime($resign->effective_date))}}</label></p>
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
                            <button class="btn-primary btn-mini btn" id="printResign"><i class="ti-printer mr-2"></i> Print</button>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@push('print-resign-script')
<script src="{{asset('/assets/js/cus/printThis.js')}}"></script>
<script>
    $(document).ready(function(){
        $(document).on('click', '#printResign', function(event){
        $('#resignContainer').printThis({
            header:"<p></p>",
                footer:"<p></p>",
            });
        });
    });
</script>
@endpush
