<div class="row">
    <div class="col-sm-12" style="font-family: Segoe UI; margin-top:-30px;">
        <div class="card">
            <div class="card-header" style="background: #EDEDED; padding-top:10px!important; padding-bottom:10px!important;">
                <div class="media">
                    <div class="media-body">
                       <div class="row">
                        <div class="col-md-5">
                            <div class="media contact-wrapper">
                                <div class="media-left media-middle photo-table">
                                    <a href="javascript:void(0)">
                                        <img class="media-object img-radius msg-img-h float-right img-30" src="/assets/images/avatars/medium/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="{{Auth::user()->first_name ?? ''}}">
                                    </a>
                                </div>
                                <div class="media-body" style="cursor: pointer;">
                                    <strong>{{Auth::user()->first_name ?? ''}} {{Auth::user()->surname ?? ''}}</strong>
                                    <p>{{Auth::user()->position ?? ''}}</p>
                                </div>
                            </div>
                        </div>
                        @if ($selectedUserId != null)
                            <div class="col-md-5">
                                <div class="media contact-wrapper">
                                    <div class="media-left media-middle photo-table">
                                        <a href="javascript:void(0)">
                                            <img class="media-object img-radius msg-img-h float-right img-30" src="/assets/images/avatars/medium/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="{{Auth::user()->first_name ?? ''}}">
                                        </a>
                                    </div>
                                    <div class="media-body" style="cursor: pointer;">
                                        <strong>{{$friend->first_name ?? ''}} </strong>   <i class="icofont icofont-phone text-danger ml-3 call" data-user="Gbudu Joseph" data-mobile="2348032404359"  data-toggle="modal" data-target="#call-screen"></i>
                                    </div>
                                </div>
                            </div>
                        @endif
                       </div>
                    </div>
                </div>
            </div>
            <div class="card-block" style="background:url('/assets/images/chat-bg.png'); background-repeat: no-repeat; background-size:cover; border-bottom:3px solid #52A94F;">
                <div class="row" style=" min-height:410px; max-height:auto;">
                    <div class="col-lg-3 col-md-4 message-left" style="background: #FFF;">
                        <div class="card-block user-box contact-box assign-user scrollList" style="overflow-y: scroll; height:470px;">
                            @foreach ($users as $user)
                                <div class="media contact-wrapper" wire:click="getConversation({{$user->id}})">
                                    <div class="media-left media-middle photo-table">
                                        <a href="javascript:void(0)">
                                            <img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$user->avatar ?? 'avatar.png'}}" alt="{{$user->first_name}} {{$user->surname ?? ''}}">
                                            @if ($user->isOnline())
                                                <div class="live-status bg-success"></div>
                                            @else
                                                <div class="live-status bg-danger"></div>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="media-body" style="cursor: pointer;">
                                        <strong>{{$user->first_name}} {{$user->surname ?? ''}}</strong>
                                        <p>{{$user->position ?? substr($user->email, 0,15).'...'}}</p>
                                        <hr>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 messages-content " style="background:url('/assets/images/chat-bg.png'); background-repeat: no-repeat; background-size:cover;">
                        <div style="overflow-y: scroll; height:390px;">
                            @if ($selectedUserId == null )
                                <p class="text-center text-muted" style="margin-top: 200px;">Kindly select a contact to start conversation...</p>
                            @else
                            <div wire:poll.5000ms="getConversation({{$selectedUserId}})">
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
                                            @elseif(!empty($message->message) )
                                                <p class="msg-reply bg-primary">{!! $message->message !!}</p>
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
                                                <a href="javascript:void(0);">
                                                    <img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$message->from_id->avatar ?? 'avatar.png'}}" alt="">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                @if (!empty($message->attachment))
                                                    <a href="/assets/uploads/attachments/{{$message->attachment}}">
                                                        <img src="/assets/formats/jpg.png" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="180" width="180">
                                                    </a>
                                                @elseif(!empty($message->message))
                                                    <p class="msg-send">
                                                        {!! $message->message  !!}
                                                    </p>
                                                @endif
                                                    <p><i class="icofont icofont-wall-clock f-12"></i> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($message->created_at))}} @ {{date('h:ia', strtotime($message->created_at))}}</p>
                                            </div>

                                        </div>
                                    @endif

                                @endforeach
                            </div>
                            @endif
                        </div>

                        <div class="messages-send" style="position: relative; bottom:0px; width:100%; margin-top:30px; background:none;">
                            <div class="form-group">

                                    <div class="row mb-1">
                                        <div class="col-md-12">
                                            <div class="btn-group " role="group" >
                                                <div wire:ignore style="display: inline;">
                                                    <button type="button" id="shareAttachment" class="btn btn-light btn-mini waves-effect waves-light">
                                                        <i class="icofont icofont-clip"></i></button>
                                                    <input type="file" hidden id="chatAttachment">
                                                </div>
                                                <button type="button" class="btn btn-light btn-mini waves-effect waves-light"><i class="icofont icofont-emo-heart-eyes"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <textarea name="message" id="message" style="height: 60px; resize:none; outline:none;" id="alighaddon2" class="form-control new-msg" placeholder="Share your thought..."></textarea>
                                        <span class="input-group-addon bg-white" id="sendMessage"><i class="icofont icofont-paper-plane f-18 text-primary"></i></span>
                                    </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@push('chat-calls-script')

<script>
    var activeUser = "{{ Auth::user()->id }}";
    var receiver = "{{ $selectedUserId }}";
    $(document).ready(function(){
        // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
            var pusher = new Pusher('4becc02b3fce153a2f45', {
            cluster: 'eu'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                if(activeUser == data.from){

                }else if(activeUser == data.to){
                    var audio = new Audio('/assets/sounds/s1.mp3');
                    audio.play();
                    if(receiver == data.from){

                    }else{

                    }
                }
            });
/*         var element = document.querySelectorAll('.slimScroll');
        var instance = new slimScroll(element, {
            'scrollList': 'scroll-wrapper unselectable mac',
            'scrollList': 'scrollBarContainer',
            'scrollList': 'animate',
            'scrollList': 'scroll'
        }); */
        $(document).on('click', '.call', function(e){
            e.preventDefault();
            var audio = new Audio('/assets/sounds/s1.mp3');
                    audio.play();
            var mobile = $(this).data('mobile');
            var user = $(this).data('user');
            $('#userName').text(user);
            $('#mobileNo').text(mobile);
        });

    });

    function callUser() {
        updateCallStatus("Calling support...");

        // Our backend will assume that no params means a call to support_agent
        Twilio.Device.connect();
    }

</script>
@endpush
