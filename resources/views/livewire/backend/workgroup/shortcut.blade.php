            <div class="row m-b-30" wire:ignore>
                <div class="col-lg-12 col-xl-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item expandContent" style="width:120px; padding:5px;">
                            <a class="nav-link active" data-toggle="tab" href="#message" role="tab">Message</a>
                            <div class="slide" style="width:120px;"></div>
                        </li>
                        <li class="nav-item expandContent" style="width:120px; padding:5px;">
                            <a class="nav-link" data-toggle="tab" href="#task" role="tab">Task</a>
                            <div class="slide" style="width:120px;"></div>
                        </li>
                        <li class="nav-item expandContent" style="width:120px; padding:5px;">
                            <a class="nav-link" data-toggle="tab" href="#poll" role="tab">Poll</a>
                            <div class="slide" style="width:120px;"></div>
                        </li>
                        <li class="nav-item expandContent" style="width:120px; padding:5px;">
                            <a class="nav-link" data-toggle="tab" href="#announcement" role="tab">Announcement</a>
                            <div class="slide" style="width:120px;"></div>
                        </li>
                        <li class="nav-item expandContent" style="width:120px; padding:5px;">
                            <a class="nav-link" data-toggle="tab" href="#file" role="tab">File</a>
                            <div class="slide" style="width:120px; "></div>
                        </li>
                        <li class="nav-item expandContent" style="width:120px; padding:5px;">
                            <a class="nav-link" data-toggle="tab" href="#appreciation" role="tab">Appreciation</a>
                            <div class="slide" style="width:120px;"></div>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content card-block tabContentArea" style="display: none;">
                        <div class="tab-pane active" id="message" role="tabpanel">

                            <div class="card-block">
                                <form>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <textarea id="compose_message" class="form-control form-control-normal content" placeholder="Compose message" style="resize: none;"></textarea>
                                            @error('compose_message')
                                                <i class="text-danger">{{ $message }}</i>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <input type="file" name="attachments[]" id="attachment" multiple="multiple">
                                    </div>
                                    <div class=" row mb-4">
                                        <div class="col-md-6">
                                            <div class="checkbox-color checkbox-primary">
                                                <input id="all_employees" value="1" type="checkbox" >
                                                <label for="checkbox18">
                                                    To all employees
                                                </label>
                                            </div>
                                            <span><strong>OR</strong></span>
                                            <p>To specific person(s)
                                            </p>
                                            <select id="message_persons" class="js-example-responsive col-sm-12" multiple="multiple" style="width:75%;">
                                                <option selected disabled>Select person(s)</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->first_name}} {{ $user->surname ?? '' }}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <button class="btn btn-sm btn-primary" type="button" id="sendMessage"><i class="zmdi zmdi-mail-send mr-2"></i> Send Message</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="task" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 btn-add-task">
                                    <form action="{{route('workgroup-task')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class=" row">
                                            <div class="form-group col-md-10 offset-md-1">
                                                <label class="">Task Title</label>
                                                <input type="text" name="task_title" value="{{old('task_title')}}" class="form-control mb-2" placeholder="Task title">
                                                @error('task_title')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class=" row">
                                            <div class=" form-group col-md-10 offset-md-1">
                                                <label class="">Task Description</label>
                                                <textarea name="task_description" value="{{old('task_description')}}"  cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Task Description"></textarea>
                                                @error('task_description')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="">Start Date</label>
                                                <input type="datetime-local" name="start_date" value="{{old('start_date')}}" class="form-control form-control-normal" placeholder="Task title">
                                                @error('start_date')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="">Due Date</label>
                                                <input type="datetime-local" name="due_date" value="{{old('due_date')}}" class="form-control form-control-normal" placeholder="Due date">
                                                @error('due_date')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="">Choose Color <abbr title="Quickly identify this task on task board by assigning a color to it.">?</abbr></label>
                                                <input type="color" name="color" value="{{old('color')}}" class="form-control form-control-normal">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group  col-md-4">
                                                <label class="">Responsible Person(s)</label>
                                                <select name="responsible_persons[]" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                    <option selected disabled>Add Responsible Person(s)</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group  col-md-4">
                                                <label class="">Participant(s) <i>(Optional)</i></label>
                                                <select name="participants[]" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                    <option selected disabled>Add Participant(s)</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group  col-md-4">
                                                <label class="">Observer(s) <i>(Optional)</i></label>
                                                <select name="observers[]" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                    <option selected disabled>Add Observer(s)</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class=" row">
                                            <div class="form-group col-md-4">
                                                <label class="">Attachment</label>
                                                <input type="file" class="form-control-file" name="attachment">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="">Priority</label>
                                                    <select name="priority" value="{{old('priority')}}" class="form-control form-control-normal">
                                                        @foreach ($priorities as $priority)
                                                            <option value="{{$priority->id}}">{{$priority->name}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="">Status</label>
                                                    <select name="status" value="{{old('status')}}" class="form-control form-control-normal">
                                                        @foreach ($statuses as $status)
                                                            <option value="{{$status->id}}">{{$status->name}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 d-flex justify-content-center">
                                                <input type="hidden" name="taskGroupId" value="{{$groupInstance->id}}">
                                                <button class="btn btn-primary btn-mini" type="submit"> <i class="ti-check mr-2"></i> Submit</button>

                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="poll" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 btn-add-task">
                                    <form wire:submit.prevent="createTask">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Event Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="event_name" class="form-control form-control-normal mb-2" placeholder="Event Name">
                                                @error('event_name')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Event Description</label>
                                            <div class="col-sm-10">
                                                <textarea id="event_description"  cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Event Description"></textarea>
                                                @error('event_description')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Event Date</label>
                                            <div class="col-sm-10 col-md-4">
                                                <input type="datetime-local" id="event_start_date" class="form-control form-control-normal" placeholder="Event Start date">
                                                @error('event_start_date')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Event End Date <i>(Optional)</i></label>
                                            <div class="col-sm-10 col-md-4">
                                                <input type="datetime-local" id="event_end_date" class="form-control form-control-normal" placeholder="Event End Date">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Responsible Person(s)</label>
                                            <div class="col-sm-10 col-md-4">
                                                <select id="responsible_persons" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                    <option selected disabled>Add Responsible Person(s)</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Participant(s) <i>(Optional)</i> </label>
                                            <div class="col-sm-10 col-md-4">
                                                <select id="participants" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                    <option selected disabled>Add participant(s)</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Observer(s) <i>(Optional)</i> </label>
                                            <div class="col-sm-10 col-md-4">
                                                <select id="observers" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                    <option selected disabled>Add observer(s)</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Attachment</label>
                                            <div class="col-sm-10 col-md-4">
                                                <button class="btn btn-primary btn-sm">Upload attachment</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Priority</label>
                                            <div class="col-sm-10 col-md-3">
                                                <select id="priority" class="form-control form-control-normal">
                                                    <option value="1">Highest priority</option>
                                                    <option value="2">High priority</option>
                                                    <option value="3">Normal priority</option>
                                                    <option value="4">Low priority</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Status</label>
                                            <div class="col-sm-10 col-md-3">
                                                <select id="status" class="form-control form-control-normal">
                                                    <option value="1">Open</option>
                                                    <option value="2">on Hold</option>
                                                    <option value="3">Resolved</option>
                                                    <option value="4">Closed</option>
                                                    <option value="5">At Risk</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 d-flex justify-content-center">
                                                <button class="btn btn-primary btn-sm" type="submit" id="submitTask">Submit</button>

                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>


                        </div>
                        <div class="tab-pane" id="announcement" role="tabpanel">
                            <form action="{{route('workgroup-announcement')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class=" row">
                                    <div class="form-group col-md-10 offset-md-1">
                                        <label class="">Subject</label>
                                        <input type="text" name="subject" value="{{old('subject')}}" class="form-control mb-2" placeholder="Subject">
                                        @error('subject')
                                            <i class="text-danger">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class=" form-group col-md-10 offset-md-1">
                                        <label class="">Content</label>
                                        <textarea name="announcement" value="{{old('announcement')}}"  cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Type announcement here..."></textarea>
                                        @error('announcement')
                                            <i class="text-danger">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group  col-md-6">
                                        <label class="">Responsible Person(s)</label>
                                        <select name="to[]" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                            <option selected disabled>Add Responsible Person(s)</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="">Attachment</label>
                                        <input type="file" class="form-control-file" name="announcement_attachment">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <input type="hidden" name="announcementGroupId" value="{{$groupInstance->id}}">
                                        <button class="btn btn-primary btn-mini" type="submit"> <i class="ti-check mr-2"></i> Submit</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="file" role="tabpanel">
                            <form action="{{route('share-file')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class=" row">
                                    <div class="form-group col-md-10 offset-md-1">
                                        <label class="">File Name</label>
                                        <input type="text" name="file_name" value="{{old('file_name')}}" class="form-control mb-2" placeholder="File Name">
                                        @error('file_name')
                                            <i class="text-danger">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-10 offset-md-1">
                                        <label class="">Attachment</label>
                                        <input type="file" class="form-control-file" name="share_file">
                                        @error('share_file')
                                            <i class="text-danger">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <input type="hidden" name="fileGroupId" value="{{$groupInstance->id}}">
                                        <button class="btn btn-primary btn-mini" type="submit"> <i class="ti-check mr-2"></i> Share File</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="appreciation" role="tabpanel">
                            <p class="m-0"> appreciation 4.Cras consequat in enim ut efficitur. Nulla posuere elit quis auctor interdum praesent sit amet nulla vel enim amet. Donec convallis tellus neque, et imperdiet felis amet.</p>
                        </div>
                    </div>
                </div>
            </div>
@push('custom-script')
<script src="/assets/js/cus/workgroup.js"></script>
@endpush
