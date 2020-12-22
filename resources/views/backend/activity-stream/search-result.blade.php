@extends('layouts.app')

@section('title')
    Search Result
@endsection

@section('extra-styles')

@endsection

@section('content')
<div class="card">
	<div class="card-header">
		<h5>Search Result</h5>
		<span>Showing search result for search phrase <label for="" class="badge badge-danger"><strong>{{$search_phrase ?? ''}}</strong></label> </span>
	</div>
	<div class="card-block">

	</div>
</div>
<div class="tab-pane active" id="timeline">
			<div class="row">
					<div class="col-md-12 timeline-dot">
							@foreach($posts as $post)
									@if($post->post_type == 'message')
										@if ($post->user_id == Auth::user()->id)
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
																							<p class="text-muted">{!! strlen(strip_tags($post->post_content)) > 339 ? substr(strip_tags($post->post_content), 0,339).'...<a href='.route('view-post-activity-stream', $post->post_url).'>Read more</a>' : strip_tags($post->post_content) !!}</p>
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
																	</div>
															</div>
													</div>
											</div>
										@else
											@foreach ($post->responsiblePersons as $person)
													@if ($person->user_id == Auth::user()->id || $person->user_id == 32)
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
																										<p class="text-muted">{!! strlen(strip_tags($post->post_content)) > 339 ? substr(strip_tags($post->post_content), 0,339).'...<a href='.route('view-post-activity-stream', $post->post_url).'>Read more</a>' : strip_tags($post->post_content) !!}</p>
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
																					</div>
																			</div>
																	</div>
															</div>
													@endif
											@endforeach

										@endif
									@elseif($post->post_type == 'task')
											@if ($post->user_id == Auth::user()->id)
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
																							<p class="text-muted">{!! strlen(strip_tags($post->post_content)) > 339 ? substr(strip_tags($post->post_content), 0,339).'...<a href='.route('view-post-activity-stream', $post->post_url).'>Read more</a>' : strip_tags($post->post_content) !!}</p>
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
																	</div>
															</div>
													</div>
											</div>
											@else
											@foreach ($post->responsiblePersons as $person)
													@if ($person->user_id == Auth::user()->id || $person->user_id == 32)
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
																											<p class="text-muted">{!! strlen(strip_tags($post->post_content)) > 339 ? substr(strip_tags($post->post_content), 0,339).'...<a href='.route('view-post-activity-stream', $post->post_url).'>Read more</a>' : strip_tags($post->post_content) !!}</p>
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
																					</div>
																			</div>
																	</div>
															</div>

													@endif

											@endforeach

											@endif
									@elseif($post->post_type == 'event')
													@if($post->user_id == Auth::user()->id)
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
																											<p class="text-muted">{!! strlen(strip_tags($post->post_content)) > 339 ? substr(strip_tags($post->post_content), 0,339).'...<a href='.route('view-post-activity-stream', $post->post_url).'>Read more</a>' : strip_tags($post->post_content) !!}</p>
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
																		</div>
																</div>
														</div>
												</div>
													@else
														@foreach ($post->responsiblePersons as $res)
																@if ($res->user_id == Auth::user()->id  || $res->user_id == 32)
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
																								</div>
																						</div>
																				</div>
																		</div>
																@endif
														@endforeach

													@endif

									@elseif($post->post_type == 'announcement')
												@if ($post->user_id == Auth::user()->id )
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
																							<p class="text-muted">{!! strlen(strip_tags($post->post_content)) > 339 ? substr(strip_tags($post->post_content), 0,339).'...<a href='.route('view-post-activity-stream', $post->post_url).'>Read more</a>' : strip_tags($post->post_content) !!}</p>
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
																	</div>
															</div>
													</div>
											</div>
												@else
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
																													<p class="text-muted">{!! strlen(strip_tags($post->post_content)) > 339 ? substr(strip_tags($post->post_content), 0,339).'...<a href='.route('view-post-activity-stream', $post->post_url).'>Read more</a>' : strip_tags($post->post_content) !!}</p>
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
																							</div>
																					</div>
																			</div>
																	</div>
															@endif
													@endforeach
												@endif
									@elseif($post->post_type == 'file')
											@if ($post->user_id == Auth::user()->id)
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
																</div>
														</div>
												</div>
										</div>
											@else
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
																						</div>
																				</div>
																		</div>
																</div>
														@endif
												@endforeach

											@endif
									@elseif($post->post_type == 'appreciation')
											@if ($post->user_id == Auth::user()->id)
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
																</div>
														</div>
												</div>
										</div>
											@else
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
																						</div>
																				</div>
																		</div>
																</div>
														@endif
												@endforeach

											@endif
									@elseif($post->post_type == 'project')
											@if ($post->user_id == Auth::user()->id)
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
																</div>
														</div>
												</div>
										</div>
											@else
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
																						</div>
																				</div>
																		</div>
																</div>
														@endif
												@endforeach

											@endif
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
																											<p class="text-muted">{!! strlen(strip_tags($post->post_content)) > 339 ? substr(strip_tags($post->post_content), 0,339).'...<a href='.route('view-post-activity-stream', $post->post_url).'>Read more</a>' : strip_tags($post->post_content) !!}</p>

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
																											<p class="text-muted">{!! strlen(strip_tags($post->post_content)) > 339 ? substr(strip_tags($post->post_content), 0,339).'...<a href='.route('view-post-activity-stream', $post->post_url).'>Read more</a>' : strip_tags($post->post_content) !!}</p>

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
																											<p class="text-muted">{!! strlen(strip_tags($post->post_content)) > 339 ? substr(strip_tags($post->post_content), 0,339).'...<a href='.route('view-post-activity-stream', $post->post_url).'>Read more</a>' : strip_tags($post->post_content) !!}</p>

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
																											<p class="text-muted">{!! strlen(strip_tags($post->post_content)) > 339 ? substr(strip_tags($post->post_content), 0,339).'...<a href='.route('view-post-activity-stream', $post->post_url).'>Read more</a>' : strip_tags($post->post_content) !!}</p>
																											<div class="btn-group">
																													<label for="" class="label label-primary">Start Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($post->start_date))}}</label>
																													<label for="" class="label label-danger">End Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($post->end_date))}}</label>
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
																											<p class="text-muted">{!! strlen(strip_tags($post->post_content)) > 339 ? substr(strip_tags($post->post_content), 0,339).'...<a href='.route('view-post-activity-stream', $post->post_url).'>Read more</a>' : strip_tags($post->post_content) !!}</p>
																											<div class="btn-group">
																													<label for="" class="label label-primary">Start Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($post->start_date))}}</label>
																													<label for="" class="label label-danger">End Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($post->end_date))}}</label>
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
											@if ($post->user_id == Auth::user()->id)
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
																						<p class="text-muted">{!! strlen(strip_tags($post->post_content)) > 339 ? substr(strip_tags($post->post_content), 0,339).'...<a href='.route('view-post-activity-stream', $post->post_url).'>Read more</a>' : strip_tags($post->post_content) !!}</p>
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
																</div>
														</div>
												</div>
										</div>
											@else
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
																												<p class="text-muted">{!! strlen(strip_tags($post->post_content)) > 339 ? substr(strip_tags($post->post_content), 0,339).'...<a href='.route('view-post-activity-stream', $post->post_url).'>Read more</a>' : strip_tags($post->post_content) !!}</p>
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
																						</div>
																				</div>
																		</div>
																</div>
														@endif
												@endforeach

											@endif
									@endif
							@endforeach



					</div>
			</div>
</div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')


@endsection
