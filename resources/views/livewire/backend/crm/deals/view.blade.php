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
        <div class="col-lg-12 col-xl-12 col-md-12">
            <!-- Draggable Multiple List card start -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">{{ $deal->client->first_name ?? ''}} {{$deal->client->surname ?? ''}}</h5>
                    <div class="btn-group d-flex justify-content-end">
                        <a href="{{route('new-client')}}" class="btn btn-mini btn-primary"><i class="ti-plus"></i> Add New Client</a>
                        <a href="{{route('clients')}}" class="btn btn-mini btn-danger"><i class="ti-user"></i> All Clients</a>
                        <button type="button" class="btn btn-mini btn-default" data-toggle="modal" data-target="#sendEmail"><i class="ti-email"></i> Send Email</button>
                        <button type="button" class="btn btn-mini btn-secondary" data-toggle="modal" data-target="#sendSMS"><i class="ti-comment-alt"></i> Send SMS</button>
                    </div>
                </div>
                <div class="card-block p-b-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 col-lg-3">
                                    <div class="card">
                                        <div class="card-block user-radial-card">
                                            <div class="btn-group mr-3">
                                                <a href=""><i class="ti-pencil text-warning p-2"></i></a>
                                                <a href=""><i class="ti-trash text-danger p-2"></i></a>
                                            </div>
                                            <div data-label="50%" class="radial-bar radial-bar-60 radial-bar-lg radial-bar-primary">
                                                <img src="\assets\images\avatar-2.jpg" alt="User-Image">
                                            </div>
                                            <div style="text-align: left;" class="mt-2">
                                                <p><label class="label label-primary">Full Name</label></p>
                                                <label>{{$deal->client->first_name ?? ''}} {{$deal->client->surname ?? ''}}</label>

                                                <p><label class="label label-primary">Mobile</label></p>
                                                <label>{{$deal->client->mobile_no ?? ''}}</label>

                                                <p><label class="label label-primary">Email</label></p>
                                                <label>{{$deal->client->email ?? ''}}</label>

                                                <p><label class="label label-primary">Website</label></p>
                                                <label>{{$deal->client->website ?? ''}}</label>

                                                <p><label class="label label-primary">Street 1</label></p>
                                                <label>{{$deal->client->street_1 ?? ''}}</label>

                                                <p><label class="label label-primary">Street 2</label></p>
                                                <label>{{$deal->client->street_2 ?? ''}}</label>

                                                <p><label class="label label-primary">City</label></p>
                                                <label>{{$deal->client->city ?? ''}}</label>

                                                <p><label class="label label-primary">Postal Code</label></p>
                                                <label>{{$deal->client->postal_code ?? ''}}</label>

                                                <p><label class="label label-primary">Note</label></p>
                                                <p>{!! $deal->client->note ?? '' !!}</p>

                                                <p><label class="label label-danger">Date Registered</label></p>
                                                <label>{{date('d F, Y', strtotime($deal->created_at)) ?? ''}}</label>

                                                <p><label class="label label-success">Owner</label></p>
                                                <label>Joseph</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="card">
                                                <div class="card-block">
                                                    <h5 class="sub-title">Conversation</h5>
                                                    <div class="card-block accordion-block">
                                                        <div id="accordion" role="tablist" aria-multiselectable="true">
                                                            @if (count($conversations) > 0)
                                                                @foreach ($conversations as $convo)
                                                                    <div class="accordion-panel">
                                                                        <div class="accordion-heading" role="tab" id="headingOne_{{$convo->id}}">
                                                                            <h3 class="card-title accordion-title">
                                                                            <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_{{$convo->id}}" aria-expanded="false" aria-controls="collapseOne_{{$convo->id}}">
                                                                                <img src="\assets\images\user.png" class="img-30" alt="user.png">  {{$convo->subject ?? ''}} <sup><i class="ti-comment-alt text-success"></i></sup> <span class="float-right"><small>{{date('d F, Y', strtotime($convo->created_at))}} @ {{date('h:i a', strtotime($convo->created_at))}}</small></span>
                                                                            </a>
                                                                        </h3>
                                                                        </div>
                                                                        <div id="collapseOne_{{$convo->id}}" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne_{{$convo->id}}" style="">
                                                                            <div class="accordion-content accordion-desc">
                                                                                <p>
                                                                                    {!! $convo->conversation ?? '' !!}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <p class="text-center mb-3">Be the first to start a conversation</strong></p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form wire:submit.prevent="submitConversation">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-block">
                                                                        <div class="form-group">
                                                                            <label for="">Subject</label>
                                                                            <input type="text" placeholder="Subject" class="form-control" wire:model="subject">
                                                                            @error('subject')
                                                                                <i class="text-danger">{{$message}}</i>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Conversation</label>
                                                                            <textarea style="resize: none;" wire:model="conversation" placeholder="What was the nature of your conversation with {{$client->title ?? ''}} {{ $client->first_name ?? ''}}?" class="form-control"></textarea>
                                                                            @error('conversation')
                                                                                <i class="text-danger">{{$message}}</i>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group d-flex justify-content-center">
                                                                            <input type="hidden" value="{{$deal->client->id}}" wire:model="client_id">
                                                                            <button class="btn btn-primary btn-mini" type="submit">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-block">
                                                    <h5 class="sub-title">Activity Log</h5>
                                                    <ul>
                                                        @foreach ($logs as $log)
                                                            <li>
                                                                <i class="icofont icofont-hand-right text-info"></i> {{$log->log}} <small class="text-info">{{date('d F, Y', strtotime($log->created_at))}} @ {{date('h:i a', strtotime($log->created_at))}}</small>
                                                            </li>
                                                            <hr>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Invoices</h5>
                            </div>
                            <div class="card-block table-border-style">
                                <div class="table-responsive">
                                    <table class="table table-lg table-styling">
                                        <thead>
                                            <tr class="table-primary">
                                                <th>#</th>
                                                <th>Invoice No.</th>
                                                <th>Issue Date</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach($invoices as $invoice)
                                                <tr>
                                                    <th scope="row">{{$i++}}</th>
                                                    <td>{{$invoice->invoice_no}}</td>
                                                    <td>{{date('d F, Y', strtotime($invoice->issue_date))}}</td>
                                                    <td>{{date('d F, Y', strtotime($invoice->due_date))}}</td>
                                                    <td>
                                                        @if($invoice->status == 0)
                                                            <label class="badge badge-warning text-white">Pending</label>
                                                        @else
                                                            <label class="badge badge-success text-white">Paid</label>

                                                        @endif
                                                    </td>
                                                    <td>
                                                        <label class="label label-md label-danger">${{number_format($invoice->total,2)}}</label>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{route('print-invoice', $invoice->slug)}}"><i class="ti-printer mr-2 text-success"></i></a>
                                                        </div>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Receipts</h5>
                            </div>
                            <div class="card-block table-border-style">
                                <div class="table-responsive">
                                    <table class="table table-lg table-styling">
                                        <thead>
                                            <tr class="table-primary">
                                                <th>#</th>
                                                <th>Receipt No.</th>
                                                <th>Issue Date</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach($receipts as $receipt)
                                                <tr>
                                                    <th scope="row">{{$i++}}</th>
                                                    <td>{{$receipt->receipt_no}}</td>
                                                    <td>{{date('d F, Y', strtotime($receipt->issue_date))}}</td>
                                                    <td>{{date('d F, Y', strtotime($receipt->due_date))}}</td>
                                                    <td>
                                                        @if($receipt->status == 0)
                                                            <label class="badge badge-warning text-white">Pending</label>
                                                        @else
                                                            <label class="badge badge-success text-white">Paid</label>

                                                        @endif
                                                    </td>
                                                    <td>
                                                        <label class="label label-md label-danger">${{number_format($receipt->total,2)}}</label>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{route('print-receipt', $receipt->slug)}}"><i class="ti-printer mr-2 text-success"></i></a>
                                                        </div>
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
            </div>
        </div>
    </div>

</div>


