<div class="media chat-inner-header">
    <a class="back_chatBox">
        <i class="feather icon-chevron-left"></i> {{$active_user->first_name ?? ''}} {{$active_user->surname ?? ''}}
    </a>
    <div class="float-right mr-4">
        @if(!empty($active_user->mobile))
            <button class="btn-mini btn btn-outline-success" data-toggle="modal" data-target="#call-screen"><i class="zmdi zmdi-phone"></i></button>
        @endif
        <button class="btn-mini btn btn-outline-danger"><i class="zmdi zmdi-videocam"></i></button>
    </div>
</div>
@foreach ($conversations as $conversation)
    @if($conversation->from_id != Auth::user()->id)
        <div class="media chat-messages">
            <a class="media-left photo-table" href="#!">
                <img class="media-object img-radius img-radius m-t-5" src="/assets/images/avatar-3.jpg" alt="Generic placeholder image">
            </a>
            <div class="media-body chat-menu-content">
                <div class="">
                    <p class="chat-cont">{{$conversation->message}}</p>
                    <p class="chat-time">{{$conversation->created_at->diffForHumans()}} <br>
                        <i><small>{{date('d F, Y', strtotime($conversation->created_at) )}}</small></i>
                    </p>
                </div>
            </div>
        </div>

    @else
        
        <div class="media chat-messages">
            <div class="media-body chat-menu-reply">
                <div class="">
                    <p class="chat-cont">{{$conversation->message}}</p>
                    <p class="chat-time">{{$conversation->created_at->diffForHumans()}}
                        <br>
                        <i><small>{{date('d F, Y', strtotime($conversation->created_at) )}}</small></i>
                    </p>
                </div>
            </div>
            <div class="media-right photo-table">
                <a href="#!">
                    <img class="media-object img-radius img-radius m-t-5" src="/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                </a>
            </div>
        </div>

    @endif 

@endforeach