<!-- Row start -->
<div class="row m-b-30">
    <div class="col-lg-12 col-xl-12">
        <span style="cursor: pointer;" class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
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
                            <input type="file" name="files[]" id="filer_input" multiple="multiple">
                        </div>
                        <div class=" row mb-4">
                            <div class="col-md-6">
                                <div class="checkbox-color checkbox-primary">
                                    <input id="all_employees" value="1" type="checkbox" checked>
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
                <p class="m-0">2.Cras consequat in enim ut efficitur. Nulla posuere elit quis auctor interdum praesent sit amet nulla vel enim amet. Donec convallis tellus neque, et imperdiet felis amet.</p>
            </div>
            <div class="tab-pane" id="event" role="tabpanel">
                <p class="m-0">3. This is Photoshop's version of Lorem IpThis is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean mas Cum sociis natoque penatibus et magnis dis.....</p>
            </div>
            <div class="tab-pane" id="announcement" role="tabpanel">
                <p class="m-0"> announcement 4.Cras consequat in enim ut efficitur. Nulla posuere elit quis auctor interdum praesent sit amet nulla vel enim amet. Donec convallis tellus neque, et imperdiet felis amet.</p>
            </div>
            <div class="tab-pane" id="file" role="tabpanel">
                <p class="m-0"> file 4.Cras consequat in enim ut efficitur. Nulla posuere elit quis auctor interdum praesent sit amet nulla vel enim amet. Donec convallis tellus neque, et imperdiet felis amet.</p>
            </div>
            <div class="tab-pane" id="appreciation" role="tabpanel">
                <p class="m-0"> appreciation 4.Cras consequat in enim ut efficitur. Nulla posuere elit quis auctor interdum praesent sit amet nulla vel enim amet. Donec convallis tellus neque, et imperdiet felis amet.</p>
            </div>
        </div>
    </div>
</div>
<!-- Row end -->
