@extends('layouts.app')

@section('title')
    Chat-n-calls
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\message\message.css">

<style>
    .chat-menu-content .chat-cont, .chat-menu-reply .chat-cont{
        padding: 10px !important;
    }
    .messages-content .media{
        margin-bottom: 10px !important;
    }
    .chat-menu-reply{
        background: #70CF97 !important;
    }

</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12" style="font-family: Segoe UI; margin-top:-30px;">
        <div class="card">
            <div class="card-header" style="background: #EDEDED; padding-top:10px!important; padding-bottom:10px!important;">
                <div class="media">
                    <div class="media-body">
                       <div class="row">
                        <div class="col-md-3">
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
                        <div class="col-md-5 active-chat">
                            <div class="media contact-wrapper">
                                <div class="media-left media-middle photo-table">
                                    <a href="javascript:void(0)">
                                        <img class="media-object img-radius msg-img-h float-right img-30 " id="selected_user" src="/assets/images/avatars/medium/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="{{Auth::user()->first_name ?? ''}}">
                                    </a>
                                </div>
                                <div class="media-body" style="cursor: pointer;">
                                    <strong id="selected_name">{{Auth::user()->first_name ?? ''}} {{Auth::user()->surname ?? ''}}</strong>
                                    <i class="icofont icofont-phone text-danger ml-3 call" onclick="callSupport()" style="cursor: pointer;" id="selected_phone"   data-toggle="modal" data-target="#call-screen"></i>
                                    <p id="selected_position">{{Auth::user()->position ?? ''}}</p>
                                </div>
                            </div>
                        </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="card-block" style="background:url('/assets/images/chat-bg.png'); background-repeat: no-repeat; background-size:cover; border-bottom:1px solid #404E67;">
                <div class="row" style=" min-height:300px; max-height:auto;">
                    <div class="col-lg-3 col-md-4 message-left" style="background: #fff;">
                        <div class="card-block user-box contact-box assign-user scrollList" style="overflow-y: scroll; height:300px;">
                            <!--<div class="main-search morphsearch-search open">
                                <div class="input-group">
                                    <input type="text" class="form-control" style="width: 150px;">
                                    <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                </div>
                            </div>-->
                            @foreach ($users as $user)
                                <div class="media contact-wrapper employee" style="pointer:cursor !important;" data-name="{{$user->first_name ?? ''}} {{$user->surname ?? ''}}" data-user="{{$user->id ?? ''}}" data-telephone="{{$user->mobile ?? ''}}" data-position="{{$user->position ?? ''}}" data-avatar="{{$user->avatar ?? 'avatar.png'}}">
                                    <div class="media-left media-middle photo-table">
                                        <a href="javascript:void(0)">
                                            <img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$user->avatar ?? 'avatar.png'}}" alt="{{$user->first_name}} {{$user->surname ?? ''}}">
                                                <div class="live-status bg-success"></div>
                                        </a>
                                    </div>
                                    <div class="media-body" style="cursor: pointer;">
                                        <strong>{{$user->first_name}} {{$user->surname ?? ''}}</strong>@if($user->unread)<label class="badge badge-danger ml-1 badge-top-right">{{$user->unread}}</label>@endif
                                        <p>{{$user->position ?? substr($user->email, 0,15).'...'}}</p>
                                        <hr>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 messages-content " style="background:url('/assets/images/chat-bg.png'); background-repeat: no-repeat; background-size:cover; border-right:none!important;">
                        <div class="message-wrapper mb-4" style="overflow-y: scroll; height:300px;">

                        </div>

                        <div class="messages-send" style="position: absolute; bottom:0px; width:95%; background:none;">
                            <div class="form-group">
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="btn-group " role="group" >
                                            <div style="display: inline;">
                                                <button type="button" id="shareAttachment" class="btn btn-light btn-mini waves-effect waves-light">
                                                    <i class="icofont icofont-clip"></i></button>
                                                <input type="file" hidden id="chatAttachment">
                                            </div>
                                            <button type="button" class="btn btn-light btn-mini waves-effect waves-light"><i class="icofont icofont-emo-heart-eyes"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <textarea name="message"  style="height: 60px; resize:none; outline:none;" id="alighaddon2" class="form-control new-msg" placeholder="Share your thought..."></textarea>
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
@endsection

@section('dialog-section')
<div class="modal fade" id="call-screen" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" style="height: 400px; background:#110022; border-radius:5%!important;">
            <div class="modal-body">
                <div class="row d-flex justify-content-center" style="margin-top:100px;">
                    <div class="col-md-3">
                        <img style="border:1px solid #fff;" id="callUser" class="media-object img-radius msg-img-h float-right img-30" src="/assets/images/avatars/medium/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="{{Auth::user()->first_name ?? ''}}">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 text-center" style="letter-spacing: 2px;">
                        <h6 class="text-white mb-2">Calling</h6>
                        <h5 class="text-white mb-2" id="userName" >Name</h5>
                        <h6 class="text-white" id="mobileNo" >Mobile 070</h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 d-flex justify-content-center">
                        <button class="btn btn-danger btn-icon" onclick="callUser()"><i class="zmdi zmdi-phone-end"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script type="text/javascript" src="\assets\pages\message\message.js"></script>
<script type="text/javascript" src="\assets\js\cus\axios.min.js"></script>
<script type="text/javascript" src="\assets\js\cus\jquery.slimscroll.min.js"></script>
<script>
     var activeUser = "{{ Auth::user()->id }}";
    var receiver = null;
    $(document).ready(function(){
        $('.message-wrapper').slimscroll({
            height: '300px',
            width: '100%'
            });
        $('.scrollList').slimscroll({
            height: '410px',
        });
        if(receiver == null){
            $('.active-chat').hide();
            $('.messages-send').hide();
        }else{
            $('.active-chat').show();
            $('.messages-send').show();
        }
        // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
            var pusher = new Pusher('90d6dd6920c71f1d27c0', {
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

        $(document).on('click', '.call', function(e){
            e.preventDefault();
            //var audio = new Audio('/assets/sounds/s1.mp3');
               //     audio.play();
            var mobile = $(this).data('mobile');
            var user = $(this).data('user');
            $('#userName').text(user);
            $('#mobileNo').text(mobile);
          /*   axios.post('/conversation/call',{user:user, number:mobile})
            .then(response=>{
                console.log(response.data);
            }); */
        });

        $(document).on('click', '.employee', function(e){
            e.preventDefault();
            receiver = $(this).data('user');
            var name = $(this).data('name');
            var telephone = $(this).data('telephone');
            var position = $(this).data('position');
            $('#selected_user, #callUser').attr('src', '/assets/images/avatars/medium/'+$(this).data('avatar'));
            $('#selected_name').text(name);
            $('#userName').text(name);
            $('#selected_phone, #mobileNo').text(telephone);
            $('#selected_position').text(position);
            $('.active-chat').show();
            $('.messages-send').show();
            getMessages(receiver);
        });

        $(document).on('keyup', '.new-msg', function(e){
            e.preventDefault();
            var message = $(this).val();
                // check if enter key is pressed and message is not null also receiver is selected
                if (e.keyCode == 13 && message != '' && receiver != '') {
                $(this).val(''); // while pressed enter text box will be empty

                var datastr = "receiver=" + receiver + "&message=" + message;
                axios.post('/conversation/send',{receiver:receiver,message:message})
                .then(response=>{
                    getMessages(receiver);
                    scrollToBottomFunc();
                });

            }
        });

    });

    function callUser() {
        updateCallStatus("Calling support...");
        Twilio.Device.connect();
    }
    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }
    function getMessages(receiver) {
        axios.get('/conversation/'+receiver)
        .then(response=>{
            $('.message-wrapper').html(response.data);
            scrollToBottomFunc();
        });
    }
</script>
@endsection
