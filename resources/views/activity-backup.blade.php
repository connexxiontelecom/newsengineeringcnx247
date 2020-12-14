@foreach ($posts as $post)

    <div class="col-md-12 grid-margin post-wrapper" data-hovered="{{in_array($post->id,$post_view_ids)?'true':'false'}}" data-id="{{$post->id}}" id="post-{{$post->id}}">
        <div class="card" style="border-radius:0px;">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img class="img-xs rounded-circle"
                             src="/assets/images/avatars/thumbnails/{{$post->user->avatar ?? 'avatar.png'}}" alt="">
                        <div class="ml-2">
                            <h5 class="text-muted">
                                 <a href="/employee-profile/{{ $post->user['url'] }}" class="text-primary">
                                     {{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} 
                                 </a>
                                 <small>posted in </small> <label class="badge badge-primary">{{ ucfirst($post->post_type) }}</label>
                                 <a href="{{ route('view-post', $post->post_url) }}" class="text-primary">
                                     {{$post->post_title ?? ''}}
                                </a>
                            </h5>
                            <p class="tx-11 text-muted">{{date('d M, Y | h:i:a', strtotime($post->created_at))}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="background: #FAFAEE; border:none;">
                <p class="mb-3 tx-14">{!! $post->post_content !!}</p>
            </div>
            <div class="card-footer">
                <div class="d-flex post-actions">
                    <a href="javascript:;" data-id="{{$post->id}}"
                       class="d-flex align-items-center text-muted mr-4 {{$post->likes()->where('user_id',auth()->user()->id)->first()?'trigger-unlike':'trigger-like'}}">
                        <i class="icon-md" data-feather="heart"></i>
                        <p class="d-none d-md-block ml-2">Like</p>
                    </a>
                    <a href="javascript:;" class="d-flex align-items-center text-muted mr-4 trigger-comment">
                        <i class="icon-md" data-feather="message-square"></i>
                        <p class="d-none d-md-block ml-2">Comment</p>
                    </a>
                    <div class="dropdown">
                        <a class="d-flex align-items-center text-muted mr-4"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-md" data-feather="eye"></i>
                            <p class="d-none d-md-block ml-2">{{$post->views()->count()}}</p>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($post->views as $view)
                            <a class="dropdown-item" href="{{ route('employee-profile', $view->user->url) }}">
                                <img class="img-xs rounded-circle"
                                     src="/assets/images/avatars/thumbnails/{{$view->user->avatar ?? 'avatar.png'}}"
                                     alt="">
                                <span style="padding: 0 5px">{{$view->user->first_name ?? '' }} {{$view->user->surname ?? ''}}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if($totalLikes= $post->likes()->count())
                    <div class="row mt-2">
                        Liked by <span style="padding: 0 5px" class="like-count">{{$totalLikes}}</span> {{$totalLikes>1?'peoples':'people'}}
                    </div>
                @endif
                <div class="row mt-2">
                    <div class="col-md-8 offset-md-0">
                        <div class="form-group comment-wrapper">
                            <style>
                                [contentEditable=true]:empty:not(:focus):before{
                                    content:attr(data-ph);
                                    color:grey;
                                    font-style:italic;
                                }
                            </style>
                           {{-- <input id="comment-input-{{$post->id}}" data-post-id="{{$post->id}}" type="text" placeholder="Leave comment"
                                   class="comment-content rounded-pill form-control">--}}
                            <span id="comment-input-{{$post->id}}" data-post-id="{{$post->id}}" type="text" data-ph="Leave comment" contentEditable="true" class="comment-content rounded-pill form-control"></span>
                            <div class="btn-group">
                               <div class="dropdown-menu " id="dropdown-user-{{$post->id}}">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary activity-comment" value="{{$post->id}}" type="button">
                                Comment
                            </button>
                        </div>
                    </div>
                </div>
                <div id="post-comment-{{$post->id}}" class="post-comments">
                    @foreach($post->comments as $comment)
                        <div class="row mt-1">
                            <div class="col-md-10 offset-md-1">
                                <div class="d-flex align-items-center mb-2">
                                    <img class="img-xs rounded-circle"
                                         src="/assets/images/avatars/thumbnails/{{$comment->user->avatar ?? 'avatar.png'}}"
                                         alt="">
                                    <div class="ml-2">
                                        <a href="/employee-profile/{{$comment->user['url']}}"><p>{{$comment->user->first_name ?? '' }} {{$comment->user->surname ?? ''}}</p> </a>
                                        <p class="tx-12 text-muted">{!! $comment->comment !!}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endforeach
