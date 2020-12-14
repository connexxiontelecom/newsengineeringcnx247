@foreach ($conversations as $conversation)
    @if($conversation->from_id != Auth::user()->id)
        <div class="media chat-messages">
            <a class="media-left photo-table" href="#!">
                <img class="media-object img-radius img-radius m-t-5" src="/assets/images/avatars/thumbnails/{{$user->avatar ?? 'avatar.png'}}" alt="{{$user->first_name ?? ''}} {{$user->surname ?? ''}}">
            </a>
            <div class="media-body chat-menu-content">
                <div class="">
                    <p class="chat-cont">{{$conversation->message}}</p>
                </div>
            </div>
        </div>

    @else

        <div class="media chat-messages">
            <div class="media-body chat-menu-reply">
                <div class="">
                    <p class="chat-cont">{{$conversation->message}}</p>

                </div>
            </div>
            <div class="media-right photo-table">
                <a href="#!">
                    <img class="media-object img-radius img-radius m-t-5" src="/assets/images/avatars/thumbnails/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="{{Auth::user()->first_name ?? ''}}">
                </a>
            </div>
        </div>

    @endif

@endforeach
