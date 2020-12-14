<div class="card">
    <div class="card-block">
        <div class="row">
            <div class="col-md-12">
                <a href="{{url()->previous()}}" class="btn btn-mini mb-3 btn-secondary float-right"> <i class="ti-back-left mr-2"></i> Back</a>
            </div>
        </div>
        <div class="col-md-12">
            @switch($post->post_type)
                @case('message')
                @foreach ($post->responsiblePersons as $person)
                    @if ($person->user_id == Auth::user()->id || $post->user_id == Auth::user()->id || $person->user_id == 32)
                        <div class="social-timelines p-relative rollover" data-live="{{$post->id}}">
                            <div class="row timeline-right p-t-35">
                                <div class="col-2 col-sm-2 col-xl-1">
                                    <div class="social-timelines-left">
                                        <img class="img-radius timeline-icon" src="/assets/images/avatars/thumbnails/{{ $post->user->avatar ?? 'avatar.png' }}" alt="{{Auth::user()->first_name}}">
                                    </div>
                                </div>
                                <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                    <div class="card">

                                        <div class="card-block post-timelines">
                                            <div class="chat-header f-w-600">
                                                <a href="{{route('view-post-activity-stream', $post->post_url)}}">
                                                    <a href="{{route('view-profile', $post->user->url)}}">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}}</a> {<i class="zmdi zmdi-email text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Message"></i>} <i class="zmdi zmdi-long-arrow-right text-primary"></i>

                                                    @foreach($post->responsiblePersons as $res)
                                                    <a href="{{route('view-profile', $res->user->url)}}">
                                                        <small>{{ $res->user->first_name}} {{ $res->user->surname}}</small>,
                                                    </a>
                                                    @endforeach

                                                </a>

                                            </div>
                                            <div class="social-time text-muted">{{date('d F, Y', strtotime($post->created_at))}} | <small>{{$post->created_at->diffForHumans()}}</small></div>
                                        </div>
                                        <div class="card-block">

                                            <div class="timeline-details">
                                                <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                @foreach ($post->postAttachment as $attach)
                                                    @switch(pathinfo($attach->attachment, PATHINFO_EXTENSION))
                                                        @case('pptx')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                        @break
                                                        @case('xls')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                        @break
                                                        @case('xlsx')
                                                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                                <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                            </a>
                                                        @break
                                                        @case('pdf')
                                                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                                <img src="/assets/formats/pdf.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                            </a>
                                                        @break
                                                        @case('doc')
                                                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                                <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                            </a>
                                                        @break
                                                        @case('docx')
                                                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                                <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                            </a>
                                                        @break
                                                        @default
                                                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                                <img src="/assets/formats/file.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                            </a>
                                                        @break

                                                    @endswitch
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="card-block b-b-theme b-t-theme social-msg">

                                            @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                <a href="javascript:void(0);" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                    <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                </a>

                                            @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                <a href="javascript:void(0);" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                    <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                </a>
                                            @endif
                                            <a href="javascript:void(0);"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments  ({{ count($post->postComments) }})</span></a>
                                            <a href="javascript:void(0);" class="viewers dropdown-toggle" type="button" id="dropdown-{{$post->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="ti-eye text-muted"></i> <span>View ({{number_format(count($post->postViews))}})</span>
                                                <div class="dropdown-menu" style="width:300px!important;" aria-labelledby="dropdown-{{$post->id}}" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    @foreach ($post->postViews as $viewer)
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
                                                            <img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
                                                    @endforeach
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-block user-box">
                                            <div class="p-b-10"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>
                                            </div>
                                            @foreach($post->postComments as $comment)
                                                <div class="media m-b-2">
                                                    <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                        <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ $comment->user->avatar ?? 'avatar.png' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                    </a>
                                                    <div class="media-body b-b-muted social-client-description">
                                                        <div class="chat-header"><a href="{{ route('view-profile', $comment->user->url) }}">{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a> <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                        <p class="text-muted"> {!! $comment->comment !!} </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="media">
                                                <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                            <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ Auth::user()->avatar ?? 'avatar.png' }}" alt="Generic placeholder image">
                                        </a>
                                            <div class="media-body">

                                                <div class="">
                                                    <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                    <div class="text-right m-t-20">
                                                        <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                    </div>
                                                </div>

                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
                @endforeach
                    @break
                @case('task')
                @foreach ($post->responsiblePersons as $person)
                @if ($person->user_id == Auth::user()->id || $post->user_id == Auth::user()->id || $person->user_id == 32)
                    <div class="social-timelines p-relative rollover" data-live="{{$post->id}}">
                        <div class="row timeline-right p-t-35">
                            <div class="col-2 col-sm-2 col-xl-1">
                                <div class="social-timelines-left">
                                    <img class="img-radius timeline-icon" src="/assets/images/avatars/thumbnails/{{ $post->user->avatar ?? 'avatar.png' }}" alt="{{Auth::user()->first_name}}">
                                </div>
                            </div>
                            <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                <div class="card">

                                    <div class="card-block post-timelines">
                                        <div class="chat-header f-w-600">
                                                <a href="{{route('view-profile', $post->user->url)}}">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}}</a> {<i class="ti-check-box text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Task"></i>} <i class="zmdi zmdi-long-arrow-right text-primary"></i>

                                                @foreach($post->responsiblePersons as $res)
                                                        <a href="{{route('view-profile', $res->user->url)}}">
                                                            <small>{{ $res->user->first_name}} {{ $res->user->surname}}</small>,
                                                        </a>
                                                @endforeach
                                        </div>
                                        <div class="social-time text-muted">{{date('d F, Y', strtotime($post->created_at))}} | <small>{{$post->created_at->diffForHumans()}}</small></div>
                                    </div>
                                    <div class="card-block">

                                        <div class="timeline-details">
                                            <a href="{{route('view-post-activity-stream', $post->post_url)}}">
                                                <h5 class="sub-title">{{$post->post_title ?? '-'}}</h5>
                                            </a>
                                            <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                            @foreach ($post->postAttachment as $attach)
                                                @switch(pathinfo($attach->attachment, PATHINFO_EXTENSION))
                                                    @case('pptx')
                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                        <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                        {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                    </a>
                                                    @break
                                                    @case('xls')
                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                        <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                        {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                    </a>
                                                    @break
                                                    @case('xlsx')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break
                                                    @case('pdf')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/pdf.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break
                                                    @case('doc')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break
                                                    @case('docx')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break
                                                    @default
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/file.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break

                                                @endswitch
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-block b-b-theme b-t-theme social-msg">

                                        @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                            <a href="javascript:void(0);" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                            </a>

                                        @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                            <a href="javascript:void(0);" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                            </a>
                                        @endif
                                        <a href="javascript:void(0);"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments  ({{ count($post->postComments) }})</span></a>
                                        <a href="javascript:void(0);" class="viewers dropdown-toggle"  type="button" id="dropdown-{{$post->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="ti-eye text-muted"></i> <span>View ({{number_format(count($post->postViews))}})</span>
                                            <div class="dropdown-menu" aria-labelledby="dropdown-{{$post->id}}" style="width:300px!important;" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                @foreach ($post->postViews as $viewer)
                                                    <a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
                                                        <img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
                                                @endforeach
                                            </div>
                                        </a>
                                    </div>
                                    <div class="card-block user-box">
                                        <div class="p-b-10"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>
                                        </div>
                                        @foreach($post->postComments as $comment)
                                            <div class="media m-b-2">
                                                <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                    <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ $comment->user->avatar ?? 'avatar.png' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                </a>
                                                <div class="media-body b-b-muted social-client-description">
                                                    <div class="chat-header"><a href="{{ route('view-profile', $comment->user->url) }}">{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a> <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                    <p class="text-muted"> {!! $comment->comment !!} </p>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="media">
                                            <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                        <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ Auth::user()->avatar ?? 'avatar.png' }}" alt="Avatar">
                                    </a>
                                        <div class="media-body">

                                            <div class="">
                                                <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                <div class="text-right m-t-20">
                                                    <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                </div>
                                            </div>

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
            @endforeach
                    @break
                @case('event')
                    @foreach ($post->responsiblePersons as $res)
                        @if ($res->user_id == Auth::user()->id || $res->user_id == 32)

                            <div class="social-timelines p-relative rollover" data-live="{{$post->id}}">
                                <div class="row timeline-right p-t-35">
                                    <div class="col-2 col-sm-2 col-xl-1">
                                        <div class="social-timelines-left">
                                            <img class="img-radius timeline-icon" src="/assets/images/avatars/thumbnails/{{ $post->user->avatar ?? 'avatar.png' }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                        <div class="card">

                                            <div class="card-block post-timelines">
                                                <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>

                                                <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-calendar text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Event"></i>} <i class="zmdi zmdi-long-arrow-right text-primary"></i>

                                                    @foreach($post->responsiblePersons as $res)
                                                            <small>{{ $res->user->first_name}} {{ $res->user->surname}}</small>,
                                                    @endforeach

                                                </div>
                                                <div class="social-time text-muted">{{date('d F, Y', strtotime($post->created_at))}} | <small>{{ $post->created_at->diffForHumans()}}</small> </div>
                                            </div>
                                            <div class="card-block">

                                                <div class="timeline-details">
                                                    <a href="{{route('view-post-activity-stream', $post->post_url)}}">
                                                        <h5 class="sub-title">{{ $post->post_title ?? '' }}</h5>
                                                    </a>
                                                    <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                    <div>
                                                        <div class="btn-group">
                                                            <strong>Start Date: </strong><label for="" class="label label-primary">{{ date('d F, Y', strtotime($post->start_date)) ?? '' }}</label>
                                                            <strong>End Date: </strong><label for="" class="label label-danger">{{ date('d F, Y', strtotime($post->end_date)) ?? '' }}</label>
                                                        </div>
                                                    </div>
                                                    @foreach ($post->postAttachment as $attach)
                                                        <a href="{{$attach->attachment}}">{{ $post->post_title ?? 'Download attachment'}}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="card-block b-b-theme b-t-theme social-msg">
                                                @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                    <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                        <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                    </a>

                                                @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                    <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                        <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                    </a>
                                                @endif
                                                <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                                <a href="javascript:void(0);" class="viewers dropdown-toggle" type="button" id="dropdown-{{$post->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="ti-eye text-muted"></i> <span>View ({{number_format(count($post->postViews))}})</span>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown-{{$post->id}}" style="width:300px!important;" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                        @foreach ($post->postViews as $viewer)
                                                            <a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
                                                                <img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
                                                            @endforeach
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="card-block user-box">
                                                <div class="p-b-30"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>

                                                </div>

                                                @foreach($post->postComments as $comment)
                                                    <div class="media m-b-2">
                                                        <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                            <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ $comment->user->avatar ?? 'avatar.png' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                        </a>
                                                        <div class="media-body b-b-muted social-client-description">
                                                            <div class="chat-header"><a href="{{ route('view-profile', $comment->user->url) }}">{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a> <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                            <p class="text-muted"> {!! $comment->comment !!} </p>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="media">
                                                    <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                        <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/avatar.png" alt="Generic placeholder image">
                                                    </a>
                                                    <div class="media-body">

                                                        <div class="">
                                                            <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                            <div class="text-right m-t-20">
                                                                <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @break
                @case('announcement')
                    @foreach ($post->responsiblePersons as $res)
                        @if ($res->user_id == Auth::user()->id || $post->user_id == Auth::user()->id || $res->user_id == 32)
                            <div class="social-timelines p-relative rollover" data-live="{{$post->id}}">
                                <div class="row timeline-right p-t-35">
                                    <div class="col-2 col-sm-2 col-xl-1">
                                        <div class="social-timelines-left">
                                            <img class="img-radius timeline-icon" src="/assets/images/avatars/thumbnails/{{ $post->user->avatar ?? 'avatar.png' }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                        <div class="card">

                                            <div class="card-block post-timelines">
                                                <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>

                                                <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-blackboard text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Announcement"></i>} <i class="zmdi zmdi-long-arrow-right text-primary"></i>

                                                    @foreach($post->responsiblePersons as $res)
                                                            <small>{{ $res->user->first_name}} {{ $res->user->surname}}</small>,
                                                    @endforeach

                                                </div>
                                                <div class="social-time text-muted">{{date('d F, Y', strtotime($post->created_at))}} | <small>{{ $post->created_at->diffForHumans()}}</small> </div>
                                            </div>
                                            <div class="card-block">

                                                <div class="timeline-details">
                                                    <a href="{{route('view-post-activity-stream', $post->post_url)}}">
                                                        <h5 class="sub-title">{{ $post->post_title ?? '' }}</h5>
                                                    </a>
                                                    <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                    @foreach ($post->postAttachment as $attach)
                                                    @switch(pathinfo($attach->attachment, PATHINFO_EXTENSION))
                                                        @case('pptx')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                        @break
                                                        @case('xls')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                        @break
                                                        @case('xlsx')
                                                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                                <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                            </a>
                                                        @break
                                                        @case('pdf')
                                                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                                <img src="/assets/formats/pdf.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                            </a>
                                                        @break
                                                        @case('doc')
                                                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                                <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                            </a>
                                                        @break
                                                        @case('docx')
                                                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                                <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                            </a>
                                                        @break
                                                        @default
                                                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                                <img src="/assets/formats/file.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                            </a>
                                                        @break

                                                    @endswitch
                                                @endforeach
                                                </div>
                                            </div>
                                            <div class="card-block b-b-theme b-t-theme social-msg">
                                                @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                    <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                        <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                    </a>

                                                @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                    <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                        <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                    </a>
                                                @endif
                                                <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                                <a href="javascript:void(0);" class="viewers dropdown-toggle"  type="button" id="dropdown-{{$post->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="ti-eye text-muted"></i> <span>View ({{number_format(count($post->postViews))}})</span>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown-{{$post->id}}" style="width:300px!important;" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                        @foreach ($post->postViews as $viewer)
                                                            <a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
                                                                <img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
                                                            @endforeach
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="card-block user-box">
                                                <div class="p-b-30"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>

                                                </div>

                                                @foreach($post->postComments as $comment)
                                                    <div class="media m-b-2">
                                                        <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                            <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ $comment->user->avatar ?? 'avatar.png' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                        </a>
                                                        <div class="media-body b-b-muted social-client-description">
                                                            <div class="chat-header"><a href="{{ route('view-profile', $comment->user->url) }}">{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a> <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                            <p class="text-muted"> {!! $comment->comment !!} </p>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="media">
                                                    <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                        <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/avatar.png" alt="Generic placeholder image">
                                                    </a>
                                                    <div class="media-body">

                                                        <div class="">
                                                            <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                            <div class="text-right m-t-20">
                                                                <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                     @endforeach
                @break
                @case('file')
                    @foreach ($post->responsiblePersons as $res)
                    @if ($res->user_id == Auth::user()->id || $post->user_id == Auth::user()->id || $res->user_id == 32)
                        <div class="social-timelines p-relative rollover" data-live="{{$post->id}}">
                            <div class="row timeline-right p-t-35">
                                <div class="col-2 col-sm-2 col-xl-1">
                                    <div class="social-timelines-left">
                                        <img class="img-radius timeline-icon" src="/assets/images/avatars/thumbnails/{{ $post->user->avatar ?? 'avatar.png' }}" alt="">
                                    </div>
                                </div>
                                <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                    <div class="card">

                                        <div class="card-block post-timelines">
                                            <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>

                                            <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-file text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Attachment"></i>} <i class="zmdi zmdi-long-arrow-right text-primary"></i>

                                                @foreach($post->responsiblePersons as $res)
                                                        <small>{{ $res->user->first_name}} {{ $res->user->surname}}</small>,
                                                @endforeach

                                            </div>
                                            <div class="social-time text-muted">{{date('d F, Y', strtotime($post->created_at))}} | <small>{{ $post->created_at->diffForHumans()}}</small> </div>
                                        </div>
                                        <div class="card-block">

                                            <div class="timeline-details">
                                                <a href="{{route('view-post-activity-stream', $post->post_url)}}">
                                                    <h5 class="sub-title">{{ $post->post_title ?? '' }}</h5>
                                                </a>
                                                <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                @foreach ($post->postAttachment as $attach)
                                                @switch(pathinfo($attach->attachment, PATHINFO_EXTENSION))
                                                    @case('pptx')
                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                        <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                        {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                    </a>
                                                    @break
                                                    @case('xls')
                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                        <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                        {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                    </a>
                                                    @break
                                                    @case('xlsx')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break
                                                    @case('pdf')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/pdf.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break
                                                    @case('doc')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break
                                                    @case('docx')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break
                                                    @default
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/file.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break

                                                @endswitch
                                            @endforeach
                                            </div>
                                        </div>
                                        <div class="card-block b-b-theme b-t-theme social-msg">
                                            @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                    <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                </a>

                                            @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                    <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                </a>
                                            @endif
                                            <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                            <a href="javascript:void(0);" class="viewers dropdown-toggle" type="button" id="dropdown-{{$post->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="ti-eye text-muted"></i> <span>View ({{number_format(count($post->postViews))}})</span>
                                                <div class="dropdown-menu" aria-labelledby="dropdown-{{$post->id}}" style="width:300px!important;" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    @foreach ($post->postViews as $viewer)
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
                                                            <img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
                                                        @endforeach
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-block user-box">
                                            <div class="p-b-30"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>

                                            </div>

                                            @foreach($post->postComments as $comment)
                                                <div class="media m-b-2">
                                                    <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                        <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ $comment->user->avatar ?? 'avatar.png' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                    </a>
                                                    <div class="media-body b-b-muted social-client-description">
                                                        <div class="chat-header"><a href="{{ route('view-profile', $comment->user->url) }}">{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a> <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                        <p class="text-muted"> {!! $comment->comment !!} </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="media">
                                                <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                    <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/avatar.png" alt="Generic placeholder image">
                                                </a>
                                                <div class="media-body">

                                                    <div class="">
                                                        <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                        <div class="text-right m-t-20">
                                                            <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @break
                @case('appreciation')
                    @foreach ($post->responsiblePersons as $res)
                    @if ($res->user_id == Auth::user()->id || $post->user_id == Auth::user()->id || $res->user_id == 32)
                        <div class="social-timelines p-relative rollover" data-live="{{$post->id}}">
                            <div class="row timeline-right p-t-35">
                                <div class="col-2 col-sm-2 col-xl-1">
                                    <div class="social-timelines-left">
                                        <img class="img-radius timeline-icon" src="/assets/images/avatars/thumbnails/{{ $post->user->avatar ?? 'avatar.png' }}" alt="">
                                    </div>
                                </div>
                                <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                    <div class="card">

                                        <div class="card-block post-timelines">
                                            <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>

                                            <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-gift text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Appreciation"></i>}<i class="zmdi zmdi-long-arrow-right text-primary"></i>

                                                @foreach($post->responsiblePersons as $res)
                                                        <small>{{ $res->user->first_name}} {{ $res->user->surname}}</small>,
                                                @endforeach

                                            </div>
                                            <div class="social-time text-muted">{{date('d F, Y', strtotime($post->created_at))}} | <small>{{ $post->created_at->diffForHumans()}}</small> </div>
                                        </div>
                                        <div class="card-block">

                                            <div class="timeline-details">
                                                <a href="{{route('view-post-activity-stream', $post->post_url)}}">
                                                    <h5 class="sub-title">{{ $post->post_title ?? '' }}</h5>
                                                </a>
                                                <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                @foreach ($post->postAttachment as $attach)
                                                @switch(pathinfo($attach->attachment, PATHINFO_EXTENSION))
                                                    @case('pptx')
                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                        <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                        {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                    </a>
                                                    @break
                                                    @case('xls')
                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                        <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                        {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                    </a>
                                                    @break
                                                    @case('xlsx')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break
                                                    @case('pdf')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/pdf.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break
                                                    @case('doc')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break
                                                    @case('docx')
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break
                                                    @default
                                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                                            <img src="/assets/formats/file.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                                                        </a>
                                                    @break

                                                @endswitch
                                            @endforeach
                                            </div>
                                        </div>
                                        <div class="card-block b-b-theme b-t-theme social-msg">
                                            @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                    <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                </a>

                                            @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                    <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                </a>
                                            @endif
                                            <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                            <a href="javascript:void(0);" class="viewers dropdown-toggle" type="button" id="dropdown-{{$post->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="ti-eye text-muted"></i> <span>View ({{number_format(count($post->postViews))}})</span>
                                                <div class="dropdown-menu" aria-labelledby="dropdown-{{$post->id}}" style="width:300px!important;" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    @foreach ($post->postViews as $viewer)
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
                                                            <img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
                                                        @endforeach
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-block user-box">
                                            <div class="p-b-30"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>

                                            </div>

                                            @foreach($post->postComments as $comment)
                                                <div class="media m-b-2">
                                                    <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                        <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ $comment->user->avatar ?? 'avatar.png' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                    </a>
                                                    <div class="media-body b-b-muted social-client-description">
                                                        <div class="chat-header"><a href="{{ route('view-profile', $comment->user->url) }}">{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a> <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                        <p class="text-muted"> {!! $comment->comment !!} </p>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="media">
                                                <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                    <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/avatar.png" alt="Generic placeholder image">
                                                </a>
                                                <div class="media-body">

                                                    <div class="">
                                                        <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                        <div class="text-right m-t-20">
                                                            <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @break

                @default

            @endswitch
        </div>
    </div>
</div>
