<div>
	<div class="row mb-4">
			<div class="col-lg-9 col-md-9">

					<div class="col-sm-12">
							<div class="card">
									@include('backend.activity-stream.common._activity-stream-widget')
							</div>
					</div>
					<div class="tab-pane active" id="timeline">{{--  wire:poll.5000ms="getContent" --}}
									<div class="row">
											<div class="col-md-12 timeline-dot">
													@foreach($posts as $post)
															@if($post->post_type == 'message')
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
																																			{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="zmdi zmdi-email text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Message"></i>} <i class="zmdi zmdi-long-arrow-right text-primary"></i>

																																			@foreach($post->responsiblePersons as $res)
																																							<small>{{ $res->user->first_name}} {{ $res->user->surname}}</small>,
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
																																	<div class="dropdown-menu" aria-labelledby="dropdown-{{$post->id}}" style="width:300px!important;" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
																																			@foreach ($post->postViews()->orderBy('id', 'DESC')->take(10)->get() as $viewer)
																																					<a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
																																							<img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
																																					@endforeach
																																			<a class="dropdown-item waves-light waves-effect text-center" href="{{route('view-post-activity-stream', $post->post_url)}}">View all</a>
																																	</div>
																															</a>
																													</div>
																													<div class="card-block user-box">
																															<div class="p-b-10"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>
																															</div>
																															@foreach($post->postComments()->orderBy('id', 'DESC')->take(5)->get() as $comment)
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
																															@if (count($post->postComments) > 5 )
																																	<a href="{{route('view-post-activity-stream', $post->post_url)}}">
																																			<p class="text-center">+{{count($post->postComments) - 5}} others</p>
																																	</a>
																															@endif

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
																			@break
																	@endforeach
															@elseif($post->post_type == 'task')
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
																																			{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-check-box text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Task"></i>} <i class="zmdi zmdi-long-arrow-right text-primary"></i>

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
																																	<a href="{{route('view-task', $post->post_url)}}">
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
																															<a href="javascript:void(0);" class="viewers dropdown-toggle" type="button" id="dropdown-{{$post->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="ti-eye text-muted"></i> <span>View ({{number_format(count($post->postViews))}})</span>
																																	<div class="dropdown-menu" aria-labelledby="dropdown-{{$post->id}}" style="width:300px!important;" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
																																			@foreach ($post->postViews()->orderBy('id', 'DESC')->take(10)->get() as $viewer)
																																					<a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
																																							<img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
																																					@endforeach
																																			<a class="dropdown-item waves-light waves-effect text-center" href="{{route('view-post-activity-stream', $post->post_url)}}">View all</a>
																																	</div>
																															</a>
																													</div>
																													<div class="card-block user-box">
																															<div class="p-b-10"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>
																															</div>
																															@foreach($post->postComments()->orderBy('id', 'DESC')->take(5)->get() as $comment)
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
																															@if (count($post->postComments) > 5 )
																																	<a href="{{route('view-post-activity-stream', $post->post_url)}}">
																																			<p class="text-center">+{{count($post->postComments) - 5}} others</p>
																																	</a>
																															@endif

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
																			@break
																	@endforeach
															@elseif($post->post_type == 'event')
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
																																			<div class="row" style="overflow: hidden">
																																					<div class="col-md-12">
																																							{!! $post->post_content ?? '' !!}
																																					</div>
																																			</div>


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
																																					@foreach ($post->postViews()->orderBy('id', 'DESC')->take(10)->get() as $viewer)
																																							<a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
																																									<img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
																																							@endforeach
																																					<a class="dropdown-item waves-light waves-effect text-center" href="{{route('view-post-activity-stream', $post->post_url)}}">View all</a>
																																			</div>
																																	</a>
																															</div>
																															<div class="card-block user-box">
																																	<div class="p-b-30"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>

																																	</div>

																																	@foreach($post->postComments()->orderBy('id', 'DESC')->take(5)->get() as $comment)
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
																																	@if (count($post->postComments) > 5 )
																																			<a href="{{route('view-post-activity-stream', $post->post_url)}}">
																																					<p class="text-center">+{{count($post->postComments) - 5}} others</p>
																																			</a>
																																	@endif

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
																					@break
																			@endforeach
															@elseif($post->post_type == 'announcement')
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
																																			<a href="javascript:void(0);" class="viewers dropdown-toggle" type="button" id="dropdown-{{$post->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="ti-eye text-muted"></i> <span>View ({{number_format(count($post->postViews))}})</span>
																																					<div class="dropdown-menu" aria-labelledby="dropdown-{{$post->id}}" style="width:300px!important;" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
																																							@foreach ($post->postViews()->orderBy('id', 'DESC')->take(10)->get() as $viewer)
																																									<a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
																																											<img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
																																									@endforeach
																																							<a class="dropdown-item waves-light waves-effect text-center" href="{{route('view-post-activity-stream', $post->post_url)}}">View all</a>
																																					</div>
																																			</a>
																																	</div>
																																	<div class="card-block user-box">
																																			<div class="p-b-30"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>

																																			</div>

																																			@foreach($post->postComments()->orderBy('id', 'DESC')->take(5)->get() as $comment)
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
																																			@if (count($post->postComments) > 5 )
																																					<a href="{{route('view-post-activity-stream', $post->post_url)}}">
																																							<p class="text-center">+{{count($post->postComments) - 5}} others</p>
																																					</a>
																																			@endif

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
																							@break
																	 @endforeach
															@elseif($post->post_type == 'file')
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
																																			@foreach ($post->postViews()->orderBy('id', 'DESC')->take(10)->get() as $viewer)
																																					<a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
																																							<img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
																																					@endforeach
																																			<a class="dropdown-item waves-light waves-effect text-center" href="{{route('view-post-activity-stream', $post->post_url)}}">View all</a>
																																	</div>
																															</a>
																													</div>
																													<div class="card-block user-box">
																															<div class="p-b-30"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>

																															</div>

																															@foreach($post->postComments()->orderBy('id', 'DESC')->take(5)->get() as $comment)
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
																															@if (count($post->postComments) > 5 )
																																	<a href="{{route('view-post-activity-stream', $post->post_url)}}">
																																			<p class="text-center">+{{count($post->postComments) - 5}} others</p>
																																	</a>
																															@endif

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
																			@break
																	@endforeach
															@elseif($post->post_type == 'appreciation')
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
																																			@foreach ($post->postViews()->orderBy('id', 'DESC')->take(10)->get() as $viewer)
																																					<a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
																																							<img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
																																					@endforeach
																																			<a class="dropdown-item waves-light waves-effect text-center" href="{{route('view-post-activity-stream', $post->post_url)}}">View all</a>
																																	</div>
																															</a>
																													</div>
																													<div class="card-block user-box">
																															<div class="p-b-30"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>

																															</div>

																															@foreach($post->postComments()->orderBy('id', 'DESC')->take(5)->get() as $comment)
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
																															@if (count($post->postComments) > 5 )
																																	<a href="{{route('view-post-activity-stream', $post->post_url)}}">
																																			<p class="text-center">+{{count($post->postComments) - 5}} others</p>
																																	</a>
																															@endif

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
																			@break
																	@endforeach
															@elseif($post->post_type == 'project')
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

																															<div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-briefcase text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Project"></i>}<i class="zmdi zmdi-long-arrow-right text-primary"></i>

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
																																			@foreach ($post->postViews()->orderBy('id', 'DESC')->take(10)->get() as $viewer)
																																					<a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
																																							<img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
																																					@endforeach
																																			<a class="dropdown-item waves-light waves-effect text-center" href="{{route('view-post-activity-stream', $post->post_url)}}">View all</a>
																																	</div>
																															</a>
																													</div>
																													<div class="card-block user-box">
																															<div class="p-b-30"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>

																															</div>

																															@foreach($post->postComments()->orderBy('id', 'DESC')->take(5)->get() as $comment)
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
																															@if (count($post->postComments) > 5 )
																																	<a href="{{route('view-post-activity-stream', $post->post_url)}}">
																																			<p class="text-center">+{{count($post->postComments) - 5}} others</p>
																																	</a>
																															@endif

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
																			@break
																	@endforeach
															@elseif($post->post_type == 'expense-report')
																	@foreach ($post->responsiblePersons as $person)
																			@if($person->user_id == Auth::user()->id || $post->user_id == Auth::user()->id)
																					<div class="social-timelines p-relative  rollover" data-live="{{$post->id}}">
																							<div class="row timeline-right p-t-35">
																									<div class="col-2 col-sm-2 col-xl-1">
																											<div class="social-timelines-left">
																													<img class="img-radius timeline-icon" src="/assets/images/avatars/thumbnails/{{ $post->user->avatar ?? 'avatar.png' }}" alt="{{$post->user->first_name}}">
																											</div>
																									</div>
																									<div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
																											<div class="card">

																													<div class="card-block post-timelines">
																															<span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
																															<div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-wallet text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Expense Report"></i>} |

																																	<a href="{{route('view-workflow-task', $post->post_url)}}">{{$post->post_title ?? ''}}</a>

																															</div>
																															<div class="social-time text-muted">{{date(Auth::user()->dateFormat->format ?? 'd F, Y', strtotime($post->created_at))}} <small> about </small>{{$post->created_at->diffForHumans()}}</div>
																													</div>
																													<div class="card-block">

																															<div class="timeline-details">
																																	<strong>Expense Report</strong>
																																	<div class="row">
																																			<div class="card-block">
																																					<div class="team-box p-b-20">
																																							<div class="team-section d-inline-block">
																																									<a href="{{route('view-profile',$post->user->url)}}"><img src="/assets/images/avatars/thumbnails/{{$post->user->avatar ?? 'avatar.png'}}" style="border-radius: 50%; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="{{$post->user->first_name }} {{$post->user->surname ?? ''}} is the requester"></a>
																																							</div>
																																					</div>
																																			</div>
																																			@foreach ($post->responsiblePersons as $processor)
																																					<div class="card-block" style="padding:10px;">
																																							<div class="team-box p-b-10">
																																									<div class="team-section d-inline-block">
																																											@if($processor->status == 'in-progress')
																																													<i class="ti-timer mr-1 text-warning"></i>
																																											@elseif($processor->status == 'approved')
																																													<i class="ti-check-box mr-1 text-success"></i>
																																											@elseif($processor->status == 'declined')
																																													<i class="ti-na text-danger"></i>
																																											@endif
																																											<a href="javascript:void(0);"><img src="/assets/images/avatars/thumbnails/{{$processor->user->avatar ?? 'avatar.png'}}" style="border-radius: 50%; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="{{$processor->user->first_name }} {{$processor->user->surname ?? ''}} {{$processor->status}} request"></a>
																																											<i class="zmdi zmdi-long-arrow-right"></i>
																																									</div>
																																							</div>
																																					</div>
																																			@endforeach
																																			<div class="row">
																																					<div class="col-md-12 d-flex align-items-center bd-highlight mb-4 ">
																																							<div class="team-box p-b-10">
																																									<div class="team-section d-inline-block">
																																											@switch($post->post_status)
																																													@case('in-progress')
																																															<label for="" class="label label-warning special-badge">In-progress</label>
																																															@break
																																													@case('approved')
																																															<label for="" class="label label-success special-badge">Approved</label>
																																															@break
																																													@case('declined')
																																															<label for="" class="label label-danger special-badge">Declined</label>
																																															@break
																																													@default

																																											@endswitch
																																									</div>
																																							</div>

																																					</div>
																																			</div>
																																	</div>
																																	<p class="text-muted">{!! $post->post_content ?? '' !!}</p>
																																	<div class="row">
																																			<div class="col-md-12 d-flex justify-content-center">
																																					<div class="btn-group">
																																							@if($post->post_status == 'in-progress')
																																									@foreach($post->responsiblePersons as $app)

																																									@if($app->user_id == Auth::user()->id && $app->status == 'in-progress')
																																													<button class="btn btn-out-dashed btn-danger btn-square btn-mini" wire:click="declineRequest({{ $post->id }})"><i class="ti-na mr-2"></i> DECLINE</button>

																																													<button type="button" class="btn btn-success btn-out-dashed btn-square btn-mini approveBtn" wire:click="approveRequest({{ $post->id }})"> <i class="ti-check-box mr-2"></i>
																																															APPROVE
																																													</button>
																																											@elseif($app->user_id == Auth::user()->id && $app->status == 'decline')
																																													<i>You previously declined this request</i>
																																											@elseif($app->user_id == Auth::user()->id && $app->status == 'approve')
																																													<i>You previously approved this request</i>
																																											@endif
																																									@endforeach
																																							@endif
																																					</div>
																																			</div>
																																			@if (session()->has('done'))
																																					<div class="col-md-12">
																																							{!! session()->get('done') !!}
																																					</div>
																																			@endif
																																			@if ($actionStatus == 1 && $verificationPostId == $post->id)
																																			<div class="row mt-2">
																																					<div class="col-md-8 offset-md-2">
																																							<div class="card ml-4">
																																									<div class="card-block">
																																											<div class="col-sm-12">
																																													<h5 class="sub-title">Transaction Password</h5>
																																													@if (session()->has('error_code'))
																																															<div class="alert alert-warning background-warning" role="alert">
																																																	{!! session()->get('error_code') !!}
																																															</div>
																																													@endif

																																													<div class="form-group">
																																															@if (session()->has('success_code'))
																																																	<div class="alert alert-success background-success" role="alert">
																																																			{!! session()->get('success_code') !!}
																																																	</div>
																																															@endif
																																													<div class="input-group input-group-primary">
																																															<input type="password" class="form-control" wire:model.debounce.9900000ms="transactionPassword" placeholder="Transaction Password">
																																																	<span class="input-group-addon btn-mini" wire:click="verifyCode({{ $post->id }})">
																																																	<i class="ti-check mr-2"></i> Verify
																																																	</span>
																																													</div>
																																													@error('transactionPassword')
																																															<i class="text-danger mt-2">{{$message}}</i>
																																													@enderror
																																											</div>
																																									</div>

																																									</div>
																																							</div>
																																					</div>
																																			</div>
																																			@endif
																																	</div>
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
																																			@foreach ($post->postViews()->orderBy('id', 'DESC')->take(10)->get() as $viewer)
																																					<a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
																																							<img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
																																					@endforeach
																																			<a class="dropdown-item waves-light waves-effect text-center" href="{{route('view-post-activity-stream', $post->post_url)}}">View all</a>
																																	</div>
																															</a>
																													</div>
																													<div class="card-block user-box">
																															<div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>
																															</div>

																															@foreach($post->postComments as $comment)
																																	<div class="media m-b-20">
																																			<a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
																																					<img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ $comment->user->avatar ?? 'avatar.png' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
																																			</a>
																																			<div class="media-body b-b-muted social-client-description">
																																					<div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}">  {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a>  <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
																																					<p class="text-muted"> {!! $comment->comment !!} </p>
																																			</div>
																																	</div>
																															@endforeach

																															<div class="media">
																																	<a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
																																			<img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ Auth::user()->avatar ?? 'avatar.png' }}" alt="{{Auth::user()->first_name ?? ''}}">
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
																			@break
																	@endforeach
															@elseif($post->post_type == 'purchase-request')
																	@foreach ($post->responsiblePersons as $person)
																			@if($person->user_id == Auth::user()->id || $post->user_id == Auth::user()->id)
																					<div class="social-timelines p-relative  rollover" data-live="{{$post->id}}">
																							<div class="row timeline-right p-t-35">
																									<div class="col-2 col-sm-2 col-xl-1">
																											<div class="social-timelines-left">
																													<img class="img-radius timeline-icon" src="/assets/images/avatars/thumbnails/{{ $post->user->avatar ?? 'avatar.png' }}" alt="{{$post->user->first_name}}">
																											</div>
																									</div>
																									<div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
																											<div class="card">

																													<div class="card-block post-timelines">
																															<span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
																															<div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="icofont icofont-money-bag text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Purchase Request"></i>} |

																																	<a href="{{route('view-workflow-task', $post->post_url)}}">{{$post->post_title ?? ''}}</a>

																															</div>
																															<div class="social-time text-muted">{{date(Auth::user()->dateFormat->format ?? 'd F, Y', strtotime($post->created_at))}} <small> about </small>{{$post->created_at->diffForHumans()}}</div>
																													</div>
																													<div class="card-block">

																															<div class="timeline-details">
																																	<strong>Purchase Request</strong>
																																	<div class="row">
																																			<div class="card-block">
																																					<div class="team-box p-b-20">
																																							<div class="team-section d-inline-block">
																																									<a href="{{route('view-profile',$post->user->url)}}"><img src="/assets/images/avatars/thumbnails/{{$post->user->avatar ?? 'avatar.png'}}" style="border-radius: 50%; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="{{$post->user->first_name }} {{$post->user->surname ?? ''}} is the requester"></a>
																																							</div>
																																					</div>
																																			</div>
																																			@foreach ($post->responsiblePersons as $processor)
																																					<div class="card-block" style="padding:10px;">
																																							<div class="team-box p-b-10">
																																									<div class="team-section d-inline-block">
																																											@if($processor->status == 'in-progress')
																																													<i class="ti-timer mr-1 text-warning"></i>
																																											@elseif($processor->status == 'approved')
																																													<i class="ti-check-box mr-1 text-success"></i>
																																											@elseif($processor->status == 'declined')
																																													<i class="ti-na text-danger"></i>
																																											@endif
																																											<a href="javascript:void(0);"><img src="/assets/images/avatars/thumbnails/{{$processor->user->avatar ?? 'avatar.png'}}" style="border-radius: 50%; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="{{$processor->user->first_name }} {{$processor->user->surname ?? ''}} {{$processor->status}} request"></a>
																																											<i class="zmdi zmdi-long-arrow-right"></i>
																																									</div>
																																							</div>
																																					</div>
																																			@endforeach
																																			<div class="row">
																																					<div class="col-md-12 d-flex align-items-center bd-highlight mb-4 ">
																																							<div class="team-box p-b-10">
																																									<div class="team-section d-inline-block">
																																											@switch($post->post_status)
																																													@case('in-progress')
																																															<label for="" class="label label-warning special-badge">In-progress</label>
																																															@break
																																													@case('approved')
																																															<label for="" class="label label-success special-badge">Approved</label>
																																															@break
																																													@case('declined')
																																															<label for="" class="label label-danger special-badge">Declined</label>
																																															@break
																																													@default

																																											@endswitch
																																									</div>
																																							</div>

																																					</div>
																																			</div>
																																	</div>
																																	<p class="text-muted">{!! $post->post_content ?? '' !!}</p>
																																	<div class="row">
																																			<div class="col-md-12 d-flex justify-content-center">
																																					<div class="btn-group">
																																							@if($post->post_status == 'in-progress')
																																									@foreach($post->responsiblePersons as $app)

																																									@if($app->user_id == Auth::user()->id && $app->status == 'in-progress')
																																													<button class="btn btn-out-dashed btn-danger btn-square btn-mini" wire:click="declineRequest({{ $post->id }})"><i class="ti-na mr-2"></i> DECLINE</button>

																																													<button type="button" class="btn btn-success btn-out-dashed btn-square btn-mini approveBtn" wire:click="approveRequest({{ $post->id }})"> <i class="ti-check-box mr-2"></i>
																																															APPROVE
																																													</button>
																																											@elseif($app->user_id == Auth::user()->id && $app->status == 'decline')
																																													<i>You previously declined this request</i>
																																											@elseif($app->user_id == Auth::user()->id && $app->status == 'approve')
																																													<i>You previously approved this request</i>
																																											@endif
																																									@endforeach
																																							@endif
																																					</div>
																																			</div>
																																			@if (session()->has('done'))
																																					<div class="col-md-12">
																																							{!! session()->get('done') !!}
																																					</div>
																																			@endif
																																			@if ($actionStatus == 1 && $verificationPostId == $post->id)
																																			<div class="row mt-2">
																																					<div class="col-md-8 offset-md-2">
																																							<div class="card ml-4">
																																									<div class="card-block">
																																											<div class="col-sm-12">
																																													<h5 class="sub-title">Transaction Password</h5>
																																													@if (session()->has('error_code'))
																																															<div class="alert alert-warning background-warning" role="alert">
																																																	{!! session()->get('error_code') !!}
																																															</div>
																																													@endif

																																													<div class="form-group">
																																															@if (session()->has('success_code'))
																																																	<div class="alert alert-success background-success" role="alert">
																																																			{!! session()->get('success_code') !!}
																																																	</div>
																																															@endif
																																													<div class="input-group input-group-primary">
																																															<input type="password" class="form-control" wire:model.debounce.9900000ms="transactionPassword" placeholder="Transaction Password">
																																																	<span class="input-group-addon btn-mini" wire:click="verifyCode({{ $post->id }})">
																																																	<i class="ti-check mr-2"></i> Verify
																																																	</span>
																																													</div>
																																													@error('transactionPassword')
																																															<i class="text-danger mt-2">{{$message}}</i>
																																													@enderror
																																											</div>
																																									</div>

																																									</div>
																																							</div>
																																					</div>
																																			</div>
																																			@endif
																																	</div>
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
																																			@foreach ($post->postViews()->orderBy('id', 'DESC')->take(10)->get() as $viewer)
																																					<a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
																																							<img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
																																					@endforeach
																																			<a class="dropdown-item waves-light waves-effect text-center" href="{{route('view-post-activity-stream', $post->post_url)}}">View all</a>
																																	</div>
																															</a>
																													</div>
																													<div class="card-block user-box">
																															<div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>
																															</div>

																															@foreach($post->postComments as $comment)
																																	<div class="media m-b-20">
																																			<a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
																																					<img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ $comment->user->avatar ?? 'avatar.png' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
																																			</a>
																																			<div class="media-body b-b-muted social-client-description">
																																					<div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}">  {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a>  <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
																																					<p class="text-muted"> {!! $comment->comment !!} </p>
																																			</div>
																																	</div>
																															@endforeach

																															<div class="media">
																																	<a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
																																			<img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ Auth::user()->avatar ?? 'avatar.png' }}" alt="{{Auth::user()->first_name ?? ''}}">
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
																			@break
																	@endforeach
															@elseif($post->post_type == 'general-request')
																	@foreach ($post->responsiblePersons as $person)
																			@if($person->user_id == Auth::user()->id || $post->user_id == Auth::user()->id)
																					<div class="social-timelines p-relative  rollover" data-live="{{$post->id}}">
																							<div class="row timeline-right p-t-35">
																									<div class="col-2 col-sm-2 col-xl-1">
																											<div class="social-timelines-left">
																													<img class="img-radius timeline-icon" src="/assets/images/avatars/thumbnails/{{ $post->user->avatar ?? 'avatar.png' }}" alt="{{$post->user->first_name}}">
																											</div>
																									</div>
																									<div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
																											<div class="card">

																													<div class="card-block post-timelines">
																															<span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
																															<div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="icofont icofont-ui-wifi text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="General Request"></i>} |

																																	<a href="{{route('view-workflow-task', $post->post_url)}}">{{$post->post_title ?? ''}}</a>

																															</div>
																															<div class="social-time text-muted">{{date(Auth::user()->dateFormat->format ?? 'd F, Y', strtotime($post->created_at))}} <small> about </small>{{$post->created_at->diffForHumans()}}</div>
																													</div>
																													<div class="card-block">

																															<div class="timeline-details">
																																	<strong>General Request</strong>
																																	<div class="row">
																																			<div class="card-block">
																																					<div class="team-box p-b-20">
																																							<div class="team-section d-inline-block">
																																									<a href="{{route('view-profile',$post->user->url)}}"><img src="/assets/images/avatars/thumbnails/{{$post->user->avatar ?? 'avatar.png'}}" style="border-radius: 50%; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="{{$post->user->first_name }} {{$post->user->surname ?? ''}} is the requester"></a>
																																							</div>
																																					</div>
																																			</div>
																																			@foreach ($post->responsiblePersons as $processor)
																																					<div class="card-block" style="padding:10px;">
																																							<div class="team-box p-b-10">
																																									<div class="team-section d-inline-block">
																																											@if($processor->status == 'in-progress')
																																													<i class="ti-timer mr-1 text-warning"></i>
																																											@elseif($processor->status == 'approved')
																																													<i class="ti-check-box mr-1 text-success"></i>
																																											@elseif($processor->status == 'declined')
																																													<i class="ti-na text-danger"></i>
																																											@endif
																																											<a href="javascript:void(0);"><img src="/assets/images/avatars/thumbnails/{{$processor->user->avatar ?? 'avatar.png'}}" style="border-radius: 50%; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="{{$processor->user->first_name }} {{$processor->user->surname ?? ''}} {{$processor->status}} request"></a>
																																											<i class="zmdi zmdi-long-arrow-right"></i>
																																									</div>
																																							</div>
																																					</div>
																																			@endforeach
																																			<div class="row">
																																					<div class="col-md-12 d-flex align-items-center bd-highlight mb-4 ">
																																							<div class="team-box p-b-10">
																																									<div class="team-section d-inline-block">
																																											@switch($post->post_status)
																																													@case('in-progress')
																																															<label for="" class="label label-warning special-badge">In-progress</label>
																																															@break
																																													@case('approved')
																																															<label for="" class="label label-success special-badge">Approved</label>
																																															@break
																																													@case('declined')
																																															<label for="" class="label label-danger special-badge">Declined</label>
																																															@break
																																													@default

																																											@endswitch
																																									</div>
																																							</div>

																																					</div>
																																			</div>
																																	</div>
																																	<p class="text-muted">{!! $post->post_content ?? '' !!}</p>
																																	<div class="row">
																																			<div class="col-md-12 d-flex justify-content-center">
																																					<div class="btn-group">
																																							@if($post->post_status == 'in-progress')
																																									@foreach($post->responsiblePersons as $app)

																																									@if($app->user_id == Auth::user()->id && $app->status == 'in-progress')
																																													<button class="btn btn-out-dashed btn-danger btn-square btn-mini" wire:click="declineRequest({{ $post->id }})"><i class="ti-na mr-2"></i> DECLINE</button>

																																													<button type="button" class="btn btn-success btn-out-dashed btn-square btn-mini approveBtn" wire:click="approveRequest({{ $post->id }})"> <i class="ti-check-box mr-2"></i>
																																															APPROVE
																																													</button>
																																											@elseif($app->user_id == Auth::user()->id && $app->status == 'decline')
																																													<i>You previously declined this request</i>
																																											@elseif($app->user_id == Auth::user()->id && $app->status == 'approve')
																																													<i>You previously approved this request</i>
																																											@endif
																																									@endforeach
																																							@endif
																																					</div>
																																			</div>
																																			@if (session()->has('done'))
																																					<div class="col-md-12">
																																							{!! session()->get('done') !!}
																																					</div>
																																			@endif
																																			@if ($actionStatus == 1 && $verificationPostId == $post->id)
																																			<div class="row mt-2">
																																					<div class="col-md-8 offset-md-2">
																																							<div class="card ml-4">
																																									<div class="card-block">
																																											<div class="col-sm-12">
																																													<h5 class="sub-title">Transaction Password</h5>
																																													@if (session()->has('error_code'))
																																															<div class="alert alert-warning background-warning" role="alert">
																																																	{!! session()->get('error_code') !!}
																																															</div>
																																													@endif

																																													<div class="form-group">
																																															@if (session()->has('success_code'))
																																																	<div class="alert alert-success background-success" role="alert">
																																																			{!! session()->get('success_code') !!}
																																																	</div>
																																															@endif
																																													<div class="input-group input-group-primary">
																																															<input type="password" class="form-control" wire:model.debounce.9900000ms="transactionPassword" placeholder="Transaction Password">
																																																	<span class="input-group-addon btn-mini" wire:click="verifyCode({{ $post->id }})">
																																																	<i class="ti-check mr-2"></i> Verify
																																																	</span>
																																													</div>
																																													@error('transactionPassword')
																																															<i class="text-danger mt-2">{{$message}}</i>
																																													@enderror
																																											</div>
																																									</div>

																																									</div>
																																							</div>
																																					</div>
																																			</div>
																																			@endif
																																	</div>
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
																																			@foreach ($post->postViews()->orderBy('id', 'DESC')->take(10)->get() as $viewer)
																																					<a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
																																							<img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
																																					@endforeach
																																			<a class="dropdown-item waves-light waves-effect text-center" href="{{route('view-post-activity-stream', $post->post_url)}}">View all</a>
																																	</div>
																															</a>
																													</div>
																													<div class="card-block user-box">
																															<div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>
																															</div>

																															@foreach($post->postComments as $comment)
																																	<div class="media m-b-20">
																																			<a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
																																					<img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ $comment->user->avatar ?? 'avatar.png' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
																																			</a>
																																			<div class="media-body b-b-muted social-client-description">
																																					<div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}">  {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a>  <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
																																					<p class="text-muted"> {!! $comment->comment !!} </p>
																																			</div>
																																	</div>
																															@endforeach

																															<div class="media">
																																	<a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
																																			<img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ Auth::user()->avatar ?? 'avatar.png' }}" alt="{{Auth::user()->first_name ?? ''}}">
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
																			@break
																	@endforeach
															@elseif($post->post_type == 'business-trip')
																	@foreach ($post->responsiblePersons as $person)
																			@if($person->user_id == Auth::user()->id || $post->user_id == Auth::user()->id)
																					<div class="social-timelines p-relative  rollover" data-live="{{$post->id}}">
																							<div class="row timeline-right p-t-35">
																									<div class="col-2 col-sm-2 col-xl-1">
																											<div class="social-timelines-left">
																													<img class="img-radius timeline-icon" src="/assets/images/avatars/thumbnails/{{ $post->user->avatar ?? 'avatar.png' }}" alt="{{$post->user->first_name}}">
																											</div>
																									</div>
																									<div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
																											<div class="card">

																													<div class="card-block post-timelines">
																															<span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
																															<div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="icofont icofont-ui-flight text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Business Trip"></i>} |

																																	<a href="{{route('view-workflow-task', $post->post_url)}}">{{$post->post_title ?? ''}}</a>

																															</div>
																															<div class="social-time text-muted">{{date(Auth::user()->dateFormat->format ?? 'd F, Y', strtotime($post->created_at))}} <small> about </small>{{$post->created_at->diffForHumans()}}</div>
																													</div>
																													<div class="card-block">

																															<div class="timeline-details">
																																	<strong>Business Trip</strong>
																																	<div class="row">
																																			<div class="card-block">
																																					<div class="team-box p-b-20">
																																							<div class="team-section d-inline-block">
																																									<a href="{{route('view-profile',$post->user->url)}}"><img src="/assets/images/avatars/thumbnails/{{$post->user->avatar ?? 'avatar.png'}}" style="border-radius: 50%; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="{{$post->user->first_name }} {{$post->user->surname ?? ''}} is the requester"></a>
																																							</div>
																																					</div>
																																			</div>
																																			@foreach ($post->responsiblePersons as $processor)
																																					<div class="card-block" style="padding:10px;">
																																							<div class="team-box p-b-10">
																																									<div class="team-section d-inline-block">
																																											@if($processor->status == 'in-progress')
																																													<i class="ti-timer mr-1 text-warning"></i>
																																											@elseif($processor->status == 'approved')
																																													<i class="ti-check-box mr-1 text-success"></i>
																																											@elseif($processor->status == 'declined')
																																													<i class="ti-na text-danger"></i>
																																											@endif
																																											<a href="javascript:void(0);"><img src="/assets/images/avatars/thumbnails/{{$processor->user->avatar ?? 'avatar.png'}}" style="border-radius: 50%; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="{{$processor->user->first_name }} {{$processor->user->surname ?? ''}} {{$processor->status}} request"></a>
																																											<i class="zmdi zmdi-long-arrow-right"></i>
																																									</div>
																																							</div>
																																					</div>
																																			@endforeach
																																			<div class="row">
																																					<div class="col-md-12 d-flex align-items-center bd-highlight mb-4 ">
																																							<div class="team-box p-b-10">
																																									<div class="team-section d-inline-block">
																																											@switch($post->post_status)
																																													@case('in-progress')
																																															<label for="" class="label label-warning special-badge">In-progress</label>
																																															@break
																																													@case('approved')
																																															<label for="" class="label label-success special-badge">Approved</label>
																																															@break
																																													@case('declined')
																																															<label for="" class="label label-danger special-badge">Declined</label>
																																															@break
																																													@default

																																											@endswitch
																																									</div>
																																							</div>

																																					</div>
																																			</div>
																																	</div>
																																	<p class="text-muted">{!! $post->post_content ?? '' !!}</p>
																																	<div class="btn-group">
																																			<label for="" class="label label-primary">Start Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($post->start_date))}}</label>
																																			<label for="" class="label label-danger">End Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($post->end_date))}}</label>
																																	</div>
																																	<div class="row">
																																			<div class="col-md-12 d-flex justify-content-center">
																																					<div class="btn-group">
																																							@if($post->post_status == 'in-progress')
																																									@foreach($post->responsiblePersons as $app)

																																									@if($app->user_id == Auth::user()->id && $app->status == 'in-progress')
																																													<button class="btn btn-out-dashed btn-danger btn-square btn-mini" wire:click="declineRequest({{ $post->id }})"><i class="ti-na mr-2"></i> DECLINE</button>

																																													<button type="button" class="btn btn-success btn-out-dashed btn-square btn-mini approveBtn" wire:click="approveRequest({{ $post->id }})"> <i class="ti-check-box mr-2"></i>
																																															APPROVE
																																													</button>
																																											@elseif($app->user_id == Auth::user()->id && $app->status == 'decline')
																																													<i>You previously declined this request</i>
																																											@elseif($app->user_id == Auth::user()->id && $app->status == 'approve')
																																													<i>You previously approved this request</i>
																																											@endif
																																									@endforeach
																																							@endif
																																					</div>
																																			</div>
																																			@if (session()->has('done'))
																																					<div class="col-md-12">
																																							{!! session()->get('done') !!}
																																					</div>
																																			@endif
																																			@if ($actionStatus == 1 && $verificationPostId == $post->id)
																																			<div class="row mt-2">
																																					<div class="col-md-8 offset-md-2">
																																							<div class="card ml-4">
																																									<div class="card-block">
																																											<div class="col-sm-12">
																																													<h5 class="sub-title">Transaction Password</h5>
																																													@if (session()->has('error_code'))
																																															<div class="alert alert-warning background-warning" role="alert">
																																																	{!! session()->get('error_code') !!}
																																															</div>
																																													@endif

																																													<div class="form-group">
																																															@if (session()->has('success_code'))
																																																	<div class="alert alert-success background-success" role="alert">
																																																			{!! session()->get('success_code') !!}
																																																	</div>
																																															@endif
																																													<div class="input-group input-group-primary">
																																															<input type="password" class="form-control" wire:model.debounce.9900000ms="transactionPassword" placeholder="Transaction Password">
																																																	<span class="input-group-addon btn-mini" wire:click="verifyCode({{ $post->id }})">
																																																	<i class="ti-check mr-2"></i> Verify
																																																	</span>
																																													</div>
																																													@error('transactionPassword')
																																															<i class="text-danger mt-2">{{$message}}</i>
																																													@enderror
																																											</div>
																																									</div>

																																									</div>
																																							</div>
																																					</div>
																																			</div>
																																			@endif
																																	</div>
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
																																			@foreach ($post->postViews()->orderBy('id', 'DESC')->take(10)->get() as $viewer)
																																					<a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
																																							<img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
																																					@endforeach
																																			<a class="dropdown-item waves-light waves-effect text-center" href="{{route('view-post-activity-stream', $post->post_url)}}">View all</a>
																																	</div>
																															</a>
																													</div>
																													<div class="card-block user-box">
																															<div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>
																															</div>

																															@foreach($post->postComments as $comment)
																																	<div class="media m-b-20">
																																			<a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
																																					<img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ $comment->user->avatar ?? 'avatar.png' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
																																			</a>
																																			<div class="media-body b-b-muted social-client-description">
																																					<div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}">  {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a>  <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
																																					<p class="text-muted"> {!! $comment->comment !!} </p>
																																			</div>
																																	</div>
																															@endforeach

																															<div class="media">
																																	<a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
																																			<img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ Auth::user()->avatar ?? 'avatar.png' }}" alt="{{Auth::user()->first_name ?? ''}}">
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
																			@break
																	@endforeach
															@elseif($post->post_type == 'leave-request')
																	@foreach ($post->responsiblePersons as $person)
																			@if($person->user_id == Auth::user()->id || $post->user_id == Auth::user()->id)
																					<div class="social-timelines p-relative  rollover" data-live="{{$post->id}}">
																							<div class="row timeline-right p-t-35">
																									<div class="col-2 col-sm-2 col-xl-1">
																											<div class="social-timelines-left">
																													<img class="img-radius timeline-icon" src="/assets/images/avatars/thumbnails/{{ $post->user->avatar ?? 'avatar.png' }}" alt="{{$post->user->first_name}}">
																											</div>
																									</div>
																									<div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
																											<div class="card">

																													<div class="card-block post-timelines">
																															<span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
																															<div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="icofont icofont-travelling text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Leave Request"></i>} |

																																	<a href="{{route('view-workflow-task', $post->post_url)}}">{{$post->post_title ?? ''}}</a>

																															</div>
																															<div class="social-time text-muted">{{date(Auth::user()->dateFormat->format ?? 'd F, Y', strtotime($post->created_at))}} <small> about </small>{{$post->created_at->diffForHumans()}}</div>
																													</div>
																													<div class="card-block">

																															<div class="timeline-details">
																																	<strong>Leaeve Request</strong>
																																	<div class="row">
																																			<div class="card-block">
																																					<div class="team-box p-b-20">
																																							<div class="team-section d-inline-block">
																																									<a href="{{route('view-profile',$post->user->url)}}"><img src="/assets/images/avatars/thumbnails/{{$post->user->avatar ?? 'avatar.png'}}" style="border-radius: 50%; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="{{$post->user->first_name }} {{$post->user->surname ?? ''}} is the requester"></a>
																																							</div>
																																					</div>
																																			</div>
																																			@foreach ($post->responsiblePersons as $processor)
																																					<div class="card-block" style="padding:10px;">
																																							<div class="team-box p-b-10">
																																									<div class="team-section d-inline-block">
																																											@if($processor->status == 'in-progress')
																																													<i class="ti-timer mr-1 text-warning"></i>
																																											@elseif($processor->status == 'approved')
																																													<i class="ti-check-box mr-1 text-success"></i>
																																											@elseif($processor->status == 'declined')
																																													<i class="ti-na text-danger"></i>
																																											@endif
																																											<a href="javascript:void(0);"><img src="/assets/images/avatars/thumbnails/{{$processor->user->avatar ?? 'avatar.png'}}" style="border-radius: 50%; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="{{$processor->user->first_name }} {{$processor->user->surname ?? ''}} {{$processor->status}} request"></a>
																																											<i class="zmdi zmdi-long-arrow-right"></i>
																																									</div>
																																							</div>
																																					</div>
																																			@endforeach
																																			<div class="row">
																																					<div class="col-md-12 d-flex align-items-center bd-highlight mb-4 ">
																																							<div class="team-box p-b-10">
																																									<div class="team-section d-inline-block">
																																											@switch($post->post_status)
																																													@case('in-progress')
																																															<label for="" class="label label-warning special-badge">In-progress</label>
																																															@break
																																													@case('approved')
																																															<label for="" class="label label-success special-badge">Approved</label>
																																															@break
																																													@case('declined')
																																															<label for="" class="label label-danger special-badge">Declined</label>
																																															@break
																																													@default

																																											@endswitch
																																									</div>
																																							</div>

																																					</div>
																																			</div>
																																	</div>
																																	<p class="text-muted">{!! $post->post_content ?? '' !!}</p>
																																	<div class="btn-group">
																																			<label for="" class="label label-primary">Start Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($post->start_date))}}</label>
																																			<label for="" class="label label-danger">End Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($post->end_date))}}</label>
																																	</div>
																																	<div class="row">
																																			<div class="col-md-12 d-flex justify-content-center">
																																					<div class="btn-group">
																																							@if($post->post_status == 'in-progress')
																																									@foreach($post->responsiblePersons as $app)

																																									@if($app->user_id == Auth::user()->id && $app->status == 'in-progress')
																																													<button class="btn btn-out-dashed btn-danger btn-square btn-mini" wire:click="declineRequest({{ $post->id }})"><i class="ti-na mr-2"></i> DECLINE</button>

																																													<button type="button" class="btn btn-success btn-out-dashed btn-square btn-mini approveBtn" wire:click="approveRequest({{ $post->id }})"> <i class="ti-check-box mr-2"></i>
																																															APPROVE
																																													</button>
																																											@elseif($app->user_id == Auth::user()->id && $app->status == 'decline')
																																													<i>You previously declined this request</i>
																																											@elseif($app->user_id == Auth::user()->id && $app->status == 'approve')
																																													<i>You previously approved this request</i>
																																											@endif
																																									@endforeach
																																							@endif
																																					</div>
																																			</div>
																																			@if (session()->has('done'))
																																					<div class="col-md-12">
																																							{!! session()->get('done') !!}
																																					</div>
																																			@endif
																																			@if ($actionStatus == 1 && $verificationPostId == $post->id)
																																			<div class="row mt-2">
																																					<div class="col-md-8 offset-md-2">
																																							<div class="card ml-4">
																																									<div class="card-block">
																																											<div class="col-sm-12">
																																													<h5 class="sub-title">Transaction Password</h5>
																																													@if (session()->has('error_code'))
																																															<div class="alert alert-warning background-warning" role="alert">
																																																	{!! session()->get('error_code') !!}
																																															</div>
																																													@endif

																																													<div class="form-group">
																																															@if (session()->has('success_code'))
																																																	<div class="alert alert-success background-success" role="alert">
																																																			{!! session()->get('success_code') !!}
																																																	</div>
																																															@endif
																																													<div class="input-group input-group-primary">
																																															<input type="password" class="form-control" wire:model.debounce.9900000ms="transactionPassword" placeholder="Transaction Password">
																																																	<span class="input-group-addon btn-mini" wire:click="verifyCode({{ $post->id }})">
																																																	<i class="ti-check mr-2"></i> Verify
																																																	</span>
																																													</div>
																																													@error('transactionPassword')
																																															<i class="text-danger mt-2">{{$message}}</i>
																																													@enderror
																																											</div>
																																									</div>

																																									</div>
																																							</div>
																																					</div>
																																			</div>
																																			@endif
																																	</div>
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
																																			@foreach ($post->postViews()->orderBy('id', 'DESC')->take(10)->get() as $viewer)
																																					<a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
																																							<img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
																																					@endforeach
																																			<a class="dropdown-item waves-light waves-effect text-center" href="{{route('view-post-activity-stream', $post->post_url)}}">View all</a>
																																	</div>
																															</a>
																													</div>
																													<div class="card-block user-box">
																															<div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>
																															</div>

																															@foreach($post->postComments as $comment)
																																	<div class="media m-b-20">
																																			<a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
																																					<img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ $comment->user->avatar ?? 'avatar.png' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
																																			</a>
																																			<div class="media-body b-b-muted social-client-description">
																																					<div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}">  {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a>  <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
																																					<p class="text-muted"> {!! $comment->comment !!} </p>
																																			</div>
																																	</div>
																															@endforeach

																															<div class="media">
																																	<a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
																																			<img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ Auth::user()->avatar ?? 'avatar.png' }}" alt="{{Auth::user()->first_name ?? ''}}">
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
																			@break
																	@endforeach
															@elseif($post->post_type == 'memo')
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

																															<div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-clipboard text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Internal memo"></i>} <i class="zmdi zmdi-long-arrow-right text-primary"></i>

																																	@foreach($post->responsiblePersons as $res)
																																					<small>{{ $res->user->first_name}} {{ $res->user->surname}}</small>,
																																	@endforeach

																															</div>
																															<div class="social-time text-muted">{{date('d F, Y', strtotime($post->created_at))}} | <small>{{ $post->created_at->diffForHumans()}}</small> </div>
																													</div>
																													<div class="card-block">

																															<div class="timeline-details">
																																	<a href="{{route('view-internal-memo', $post->post_url)}}">
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
																																			@foreach ($post->postViews()->orderBy('id', 'DESC')->take(10)->get() as $viewer)
																																					<a class="dropdown-item waves-light waves-effect" href="{{route('view-profile', $viewer->user->url)}}">
																																							<img src="/assets/images/avatars/thumbnails/{{$viewer->user->avatar ?? 'avatar.png'}}" class="img-30 mr-2" alt="{{$viewer->user->first_name ?? ''}}"> {{$viewer->user->first_name ?? ''}} {{$viewer->user->surname ?? ''}}</a>
																																					@endforeach
																																			<a class="dropdown-item waves-light waves-effect text-center" href="{{route('view-post-activity-stream', $post->post_url)}}">View all</a>
																																	</div>
																															</a>
																													</div>
																													<div class="card-block user-box">
																															<div class="p-b-30"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>

																															</div>

																															@foreach($post->postComments()->orderBy('id', 'DESC')->take(5)->get() as $comment)
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
																															@if (count($post->postComments) > 5 )
																																	<a href="{{route('view-post-activity-stream', $post->post_url)}}">
																																			<p class="text-center">+{{count($post->postComments) - 5}} others</p>
																																	</a>
																															@endif

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
																			@break
																	@endforeach
															@endif
													@endforeach



											</div>
									</div>
					</div>
					<div class="row">
							<div class="col-md-12 col-lg-12 d-flex justify-content-center" style="cursor: pointer;">
									{{ $posts->links() }}
							</div>
					</div>
			</div>
			<div class="col-lg-3 col-md-3">
					<div class="row">
							<!--<div class="col-lg-12 col-md-12">
									<div class="fb-timeliner">
											<h2 class="recent-highlight bg-warning">Invite Users
													<button class="btn btn-mini btn-default float-right" data-toggle="modal" data-target="#inviteUserModal" style="margin-top:-5px;"> <i class="ti-plus"></i> New</button>
											</h2>
									</div>
							</div>-->

								 @foreach (Auth::user()->where('tenant_id', Auth::user()->tenant_id)->get() as $onlineUser)
											@if($onlineUser->isOnline())
													<input type="hidden" value="{{++$onlineCounter}}"/>
											@endif
									@endforeach
							<div class="col-lg-12 col-md-12">
									<div class="fb-timeliner">
											<h2 class="recent-highlight bg-secondary">Company Pulse
													@if (ceil(($onlineCounter/$workforce)*100) < 50)
															<label class="label label-danger float-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="Current company activity level">
																	{{ceil(($onlineCounter/$workforce)*100)}}% <i class="m-l-10 feather icon-arrow-down"></i>
															</label>
													@else
															<label class="label label-success float-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="Current company activity level">
																	{{ceil(($onlineCounter/$workforce)*100)}}% <i class="m-l-10 feather icon-arrow-up"></i>
															</label>
													@endif
											</h2>
									</div>
							</div>
							<div class="col-md-12 col-lg-12 col-sm-12">
									<div class="card">
											<div class="card-block">
													<label for="" class="label label-danger">Live</label>
													<div class="row">
															<div class="col-md-2 col-sm-2" style="margin-left: 0px; padding-left:0px;">
																	<div data-toggle="tooltip" data-placement="top" title="" data-original-title="Employees online" data-label="{{ceil(($onlineCounter/$workforce)*100)}}%" class="radial-bar radial-bar-{{ceil(($onlineCounter/$workforce)*100)}} radial-bar-sm"></div>
															</div>
															<div class="col-md-10 col-sm-12">
																	@foreach (Auth::user()->where('tenant_id', Auth::user()->tenant_id)->get() as $onlineUser)
																			@if($onlineUser->isOnline())
																					<a href="{{route('view-profile', $onlineUser->url)}}">
																							<img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$onlineUser->first_name ?? ''}} {{$onlineUser->surname ?? ''}}" src="/assets/images/avatars/thumbnails/{{$onlineUser->avatar ?? 'avatar.png'}}" class="img-30" style="border-radius: 50%;" alt="{{$onlineUser->first_name ?? ''}} {{$onlineUser->surname ?? ''}}">
																					</a>
																			@endif
																	@endforeach
															</div>
													</div>
											</div>
									</div>
							</div>

							<div class="col-lg-12 col-md-12">
									<div class="fb-timeliner">
											<h2 class="recent-highlight bg-danger">My Tasks</h2>
											<div class="card">
													<div class="card-block">
															<ul>
																	<li class="active"><a href="{{route('task-board')}}">On-going <label for="" class="badge badge-warning text-white float-right">{{number_format($ongoing)}}</label></a></li>
																	<li><a href="{{route('task-board')}}">Assisting <label for="" class="badge badge-secondary float-right">{{number_format($assisting)}}</label></a></li>
																	<li><a href="{{route('task-board')}}">Set by me <label for="" class="badge badge-primary float-right">{{number_format($set_by_me)}}</label></a></li>
																	<li><a href="{{route('task-board')}}">Following <label for="" class="badge badge-info float-right">3</label></a>  </li>
															</ul>
													</div>
											</div>
									</div>
							</div>
							<div class="col-lg-12 col-md-12">
									<div class="fb-timeliner">
											<h2 class="recent-highlight bg-info">Announcements</h2>
											<div class="card">
													<div class="card-block p-t-10">
															<div class="task-right">
																	@foreach ($announcements as $announce)
																			<div class="user-box assign-user taskboard-right-users">
																					<div class="media">
																							<div class="media-left media-middle photo-table">
																									<a href="{{route('view-profile', $announce->user->url)}}">
																											<img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$announce->user->avatar ?? 'avatar.png'}}" alt="{{$announce->user->first_name ?? ''}}">
																									</a>
																							</div>
																							<div class="media-body">
																									<a href="{{route('view-post-activity-stream', $announce->post_url)}}">{{ strlen($announce->post_title) > 35 ? substr($announce->post_title, 0, 35).'...' : $announce->post_title }}</a> <br>
																									- {{date('d F, Y', strtotime($announce->created_at) )}} | <small>{{ $announce->created_at->diffForHumans() }}</small>
																							</div>
																					</div>
																			</div>
																			<hr>
																	@endforeach
															</div>
													</div>
											</div>
									</div>
							</div>
							<div class="col-lg-12 col-md-12">
									<div class="fb-timeliner">
											<h2 class="recent-highlight bg-info">Up-coming Events</h2>
											<div class="card">
													<div class="card-block">
															@if (count($events) > 0)
															@foreach ($events as $event)
																	<div class="user-box assign-user taskboard-right-users">
																			<div class="media">
																					<div class="media-left media-middle photo-table">
																							<a href="{{route('view-profile', $event->user->url)}}">
																									<img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$event->user->avatar ?? 'avatar.png'}}" alt="{{$event->user->first_name ?? ''}} {{$event->user->surname ?? ''}}">
																							</a>
																					</div>
																					<div class="media-body">
																							<a href="{{route('view-post-activity-stream', $event->post_url)}}">{{$event->post_title ?? ''}}</a> <br>
																							- <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($event->created_at))}}</small> @ <small>{{date('h:ia', strtotime($event->created_at))}}</small>
																					</div>
																			</div>
																	</div>
																	<hr>
															@endforeach
															@else
																	<p class="text-center text-muted">There're no events</p>
															@endif

													</div>
											</div>
									</div>
							</div>
							<div class="col-lg-12 col-md-12">
									<div class="fb-timeliner">
											<h2 class="recent-highlight bg-info">Up-coming Birthday(s)</h2>
											<div class="card">
													<div class="card-block">
															@if (count($birthdays) > 0)
																	@foreach ($birthdays as $birthday)
																	@if (date('d-m') ==  date('d-m', strtotime($birthday->birth_date)))
																		<div class="user-box assign-user taskboard-right-users">
																				<div class="media">
																						<div class="media-left media-middle photo-table">
																								<a href="{{route('view-profile', $birthday->url)}}">
																										<img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$birthday->avatar ?? 'avatar.png'}}" alt="{{$birthday->first_name ?? ''}}">

																								</a>
																						</div>
																						<div class="media-body">
																								<a href="{{route('view-profile', $birthday->url)}}">{{$birthday->first_name ?? ''}} {{$birthday->surname ?? ''}}</a> <br>
																								- {{date('d M', strtotime($birthday->birth_date))}}</small>
																						</div>
																						<img src="/assets/images/gift.gif" width="50" height="50" alt="{{$birthday->first_name ?? ''}} {{$birthday->surname ?? ''}}">
																				</div>

																		</div>
																		<hr>
																	@else
																		<div class="user-box assign-user taskboard-right-users">
																				<div class="media">
																						<div class="media-left media-middle photo-table">
																								<a href="{{route('view-profile', $birthday->url)}}">
																										<img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$birthday->avatar ?? 'avatar.png'}}" alt="{{$birthday->first_name ?? ''}}">
																								</a>
																						</div>
																						<div class="media-body">
																								<a href="{{route('view-profile', $birthday->url)}}">{{$birthday->first_name ?? ''}} {{$birthday->surname ?? ''}}</a> <br>
																								- {{date('d M', strtotime($birthday->birth_date))}}</small>
																						</div>
																				</div>
																		</div>
																		<hr>

																	@endif
																	@endforeach
															@else
																	<p class="text-center text-muted">There're no birthdays</p>
															@endif

													</div>
											</div>
									</div>
							</div>
							<div class="col-lg-12 col-md-12">
									<div class="fb-timeliner">
											<h2 class="recent-highlight bg-info">Weather Forecast</h2>
											<div class="card">
													<div class="card-block">
															<script src="https://apps.elfsight.com/p/platform.js" defer></script>
															<div class="elfsight-app-c31d3dd9-2cb1-40b7-966b-0d1856b0b628"></div>
															<hr>

													</div>
											</div>
									</div>
							</div>
					</div>
			</div>
	</div>
</div>

@push('activity-stream-exception')
	<script src="/assets/js/cus/activity-stream-short-cut.js"></script>
@endpush
