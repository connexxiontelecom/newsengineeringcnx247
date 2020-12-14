<div class="row">
    <div class="col-sm-12">
        <div>
            <div class="content social-timeline">
                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="social-wallpaper">
                                <img src="\assets\images\social\img1.jpg" class="img-fluid width-100" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-4 col-xs-12">
                            <!-- Social timeline left start -->
                            <div class="social-timeline-left">
                                <!-- social-profile card start -->
                                <div class="card">
                                    <div class="social-profile">
                                        <img class="img-fluid width-100" src="{{asset('assets/images/company-assets/logos/'.Auth::user()->tenant->logo ?? '/assets/images/logo.png')}}" alt="{{Auth::user()->tenant->company_name ?? ''}}">
                                    </div>
                                    <div class="card-block social-follower">
                                        <h4>{{Auth::user()->tenant->company_name ?? ''}}</h4>
                                        <h5 class="label label-primary">{{Auth::user()->tenant->industry->industry ?? ''}}</h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Facebook Pages</h5>
                                    </div>
                                    <div class="card-block user-box">
                                        <div class="media m-b-10">
                                            <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="\assets\images\avatar-1.jpg" alt="Generic placeholder image" data-toggle="tooltip" data-placement="top" title="user image">
                                        <div class="live-status bg-danger"></div>
                                        </a>
                                            <div class="media-body">
                                                <div class="chat-header">Josephin Doe</div>
                                                <div class="text-muted social-designation">Softwear Engineer</div>
                                            </div>
                                        </div>
                                        <div class="media m-b-10">
                                            <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="\assets\images\avatar-2.jpg" alt="Generic placeholder image" data-toggle="tooltip" data-placement="top" title="user image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                            <div class="media-body">
                                                <div class="chat-header">Josephin Doe</div>
                                                <div class="text-muted social-designation">Softwear Engineer</div>
                                            </div>
                                        </div>
                                        <div class="media m-b-10">
                                            <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="\assets\images\avatar-3.jpg" alt="Generic placeholder image" data-toggle="tooltip" data-placement="top" title="user image">
                                        <div class="live-status bg-danger"></div>
                                    </a>
                                            <div class="media-body">
                                                <div class="chat-header">Josephin Doe</div>
                                                <div class="text-muted social-designation">Softwear Engineer</div>
                                            </div>
                                        </div>
                                        <div class="media m-b-10">
                                            <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="\assets\images\avatar-2.jpg" alt="Generic placeholder image" data-toggle="tooltip" data-placement="top" title="user image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                            <div class="media-body">
                                                <div class="chat-header">Josephin Doe</div>
                                                <div class="text-muted social-designation">Softwear Engineer</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-8 col-md-8 col-xs-12 mt-2">
                            <div class="card">
                                <div class="card-block">
                                    <form wire:submit.prevent="postToFacebook">
                                        @if (session()->has('success'))
                                            <div class="alert alert-success background-success mt-3">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="icofont icofont-close-line-circled text-white"></i>
                                                </button>
                                                {!! session()->get('success') !!}
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea wire.model.debounce.90000ms="message" placeholder="What's on your mind?" id="" cols="30" rows="5" class="form-control" style="resize: none;"></textarea>
                                                @error('message')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="form-group col-md-4">
                                                <label for="">Post to</label>
                                                <select wire:model.debounce.90000ms="section" class="form-control">
                                                    <option selected disabled>Select Facebook section</option>
                                                    <option value="page">Page</option>
                                                    <option value="group">Group</option>
                                                </select>
                                            </div>
                                        </div>
                                        @if ($section == 'page')
                                            <div class="row mt-2">
                                                <div class="form-group col-md-4">
                                                    <label for="">Page</label>
                                                    <select wire:model.debounce.90000ms="page"  class="form-control">
                                                        <option selected disabled>Select Page</option>
                                                        <option value="page">Page</option>
                                                        <option value="group">Group</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($section == 'group')
                                            <div class="row mt-2">
                                                <div class="form-group col-md-4">
                                                    <label for="">Group</label>
                                                    <select wire:model.debounce.90000ms="group" class="form-control">
                                                        <option selected disabled>Select Group</option>
                                                        <option value="page">Page</option>
                                                        <option value="group">Group</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row mt-2">
                                            <div class="col-md-12 d-flex justify-content-center">
                                                <button class="btn btn-primary btn-mini" type="submit" wire:submit.prevent="postToFacebook"><i class="ti-share mr-2"></i>Share post</button>
                                                <div class="preloader3 loader-block" wire:loading wire.target="postToFacebook">
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
                            <div class="card">
                                <div class="card-block post-timelines">
                                    <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                    <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                        <a class="dropdown-item" href="#">Edit</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                    <div class="chat-header f-w-600">Josephin Doe posted on your timeline</div>

                                    <div class="social-time text-muted">50 minutes ago</div>
                                </div>
                                <img src="\assets\images\timeline\img1.jpg" class="img-fluid width-100" alt="">
                                <div class="card-block">

                                    <div class="timeline-details">
                                        <div class="chat-header">Josephin Doe posted on your timeline</div>
                                        <p class="text-muted">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea </p>
                                    </div>
                                </div>
                                <div class="card-block b-b-theme b-t-theme social-msg">
                                    <a href="#"> <i class="icofont icofont-heart-alt text-muted"></i><span class="b-r-muted">Like (20)</span> </a>
                                    <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments (25)</span></a>
                                    <a href="#"> <i class="icofont icofont-share text-muted"></i> <span>Share (10)</span></a>
                                </div>
                                <div class="card-block user-box">
                                    <div class="p-b-30"> <span class="f-14"><a href="#">Comments (110)</a></span><span class="f-right">see all comments</span></div>
                                    <div class="media m-b-20">
                                        <a class="media-left" href="#">
                                    <img class="media-object img-radius m-r-20" src="\assets\images\avatar-1.jpg" alt="Generic placeholder image">
                                </a>
                                        <div class="media-body b-b-muted social-client-description">
                                            <div class="chat-header">About Marta Williams<span class="text-muted">Jane 10, 2015</span></div>
                                            <p class="text-muted">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor
                                                sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                    <div class="media m-b-20">
                                        <a class="media-left" href="#">
                                    <img class="media-object img-radius m-r-20" src="\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                </a>
                                        <div class="media-body b-b-muted social-client-description">
                                            <div class="chat-header">About Marta Williams<span class="text-muted">Jane 11, 2015</span></div>
                                            <p class="text-muted">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor
                                                sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <a class="media-left" href="#">
                                         <img class="media-object img-radius m-r-20" src="\assets\images\user.png" alt="Generic placeholder image">
                                        </a>
                                        <div class="media-body">
                                            <form class="">
                                                <div class="">
                                                    <textarea rows="5" cols="5" class="form-control" placeholder="Write Something here..."></textarea>
                                                    <div class="text-right m-t-20"><a href="#" class="btn btn-primary waves-effect waves-light">Post</a></div>
                                                </div>
                                            </form>
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
</div>
