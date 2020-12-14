<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="sub-title">Ticket > <label for="" class="label label-primary">{{$ticket->subject ?? ''}}</label></h4>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-block">
                                                            <h5 class="sub-title">Conversation</h5>
                                                            <a href="{{route('admin-support')}}" class="btn btn-secondary btn-mini float-right mb-2"> <i class="ti-back-left mr-2"></i> Back To Tickets</a>
                                                            <div class="card-block accordion-block">
                                                                <div id="accordion" role="tablist" aria-multiselectable="true">
                                                                   <h6 class="sub-title">Subject: {{$ticket->subject}}</h6>
                                                                   <p class="text-muted">{!! $ticket->message !!}</p>
                                                                   @if ($ticket->user_id == Auth::user()->id || $ticket->status == 1)
                                                                    <p class="d-flex justify-content-center mt-3">
                                                                        <button wire:click="closeTicket" class="btn btn-primary btn-mini"> <i class="ti-check mr-2"></i> Close Ticket</button>
                                                                    </p>

                                                                   @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <form wire:submit.prevent="sendMessage">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-block">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-md-12 messages-content ">
                                                                                        <h5 class="sub-title">Conversation</h5>
                                                                                        <div style="overflow-y: scroll; height:250px;">
                                                                                            @if (count($messages) > 0)
                                                                                                @foreach ($messages as $message)
                                                                                                    @if ($message->from_id == Auth::user()->id)
                                                                                                    <div class="media">
                                                                                                        <div class="media-body text-right">
                                                                                                            @if (!empty($message->attachment))
                                                                                                                <p class="msg-reply bg-primary">
                                                                                                                    @if (pathinfo($message->attachment, PATHINFO_EXTENSION) == 'pdf')
                                                                                                                        <a href="/assets/uploads/attachments/{{$message->attachment}}">
                                                                                                                            <img src="/assets/formats/pdf.png" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="180" width="180">
                                                                                                                        </a>
                                                                                                                    @else
                                                                                                                        <a href="/assets/uploads/attachments/{{$message->attachment}}">
                                                                                                                            <img src="/assets/formats/jpg.png" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="180" width="180">
                                                                                                                        </a>
                                                                                                                    @endif
                                                                                                                </p>
                                                                                                                <p><i class="icofont icofont-wall-clock f-12"></i>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($message->created_at))}} @ {{date('h:ia', strtotime($message->created_at))}}</p>
                                                                                                            @elseif(!empty($message->content) )
                                                                                                                <p class="msg-reply bg-primary">{!! $message->content !!}</p>
                                                                                                                <p><i class="icofont icofont-wall-clock f-12"></i>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($message->created_at))}} @ {{date('h:ia', strtotime($message->created_at))}}</p>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                        <div class="media-right friend-box">
                                                                                                            <a href="#">
                                                                                                                <img class="media-object img-radius" src="/assets/images/avatars/medium/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="{{Auth::user()->first_name ?? ''}}">
                                                                                                            </a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    @else
                                                                                                        <div class="media">
                                                                                                            <div class="media-left friend-box">
                                                                                                                <a href="#">
                                                                                                                    <img class="media-object img-radius" src="\assets\images\avatar-1.jpg" alt="">
                                                                                                                </a>
                                                                                                            </div>
                                                                                                            <div class="media-body">
                                                                                                                @if (!empty($message->attachment))
                                                                                                                    <a href="/assets/uploads/attachments/{{$message->attachment}}">
                                                                                                                        <img src="/assets/formats/jpg.png" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="180" width="180">
                                                                                                                    </a>
                                                                                                                @elseif(!empty($message->content))
                                                                                                                    <p class="msg-send">
                                                                                                                        {!! $message->content  !!}
                                                                                                                    </p>
                                                                                                                @endif
                                                                                                                    <p><i class="icofont icofont-wall-clock f-12"></i> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($message->created_at))}} @ {{date('h:ia', strtotime($message->created_at))}}</p>
                                                                                                            </div>

                                                                                                        </div>
                                                                                                    @endif

                                                                                                @endforeach

                                                                                            @else
                                                                                                <p class="text-center">No conversations found....</p>
                                                                                            @endif
                                                                                        </div>
                                                                                        <hr>
                                                                                        <div class="messages-send">
                                                                                                <div class="row mb-1">
                                                                                                    <div class="col-md-12">
                                                                                                        <form wire:submit.prevent="uploadAttachment">
                                                                                                            <div class="btn-group " role="group" >
                                                                                                                <div style="display: inline; float:left;">
                                                                                                                    <input type="file" class="form-control-file" wire:model="attachment">
                                                                                                                </div>
                                                                                                                @error('attachment')
                                                                                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                                                                                @enderror
                                                                                                                <button class="btn btn-primary btn-mini" type="submit" style="display: inline; float:left;"> <i class="ti-upload mr-2"></i> Upload file</button>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="input-group">
                                                                                                    <textarea wire:model.debounce.90000ms="message" wire:keydown.enter="sendMessage" style="height: 60px; resize:none; outline:none;" class="form-control new-msg" placeholder="Type message here..."></textarea>
                                                                                                    <span class="input-group-addon bg-white" wire:click="sendMessage"><i class="icofont icofont-paper-plane f-18 text-primary"></i></span>
                                                                                                </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
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
