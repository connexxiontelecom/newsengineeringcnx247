
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-12 col-xl-12 ">
                    <div class="card app-design">
                        <div class="card-block">
                            <h5 class="f-w-400 text-muted mb-3 sub-title">{{ $group->group_name ?? '' }}</h5>

                            <img class="profile-bg-img img-fluid" src="/assets/images/workgroup/cover/{{$group->group_image ?? 'cnx247.jpg'}}" alt="bg-img">
                            <p class="text-muted">{!! $group->description !!}</p>
                            <div class="team-box p-b-20">
                                <p class="d-inline-block m-r-20 f-w-400 mr-2">
                                    Member(s) <label for="" class="label label-primary mr-2">{{count($group->member)}}</label> | Created
                                    <label for="" class="label label-danger">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($group->created_at))}}</label> |
                                    Moderator(s) <label for="" class="label label-primary mr-2">{{count($group->workgroupModerators)}}</label>
                                    <a href="" class="ml-5 float-right"><i class="ti-trash text-danger"></i></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card bg-white">
                        @livewire('backend.workgroup.shortcut')
                        <input type="hidden" name="workgroup" id="uniqueWorkgroupId" value="{{$group->id}}" wire:ignore>
                    </div>
                    @foreach ($posts as $post)
                        <div class="mt-2">
                            <div class="bg-white p-relative">
                                <div class="card-block">
                                    <div class="media">
                                        <div class="media-left media-middle friend-box">
                                            <a href="{{route('view-profile', $post->user->url)}}">
                                                <img class="media-object img-radius m-r-20" src="{{asset('/assets/images/avatars/thumbnails/'.$post->user->avatar ?? 'avatar.png')}}" alt="{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}}">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="chat-header">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} <label for="" class="label label-primary"> posted in </label> {{$group->group_name}}</div>
                                            <div class="f-13 text-muted">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($post->created_at))}} @ <small>{{date('h:ia', strtotime($post->created_at))}}</small> | <small>{{$post->created_at->diffForHumans()}}</small></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-block c-both">
                                    <div class="timeline-details">
                                        {!! $post->post_content ?? '' !!}
                                    </div>
                                </div>
                                <div class="card-block b-b-theme b-t-theme social-msg">
                                    @if(!empty($post->workgroupLikes()->where('user_id', Auth::user()->id)->first()))
                                        <a href="javascript:void(0);" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                            <span class="b-r-muted">Unlike ({{ count($post->workgroupLikes) }}) </span>
                                        </a>

                                    @elseif(empty($post->workgroupLikes()->where('user_id', Auth::user()->id)->first()))
                                        <a href="javascript:void(0);" wire:click="addLike({{$post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                            <span class="b-r-muted">Like ({{ count($post->workgroupLikes) }}) </span>
                                        </a>
                                    @endif
                                    <a href="javascript:void(0);">
                                        <i class="icofont icofont-comment text-muted"></i>
                                        <span class="b-r-theme">Comments ({{count($post->workgroupComments)}})</span>
                                    </a>
                                    <a href="javascript:void(0);">
                                        <i class="icofont icofont-share text-muted"></i>
                                        <span>Views (10)</span>
                                    </a>
                                </div>
                                <div class="card-block user-box">
                                    <div class="p-b-20">
                                        <span class="f-14">
                                            <a href="javascript:void(0);">Comments ({{count($post->workgroupComments)}})</a>
                                        </span>
                                    </div>
                                    @if (count($post->workgroupComments) > 0)
                                        @foreach ($post->workgroupComments as $comment)
                                            <div class="media">
                                                <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                    <img class="media-object img-radius m-r-20" src="{{asset('/assets/images/avatars/thumbnails/'.$comment->user->avatar ?? 'avatar.png')}}" alt="{{$comment->user->first_name ?? ''}} {{$comment->user->surname ?? ''}}">
                                                </a>
                                                <div class="media-body b-b-theme social-client-description">
                                                    <div class="chat-header">{{$comment->user->first_name ?? ''}} {{$comment->user->surname ?? ''}}
                                                        <span class="text-muted">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($comment->created_at))}} @ {{date('h:ia', strtotime($comment->created_at))}} <small class="badge badge-light">{{$comment->created_at->diffForHumans()}}</small></span>
                                                    </div>
                                                    <p class="text-muted">{!! $comment->comment !!}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-center">There're no comments for this post. Be the first to leave a comment...</p>
                                    @endif

                                    <div class="media">
                                        <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                            <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ Auth::user()->avatar ?? 'avatar.png' }}" alt="{{Auth::user()->first_name}}">
                                        </a>
                                        <div class="media-body">

                                            <div class="">
                                                <textarea wire:model.debounce.50000ms="comment" style="resize: none;" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                <div class="text-right m-t-20">
                                                    <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="fb-timeliner">
                        <h2 class="recent-highlight bg-warning">Invite Users
                            <button class="btn btn-mini btn-default float-right inviteUserClass" data-toggle="modal" id="{{$group->id}}" data-target="#inviteUser-Modal" style="margin-top:-5px;"> <i class="ti-plus"></i> New</button>
                        </h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="fb-timeliner">
                        <h2 class="recent-highlight bg-danger">Group Owner</h2>
                        <div class="card">
                            <div class="card-block p-t-10">
                                <div class="task-right">
                                        <div class="user-box assign-user taskboard-right-users">
                                            <div class="media">
                                                <div class="media-left media-middle photo-table">
                                                    <a href="{{route('view-profile', $group->workgroupOwner->url)}}">
                                                        <img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$group->workgroupOwner->avatar ?? 'avatar.png'}}" alt="{{$group->workgroupOwner->first_name ?? ''}} {{$group->workgroupOwner->surname ?? ''}}">
                                                        <div class="live-status bg-danger"></div>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <a href="{{route('view-profile', $group->workgroupOwner->url)}}">{{$group->workgroupOwner->first_name ?? ''}} {{$group->workgroupOwner->surname ?? ''}} <br> <label for="" class="label label-info">on</label> <small> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($group->created_at))}}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12" style="margin-top: -20px;">
                    <div class="fb-timeliner">
                        <h2 class="recent-highlight bg-info">Moderators </h2>
                        <div class="card">
                            <div class="card-block p-t-10">
                                <div class="task-right">
                                    @if (count($group->workgroupModerators ) > 0)
                                        @foreach ($group->workgroupModerators as $moderator)
                                        <div class="user-box assign-user taskboard-right-users">
                                            <div class="media">
                                                <div class="media-left media-middle photo-table">
                                                    <a href="/activity-stream/profile{{$moderator->user->url}}">
                                                        <img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$moderator->user->avatar ?? 'avatar.png'}}" alt="{{$moderator->user->first_name ?? ''}} {{$moderator->user->surname ?? ''}}">
                                                        <div class="live-status bg-danger"></div>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <a href="/activity-stream/profile{{$moderator->user->url}}">{{$moderator->user->first_name ?? ''}} {{$moderator->user->surname ?? ''}}</a>
                                                    @if ($group->owner == Auth::user()->id)
                                                        <span class="float-right remove-moderator" data-toggle="modal" data-target="#removeModerator-Modal" data-moderator="{{$moderator->user->first_name ?? ''}} {{$moderator->user->surname ?? ''}}"  id="{{$moderator->user->url}}" style="cursor: pointer;"> <i class="ti-close text-danger"></i> </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        @endforeach
                                    @else
                                        <div class="user-box assign-user taskboard-right-users">
                                            <p class="text-muted">There're no moderators for this group</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12" style="margin-top: -20px;">
                    <div class="fb-timeliner">
                        <h2 class="recent-highlight bg-info">Members</h2>
                        <div class="card">
                            <div class="card-block p-t-10">
                                <div class="task-right">
                                    @if (count($group->member ) > 0)
                                        @foreach ($group->member as $memb)
                                        <div class="user-box assign-user taskboard-right-users">
                                            <div class="media">
                                                <div class="media-left media-middle photo-table">
                                                    <a href="{{route('view-profile', $memb->user->url)}}">
                                                        <img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$memb->user->avatar ?? 'avatar.png'}}" alt="{{$memb->user->first_name ?? ''}} {{$memb->user->surname ?? ''}}">
                                                        <div class="live-status bg-danger"></div>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <a href="{{route('view-profile', $memb->user->url)}}">{{$memb->user->first_name ?? ''}} {{$memb->user->surname ?? ''}}</a>
                                                    @if ($group->owner == Auth::user()->id)
                                                        <span class="float-right remove-member" data-toggle="modal" data-target="#removeMember-Modal" data-user="{{$memb->user->first_name ?? ''}} {{$memb->user->surname ?? ''}}" id="{{$memb->user->url}}" style="cursor: pointer;"> <i class="ti-close text-danger"></i> </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        @endforeach
                                    @else
                                        <div class="user-box assign-user taskboard-right-users">
                                            <p class="text-muted">There're no members for this group</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('custom-script')
<script>
    $(document).ready(function(){
        //remove member
        $(document).on('click', '.remove-member', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            var user = $(this).data('user');
            $('#member-to-remove').text(user);
            $('#memberId').val(id);
        });
        $(document).on('click', '#removeMemberBtn', function(e){
            e.preventDefault();
            axios.post('/workgroup/remove-member', {url:$('#memberId').val()})
            .then(response=>{
                $.notify('Success! Member removed.', 'success');
                location.reload();
            });
        });
        //remove moderator
        $(document).on('click', '.remove-moderator', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            var moderator = $(this).data('moderator');
            $('#moderator-to-remove').text(moderator);
            $('#moderatorId').val(id);
        });
        $(document).on('click', '#removeModeratorBtn', function(e){
            e.preventDefault();
            axios.post('/workgroup/remove-moderator', {url:$('#moderatorId').val()})
            .then(response=>{
                $.notify('Success! Moderator removed.', 'success');
                location.reload();
            });
        });
        //remove invite
        $(document).on('click', '.inviteUserClass', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#groupId').val(id);
        });
        //send invitation [button]
        $(document).on('click', '#inviteEmployeeBtn', function(e){
            e.preventDefault();
            var groupId = $('#groupId').val();
            console.log(groupId);
             axios.post('/workgroup/send-invitation', {employee:$('#employeeId').val(), groupId: $('#groupId').val()})
            .then(response=>{
                $.notify(response.data.message, 'success');
                location.reload();
            });
        });
    });
</script>
@endpush
