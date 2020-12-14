<div>
<div id="sidebar" class="users p-chat-user showChat">
    <div class="had-container">
        <div class="card card_main p-fixed users-main">
            <div class="user-box">
                <div class="chat-inner-header">
                    <div class="back_chatBox">
                        <div class="right-icon-control">
                            <input
                                type="text"
                                class="form-control  search-text"
                                placeholder="Search Friend"
                                id="search-friends"
                            >
                            <div class="form-icon">
                                <i class="icofont icofont-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-friend-list">
                    @if (Auth::check())
                        @foreach($users as $user)
                            <div class="media userlist-box" data-id="{{ $user->id}}"
                                data-status="online"
                                data-username="{{$user->first_name}} {{$user->surname ?? ''}}"
                                data-toggle="tooltip"
                                data-placement="left"
                                title="{{$user->first_name}} {{$user->surname ?? ''}}"
                                >
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius img-radius" src="/assets/images/avatar-3.jpg" alt="{{$user->first_name}} {{$user->surname ?? ''}} ">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">{{$user->first_name}} {{$user->surname ?? ''}}</div>
                                </div>
                            </div>

                        @endforeach

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sidebar inner chat start-->
<div class="showChat_inner">
    <div id="load-conversation">


    </div>
    <div class="chat-reply-box p-b-20">
        <div class="right-icon-control">
            <textarea   class="form-control search-text" id="chat-message" placeholder="Type message here" style="resize: none;"></textarea>
            <div class="form-icon" id="sendChat">
                <i class="feather icon-navigation" style="cursor: pointer;"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="ml-2">
                    <i class="ti-image mr-4" title="Add photos" style="cursor: pointer;"></i>
                    <i class="ti-eye mr-4" title="Add emoji" style="cursor: pointer;"></i>
                    <i class="ti-clip mr-4" title="Add files" style="cursor: pointer;"></i>
                    <i class="ti-camera mr-4" title="Take a picture using your webcam" style="cursor: pointer;"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sidebar inner chat end-->
</div>
