<div class="card-block" wire:ignore>
	<div class="row m-b-30">
			<div class="col-lg-12 col-xl-12">
					<span class="float-right toggleTab" style="cursor: pointer;"><i class="zmdi zmdi-swap-vertical text-info"></i></span>
					<ul class="nav nav-tabs md-tabs" role="tablist">
							<li class="nav-item expandContent" style="width:120px; padding:5px;">
									<a class="nav-link active" data-toggle="tab" href="#message" role="tab">Message </a>
									<div class="slide" style="width:120px;"></div>
							</li>
							<li class="nav-item expandContent" style="width:100px; padding:5px;">
									<a class="nav-link" data-toggle="tab" href="#task" role="tab">Task</a>
									<div class="slide" style="width:100px;"></div>
							</li>
							<li class="nav-item expandContent" style="width:120px; padding:5px;">
									<a class="nav-link" data-toggle="tab" href="#event" role="tab">Event</a>
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
					<div class="tab-content card-block tabContentArea">
							<div class="tab-pane active" id="message" role="tabpanel">
									<div class="card-block">
											<form id="messageForm" data-parsley-validate>
													<div class="row">
															<div class="col-md-12">
																	<div class="form-group">
																			<label for="">Message</label>
																			<textarea id="compose_message" class="form-control form-control-normal content" placeholder="Compose message" style="resize: none;"></textarea>
																			@error('compose_message')
																					<i class="text-danger">{{ $message }}</i>
																			@enderror
																	</div>

															</div>
													</div>
												<div class="row form-group">
												@if($storage_capacity == 1):

															<input type="file" name="message_attachments"  id="message_attachments" multiple="multiple">

											@endif


													@if($storage_capacity == 0):

														{{'Drive Capacity Full, Please Upgrade'}}

													@endif
												</div>

													<div class=" row mb-4">
															<div class="col-md-6">
																	<div class="mb-3">
																			To:
																			<select name="" required id="target_message" class="form-control">
																					<option disabled selected>Select person(s)</option>
																					<option value="0">To All Employees</option>
																					<option value="1">To Specific Employee(s)</option>
																			</select>
																	</div>
																	<div id="message-persons-wrap">
																			<select id="message_persons" class="js-example-responsive col-sm-12" multiple="multiple" style="width:75%;">
																					<option selected disabled>Select person(s)</option>
																					@foreach ($users as $user)
																							<option value="{{ $user->id }}">{{ $user->first_name}} {{ $user->surname ?? '' }}</option>

																					@endforeach
																			</select>
																	</div>
															</div>
													</div>
													<div class="row ">
															<div class="col-md-12 d-flex justify-content-center">
																	<div class="btn-group">
																			<a class="btn btn-mini btn-danger" href="{{url()->previous()}}"><i class="ti-close mr-2"></i> Cancel</a>
																			<button class="btn btn-mini btn-primary" type="submit" id="sendMessage"><i class="ti-check mr-2"></i> Send Message</button>
																	</div>
															</div>
															<div class="col-md-12 d-flex justify-content-center mt-1 ">
																	<div class="preloader3 loader-block message-cus-preloader">
																			<div class="circ1 loader-primary"></div>
																			<div class="circ2 loader-primary"></div>
																			<div class="circ3 loader-primary"></div>
																			<div class="circ4 loader-primary"></div>
																	</div>

															</div>
													</div>
											</form>
									</div>
							</div>
							<div class="tab-pane" id="task" role="tabpanel">
									<div class="row">
											<div class="col-md-12 btn-add-task">
													<form id="taskForm" data-parsley-validate>
															<div class="row">
																	<div class="col-md-12">
																			<label class="">Task Title</label>
																			<input type="text" id="task_title" class="form-control form-control-normal mb-2" placeholder="Task title">
																			@error('task_title')
																					<i class="text-danger">{{$message}}</i>
																			@enderror
																	</div>
															</div>
															<div class="row">
																	<div class="col-md-12">
																			<div class="form-group">
																					<label class="">Task Description</label>
																					<textarea id="task_description"  cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Task Description"></textarea>
																					@error('task_description')
																							<i class="text-danger">{{$message}}</i>
																					@enderror
																			</div>
																	</div>
															</div>
															<div class="row">
																	<div class="col-md-6">
																			<div class="form-group">
																					<label class="">Start Date <i>(Optional)</i></label>
																					<input type="text" required id="start_date" class="form-control form-control-normal" placeholder="dd/mm/yyyy">
																			</div>
																	</div>
																	<div class="col-md-6">
																			<div class="form-group">
																					<label class="">Due Date</label>
																					<input type="text" required id="due_date" class="form-control form-control-normal" placeholder="dd/mm/yyyy">
																					@error('due_date')
																							<i class="text-danger">{{$message}}</i>
																					@enderror
																			</div>
																	</div>
															</div>
															<div class="row">
																	<div class="col-md-4">
																			<div class="form-group">
																					<label class="">Responsible Person(s)</label>
																					<select id="responsible_persons" required class="js-example-basic-multiple col-sm-12" multiple="multiple">
																							<option selected disabled>Add Responsible Person(s)</option>
																							@foreach($users as $user)
																									<option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
																							@endforeach
																					</select>
																			</div>
																	</div>
																	<div class="col-md-4">
																			<div class="form-group">
																					<label class="">Participant(s) <i>(Optional)</i> </label>
																					<select id="participants" class="js-example-basic-multiple col-sm-12" multiple="multiple">
																							<option selected disabled>Add participant(s)</option>
																							@foreach($users as $user)
																									<option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
																							@endforeach
																					</select>
																			</div>
																	</div>
																	<div class="col-md-4">
																			<div class="form-group">
																					<label class="">Observer(s) <i>(Optional)</i> </label>
																					<select id="observers" class="js-example-basic-multiple col-sm-12" multiple="multiple">
																							<option selected disabled>Add observer(s)</option>
																							@foreach($users as $user)
																									<option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
																							@endforeach
																					</select>
																			</div>
																	</div>
															</div>
															<div class="row">
																	<div class="col-md-6">
																			<div class="form-group">
																					<label class="">Choose Color <abbr title="Quickly identify this task on task board by assigning a color to it.">?</abbr></label>
																					<div class="">
																							<input type="color" id="color" class="form-control form-control-normal">
																					</div>
																			</div>
																	</div>
																	<div class="col-md-6">



																				<div class="row form-group">
																					@if($storage_capacity == 1):

																					<label class="">Attachment</label>
																					<div class="col-sm-10 col-md-4">
																						<input type="file" id="task_attachments" >
																					</div>
																					@endif


																					@if($storage_capacity == 0):

																					{{'Drive Capacity Full, Please Upgrade'}}

																					@endif
																				</div>



																	</div>
															</div>
															<div class="row">
																	<div class="col-md-6">
																			<div class="form-group">
																					<label for="">Priority</label>
																					<select id="priority" class="form-control form-control-normal">
																							<option value="1">Highest priority</option>
																							<option value="2">High priority</option>
																							<option value="3">Normal priority</option>
																							<option value="4">Low priority</option>
																					</select>
																			</div>
																	</div>
																	<div class="col-md-6">
																			<div class="form-group">
																					<label for="">Status</label>
																					<select id="status" class="form-control form-control-normal">
																							<option value="1">Open</option>
																							<option value="2">on Hold</option>
																							<option value="3">Resolved</option>
																							<option value="4">Closed</option>
																							<option value="5">At Risk</option>
																					</select>
																			</div>
																	</div>
															</div>
															<div class="row">
																	<div class="col-md-12 d-flex justify-content-center">
																			<div class="btn-group">
																					<a class="btn btn-danger btn-mini" href="{{url()->previous()}}"><i class="ti-close mr-2"></i>Cancel</a>
																					<button class="btn btn-primary btn-mini" type="submit" id="submitTask"><i class="ti-check mr-2"></i>Submit</button>
																			</div>

																	</div>
																	<div class="col-md-12 d-flex justify-content-center mt-1 ">
																			<div class="preloader3 loader-block task-cus-preloader">
																					<div class="circ1 loader-primary"></div>
																					<div class="circ2 loader-primary"></div>
																					<div class="circ3 loader-primary"></div>
																					<div class="circ4 loader-primary"></div>
																			</div>

																	</div>
															</div>
													</form>

											</div>
									</div>
							</div>
							<div class="tab-pane" id="event" role="tabpanel">
									<div class="row">
											<div class="col-md-12 btn-add-task">
													<form id="eventForm" data-parsley-validate>
															<div class=" row">
																	 <div class="col-md-12">
																			 <div class="form-group">
																					<label>Event Name</label>
																					<input type="text" id="event_name" class="form-control form-control-normal mb-2" placeholder="Event Name">
																					@error('event_name')
																							<i class="text-danger">{{$message}}</i>
																					@enderror
																			 </div>
																	 </div>
															</div>
															<div class="row">
																	<div class="col-md-12">
																			<div class="form-group">
																					<label>Event Description</label>
																					<textarea id="event_description" cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Event Description"></textarea>
																					@error('event_description')
																							<i class="text-danger">{{$message}}</i>
																					@enderror
																			</div>
																	</div>
															</div>
															<div class="row">
																	<div class="col-md-6">
																			<div class="form-group">
																					<label>Event Date</label>
																					<input type="text" required id="event_start_date" class="form-control form-control-normal" placeholder="dd/mm/yyyy">
																					@error('event_start_date')
																							<i class="text-danger">{{$message}}</i>
																					@enderror
																			</div>
																	</div>
																	<div class="col-md-6">
																			<div class="form-group">
																					<label>Event End Date</label>
																					<input type="text" required id="event_end_date" class="form-control form-control-normal" placeholder="dd/mm/yyyy">
																			</div>
																	</div>
															</div>
															<div class="row">
																	<div class="col-md-6">
																			<div class="mb-3">
																					Attendee(s):
																					<select name="" required required id="target_event" class="form-control">
																							<option disabled selected>Select Attendee(s)</option>
																							<option value="0">To All Employees</option>
																							<option value="1">To Specific Employee(s)</option>
																					</select>
																			</div>
																			<div id="event-persons-wrap">
																					<select id="attendees" class="js-example-basic-multiple col-sm-12" multiple="multiple">
																							<option value="{{ Auth::user()->id }} " selected>{{ Auth::user()->first_name }} {{ Auth::user()->surname ?? '' }}</option>
																							@foreach($users as $user)
																									<option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
																							@endforeach
																					</select>
																			</div>
																	</div>
															</div>
															<hr>
															<div class="row mt-3">
																	<div class="col-md-12 d-flex justify-content-center">
																			<div class="btn-group">
																					<a href="{{url()->previous()}}" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Cancel</a>
																					<button class="btn btn-primary btn-mini" type="submit" id="submitEvent"><i class="ti-check mr-2"></i>Submit</button>
																			</div>
																	</div>
																	<div class="col-md-12 d-flex justify-content-center mt-1 ">
																			<div class="preloader3 loader-block event-cus-preloader">
																					<div class="circ1 loader-primary"></div>
																					<div class="circ2 loader-primary"></div>
																					<div class="circ3 loader-primary"></div>
																					<div class="circ4 loader-primary"></div>
																			</div>
																	</div>
															</div>
													</form>
											</div>
									</div>
							</div>
							<div class="tab-pane" id="announcement" role="tabpanel">
									<div class="row">
											<div class="col-md-12 btn-add-task">
													<form id="announcementForm" data-parsley-validate="">
															<div class="row">
																	<div class="col-md-12">
																			<div class="form-group">
																					<label>Subject</label>
																					<input type="text" required id="subject" class="form-control form-control-normal mb-2" placeholder="Subject">
																					@error('subject')
																							<i class="text-danger">{{$message}}</i>
																					@enderror
																			</div>
																	</div>
															</div>
															<div class="row">
																	<div class="col-md-12">
																			<div class="form-group">
																					<label>Content</label>
																					<textarea id="announcement_text"  cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Type content here..."></textarea>
																					@error('announcement_text')
																							<i class="text-danger">{{$message}}</i>
																					@enderror
																			</div>
																	</div>
															</div>
															<div class="row">
																	<div class="col-md-6">

																		<div class="row form-group">
																			@if($storage_capacity == 1):

																			<label>Attachment</label>
																			<input type="file" name="announcement_attachment" id="announcement_attachment">

																			@endif


																			@if($storage_capacity == 0):

																			{{'Drive Capacity Full, Please Upgrade'}}

																			@endif
																		</div>





																	</div>
																	<div class="col-md-6">
																			<div class="mb-3">
																					To:
																					<select name="" required required id="target_announcement" class="form-control">
																							<option disabled selected>Select person(s)</option>
																							<option value="0">To All Employees</option>
																							<option value="1">To Specific Employee(s)</option>
																					</select>
																			</div>
																			<div id="announcement-persons-wrap">
																					<select id="announce_to" class="js-example-basic-multiple col-sm-12" multiple="multiple">
																							<option value="32 " selected>To all employees</option>
																							@foreach($users as $user)
																									<option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
																							@endforeach
																					</select>
																			</div>
																	</div>

															</div>
															<hr>
															<div class="row mt-3">
																	<div class="col-md-12 d-flex justify-content-center">
																			<div class="btn-group">
																					<a href="{{url()->previous()}}" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i> Cancel</a>
																					<button class="btn btn-primary btn-mini" type="submit" id="submitAnnouncement"><i class="ti-check mr-2"></i>Submit</button>
																			</div>

																	</div>
																	<div class="col-md-12 d-flex justify-content-center mt-1 ">
																			<div class="preloader3 loader-block announcement-cus-preloader">
																					<div class="circ1 loader-primary"></div>
																					<div class="circ2 loader-primary"></div>
																					<div class="circ3 loader-primary"></div>
																					<div class="circ4 loader-primary"></div>
																			</div>

																	</div>
															</div>
													</form>

											</div>
									</div>
							</div>
							<div class="tab-pane" id="file" role="tabpanel">
									<div class="row">
											<div class="col-md-12 btn-add-task">
													<form id="fileUploadForm" data-parsley-validate>
															<div class="row">
																	<div class="col-md-6 offset-md-3">
																			<div class="form-group">
																					<label for="">File Name</label>
																					<input type="text" placeholder="File Name" required id="fileName"  class="form-control">
																			</div>
																	</div>

																<div class="col-md-6 offset-md-3">

																	<div class="row form-group">
																		@if($storage_capacity == 1):

																		<div class="form-group">
																			<label>Attachment</label>
																			<input type="file" name="shareFile" required id="shareFile">
																		</div>
																		@endif


																		@if($storage_capacity == 0):

																		{{'Drive Capacity Full, Please Upgrade'}}

																		@endif
																	</div>





																</div>


																	<div class="col-md-6 offset-md-3">
																			<div class="mb-3">
																					Share with:
																					<select name="" required id="target_file" class="form-control">
																							<option disabled selected>Select person(s)</option>
																							<option value="0">To All Employees</option>
																							<option value="1">To Specific Employee(s)</option>
																					</select>
																			</div>
																			<div id="file-persons-wrap">
																					<select id="share_with" class="js-example-basic-multiple col-sm-12" multiple="multiple">
																							<option value="32 " selected>To all employees</option>
																							@foreach($users as $user)
																									<option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
																							@endforeach
																					</select>
																			</div>
																	</div>

															</div>
															<hr>
															<div class="row">
																	<div class="col-md-12 d-flex justify-content-center">
																			<div class="btn-group">
																					<a href="{{url()->previous()}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</a>
																					<button class="btn btn-primary btn-mini" type="submit" id="uploadFilesBtn"><i class="ti-check mr-2"></i>Share Attachment(s)</button>
																			</div>

																	</div>
																	<div class="col-md-12 d-flex justify-content-center mt-1 ">
																			<div class="preloader3 loader-block file-cus-preloader">
																					<div class="circ1 loader-primary"></div>
																					<div class="circ2 loader-primary"></div>
																					<div class="circ3 loader-primary"></div>
																					<div class="circ4 loader-primary"></div>
																			</div>

																	</div>
															</div>
													</form>

											</div>
									</div>
							</div>
							<div class="tab-pane" id="appreciation" role="tabpanel">
									<form id="appreciationForm" data-parsley-validate>
											<div class="row">
													<div class="col-md-12">
															<div class="form-group">
																	<label class="">Content</label>
																			<textarea id="appreciation_text"  cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Type content here..."></textarea>
																			@error('appreciation_text')
																					<i class="text-danger">{{$message}}</i>
																			@enderror
															</div>
													</div>
													<div class="col-md-6">
															<div class="mb-3">
																	Person(s):
																	<select name="" required id="target_appreciating" class="form-control">
																			<option disabled selected>Select person(s)</option>
																			<option value="0">To All Employees</option>
																			<option value="1">To Specific Employee(s)</option>
																	</select>
															</div>
															<div id="appreciating-persons-wrap">
																	<select id="appreciating" class="js-example-basic-multiple col-sm-8 col-md-8" multiple="multiple">
																			<option value="32 " selected>To all employees</option>
																			@foreach($users as $user)
																					<option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
																			@endforeach
																	</select>
															</div>
													</div>
											</div>
											<hr>
											<div class="row">
													<div class="col-md-12 d-flex justify-content-center">
															<div class="btn-group">
																	<a href="{{url()->previous()}}" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Cancel</a>
																	<button class="btn btn-primary btn-mini" type="submit" id="submitAppreciation"><i class="ti-check mr-2"></i>Submit</button>
															</div>

													</div>
													<div class="col-md-12 d-flex justify-content-center mt-1 ">
															<div class="preloader3 loader-block appreciation-cus-preloader">
																	<div class="circ1 loader-primary"></div>
																	<div class="circ2 loader-primary"></div>
																	<div class="circ3 loader-primary"></div>
																	<div class="circ4 loader-primary"></div>
															</div>

													</div>
											</div>
									</form>
							</div>
					</div>
			</div>
	</div>
</div>
