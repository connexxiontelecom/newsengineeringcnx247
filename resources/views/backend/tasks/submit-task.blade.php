@extends('layouts.app')

@section('title')
    Submit Task
@endsection

@section('extra-styles')
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('livewire.backend.task.common._task-slab')
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <div class="sub-title">Submit Task</div>
                <div class="tab-content card-block">
                    <div class="tab-pane active" id="expenseReportTab" role="tabpanel">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                   <div class="card-block">
                                       <h5 class="sub-title">{{$task->post_title ?? ''}}</h5>
                                       @if(session()->has('success'))
                                           <div class="alert alert-success background-success" style="padding:5px;">
                                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                   <i class="icofont icofont-close-line-circled"></i>
                                               </button>
                                               {!! session('success') !!}
                                           </div>
                                       @endif

                                   <form action="{{route('submit-assigned-task')}}" method="post" enctype="multipart/form-data">
                                       @csrf
                                       <div class="form-group">
                                           <div class="btn-group">
                                               <label for="" class="label label-primary">Start Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->start_date))}}</label>
                                               <label for="" class="label label-danger">End Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->end_date))}}</label>
                                               <span>
                                                   <label for="" class="label label-warning">Assigned By:</label>
                                                   <span class="mytooltip tooltip-effect-4">
                                                   <span class="tooltip-item">
                                                       <a href="{{route('view-profile', $task->user->url)}}">
                                                           {{$task->user->first_name ?? ''}} {{$task->user->surname ?? ''}}</span>

                                                       </a>
                                                       <span class="tooltip-content clearfix">
                                                           <img src="/assets/images/avatars/thumbnails/{{$task->user->avatar ?? 'avatar.png'}}" alt="{{$task->user->first_name ?? ''}} {{$task->user->surname ?? ''}}">
                                                           <span class="tooltip-text">{{$task->user->position ?? ''}}</span>
                                                       </span>
                                                   </span>
                                               </span>

                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label class="">Leave Note</label>
                                           <textarea name="leave_note" class="form-control form-control-normal content col-md-10" placeholder="Leave note...">{{old('leave_note')}}</textarea>
                                           @error('leave_note')
                                               <span class="mt-3">
                                                   <i class="text-danger">{{ $message }}</i>
                                                </span>
                                            @enderror
                                                <input type="hidden" name="post" value="{{$task->id}}">
                                       </div>
                                       <div class="form-group">
                                           <label class="">Attachment <br> <i>(Optional)</i></label>
                                           <div  class="col-sm-10 col-md-2">
                                               <input type="file" id="attachment" name="attachment">
                                               <input type="hidden" name="owner" value="{{$task->user_id}}">
                                               <input type="hidden" name="type" value="{{$task->post_type}}">
                                           </div>
                                       </div>
                                       <div class=" row m-t-30 d-flex justify-content-center">
                                           <div class="col-sm-10 col-md-12">
                                               <div class="btn-group d-flex justify-content-center">
                                                   <button class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</button>
                                                   <button class="btn btn-primary btn-mini"  type="submit"><i class="ti-check mr-2"></i>Submit</button>
                                               </div>
                                           </div>
                                       </div>
                                   </form>
                               </div>
                               </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-block">
                                        <h5 class="sub-title">Other Details</h5>

                                    </div>
                                </div>
                                <div class="card card-border-primary" style="margin-top:-30px;">
                                    <div class="card-header">
                                        <h5 class="card-header-text">
                                            <i class="icofont icofont-users-alt-4"></i> Observers(s)
                                        </h5>
                                    </div>
                                    <div class="card-block user-box assign-user">
                                        @if(count($task->postObservers) > 0)
                                            @foreach($task->postObservers as $part)
                                                <div class="media">
                                                    <div class="media-left media-middle photo-table">
                                                        <a href="{{ route('view-profile', $part->user->url) }}">
                                                            <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$part->user->first_name}} {{$part->user->surname ?? ''}}" class="img-radius" src="/assets/images/avatars/thumbnails/{{ $part->user->avatar ?? '/assets/images/avatar-3.jpg' }}" alt="chat-user">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6><a href="{{ route('view-profile', $part->user->url) }}">{{$part->user->first_name }}  {{ $part->user->surname ?? '' }}</a></h6>
                                                        <p>{{$part->user->position ?? '-' }}</p>
                                                    </div>
                                                    <div>
                                                        <a href="#!" class="text-muted">
                                                            <i class="icon-options-vertical"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach

                                        @else
                                                <p class="">There're no participants for this task</p>

                                        @endif

                                    </div>
                                </div>
                                       <div class="card card-border-info" style="margin-top:-30px;">
                                        <div class="card-header">
                                            <h5 class="card-header-text">
                                                <i class="icofont icofont-users-alt-4"></i> Responsible Person(s)
                                            </h5>
                                        </div>
                                        <div class="card-block user-box assign-user">
                                            @foreach($task->responsiblePersons as $person)
                                                <div class="media">
                                                    <div class="media-left media-middle photo-table">
                                                        <a href="{{ route('view-profile', $person->user->url) }}">
                                                            <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$person->user->first_name}} {{$person->user->surname ?? ''}}" class="img-radius" src="/assets/images/avatars/thumbnails/{{ $person->user->avatar ?? '/assets/images/avatar-3.jpg' }}" alt="chat-user">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6><a href="{{ route('view-profile', $person->user->url) }}">{{$person->user->first_name }}  {{ $person->user->surname ?? '' }}</a></h6>
                                                        <p>{{$person->user->position ?? '-' }}</p>
                                                    </div>
                                                    <div>
                                                        @if ($person->user_id == Auth::user()->id)
                                                            <div class="dropdown-secondary dropdown d-inline-block">
                                                                <button
                                                                    class="btn btn-sm btn-light dropdown-toggle waves-light"
                                                                    type="button"
                                                                    id="dropdown3"
                                                                    data-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                >
                                                                    <i class="icofont icofont-navigation-menu"></i>
                                                                </button>
                                                                <div
                                                                    class="dropdown-menu"
                                                                    aria-labelledby="dropdown3"
                                                                    data-dropdown-in="fadeIn"
                                                                    data-dropdown-out="fadeOut"
                                                                >
                                                                    <a  class="dropdown-item waves-light waves-effect" href="{{route('submit-task', $task->post_url)}}">
                                                                        <i class="icofont icofont-paper-plane m-r-10"></i>Submit Task
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card card-border-warning" style="margin-top:-30px;">
                                        <div class="card-header">
                                            <h5 class="card-header-text">
                                                <i class="icofont icofont-users-alt-4"></i> Participant(s)
                                            </h5>
                                        </div>
                                        <div class="card-block user-box assign-user">
                                            @if(count($task->postParticipants) > 0)
                                                @foreach($task->postParticipants as $part)
                                                    <div class="media">
                                                        <div class="media-left media-middle photo-table">
                                                            <a href="{{ route('view-profile', $part->user->url) }}">
                                                                <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$part->user->first_name}} {{$part->user->surname ?? ''}}" class="img-radius" src="/assets/images/avatars/thumbnails/{{ $part->user->avatar ?? '/assets/images/avatar-3.jpg' }}" alt="chat-user">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6><a href="{{ route('view-profile', $part->user->url) }}">{{$part->user->first_name }}  {{ $part->user->surname ?? '' }}</a></h6>
                                                            <p>{{$part->user->position ?? '-' }}</p>
                                                        </div>
                                                        <div>
                                                            <a href="#!" class="text-muted">
                                                                <i class="icon-options-vertical"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            @else
                                                    <p class="">There're no participants for this task</p>

                                            @endif

                                        </div>
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

@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
@endsection
