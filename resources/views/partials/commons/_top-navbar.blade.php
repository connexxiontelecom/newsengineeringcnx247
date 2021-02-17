<nav class="navbar header-navbar pcoded-header" style="">
    <div class="navbar-wrapper" style="background: none;">

        <div class="navbar-logo" style="background: none;">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu"></i>
            </a>
            <a href="{{route('home')}}">
                <img class="img-fluid ml-5 mt-3" src="{{asset('/assets/images/company-assets/logos/'.Auth::user()->tenant->logo ?? 'logo.png')}}" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="52" width="82">
            </a>
            <a class="mobile-options">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li class="header-search">
									<form action="{{route('search-cnx247')}}" method="post" >
										@csrf
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                            <input type="text" style="" class="form-control" placeholder="Search {{config('app.name')}}" name="search_phrase">
                            <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                        </div>
                    </div>

									</form>
                </li>
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="feather icon-maximize full-screen"></i>
                    </a>
                </li>
            </ul>
            @if(Auth::check())
                <ul class="nav-right">
                    <li class="header-notification">

                    </li>
                    <li class="header-notification">
                        <div class="dropdown-primary dropdown">
                            <div class="dropdown-toggle" data-toggle="dropdown">
                                <!-- Clocker -->
                                @livewire('backend.clocker')
                                <!--/ Clocker -->
                            </div>
                        </div>
                    </li>
                    <li class="header-notification">
                        <div class="dropdown-primary dropdown">
                            <div class="dropdown-toggle" data-toggle="dropdown">
                                <i class="zmdi zmdi-dialpad"></i>
                            </div>
                            <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <li>
                                    <h6 class="text-uppercase">Phone Dialer</h6>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="media-body">
                                            <!-- Dialer -->
                                                @livewire('backend.dialer')
                                            <!--/ Dialer -->
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </li>
                    @livewire('backend.user.notifications')
                    <li class="header-notification">
                        <div class="dropdown-primary dropdown">
                            <div class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-help"></i>
                            </div>
                            <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                                <li>
                                    <a href="{{route('ticket')}}">Submit a Ticket
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('ticket-history')}}">Ticket History
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('my-feedback')}}">Give Feedback
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('my-profile')}}" target="_blank"> Documentation
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </li>
                    <li class="user-profile header-notification">
                        <div class="dropdown-primary dropdown">
                            <div class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/assets/images/avatars/thumbnails/{{Auth::user()->avatar ?? 'avatar.png'}}" height="30" width="30" class="img-radius" alt="User-Profile-Image">
                                <span>{{Auth::user()->first_name}} {{Auth::user()->surname ?? ''}}</span>
                                <i class="feather icon-chevron-down"></i>
                            </div>
                            <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <li>
                                    <a href="{{route('user-settings')}}">
                                        <i class="feather icon-settings"></i> Settings
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('my-profile')}}">
                                        <i class="feather icon-user"></i> Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('chat-n-calls')}}">
                                        <i class="feather icon-mail"></i> My Messages
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('my-ideas')}}">
                                        <i class="icofont icofont-brain-alt"></i> My Ideas
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('our-pricing')}}">
                                        <i class="ti-wallet"></i> Our Pricing
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('cnx247-themes')}}">
                                        <i class="icofont icofont-color-bucket"></i> Themes
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('logout')}}">
                                        <i class="feather icon-log-out"></i> Logout
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>
