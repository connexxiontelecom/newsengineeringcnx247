<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{Auth::user()->tenant->company_name ?? ''}} | @yield('title')</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="">
    <meta name="author" content="Connexxion Group">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" href="/assets/images/company-assets/favicons/{{Auth::user()->tenant->favicon ?? 'favicon.ico' }} " type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/bower_components/bootstrap/css/bootstrap.min.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="/assets/icon/material-design/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\font-awesome\css\font-awesome.min.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="/assets/icon/icofont/css/icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="/assets/icon/feather/css/feather.css">
    <!--Intro -->
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/intro.js/css/introjs.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/cus/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/jquery.mCustomScrollbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/assets/bower_components/offline/css/offline-theme-slide.css">
		<link rel="stylesheet" type="text/css" href="/assets/bower_components/offline/css/offline-language-english.css">
		<link rel="stylesheet" type="text/css" href="/assets/pages/notification/notification.css">
    <link rel="stylesheet" href="{{asset('assets/css/cus/parsley.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/cus/toastify.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/cus/progressBar.css')}}">
    <style>
        .card{
            border-radius: 0px !important;
        }
        .dropdown-menu{
            border-radius: 0px !important;
        }
        #dialer-screen{
            border-radius:20px;
            width:100%;
            background:#E2E8F0;
            color:#000000;
            padding:10px;
            font-family: 'Oswald', sans-serif;
            letter-spacing:2px;
        }
        .modal-content{
            border-radius: 0px !important;
        }
        .theme-border{
            border: 2px solid #0AC282;
        }

    </style>
    @yield('extra-styles')
    @livewireStyles
</head>

<body>
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        @include('partials.commons._top-navbar')


        @livewire('backend.chat-n-calls.messenger-list')

        <div class="pcoded-main-container" id="pcoded-background" style="background: url('/assets/uploads/themes/{{Auth::user()->userTheme->theme}}'); background-size:cover; background-repeat: no-repeat;">
            <div class="pcoded-wrapper">

                @livewire('backend.partials.sidebar-menu')

                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="page-body">


                                    @yield('content')


                                </div>
                            </div>
                        </div>
                        {{-- <div id="styleSelector">

                        </div> --}}
                        <footer class="footer" style="position: relative; bottom:0px; width:100%; margin-top:3px; background:#404E67;">
                            <div class="container">
                                <div class="row text-white">
                                    <div class="col-md-9">
                                        <nav class="nav">
                                            <a class="nav-link text-white" href="{{route('cnx247-terms-n-conditions')}}">Terms & Conditions</a>
                                            <a class="nav-link text-white" href="{{route('cnx247-privacy-policy')}}">Privacy Policy</a>
                                            <a class="nav-link text-white" href="https://telecom.connexxiongroup.com/" target="_blank">All Rights Reserved &copy; {{date('Y')}} Connexxion Telecom</a>
                                        </nav>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-inline">
                                                <div id="google_translate_element"></div>
                                                <script>
                                                    function googleTranslateElementInit() {
                                                        new google.translate.TranslateElement({
                                                            pageLanguage: 'en'
                                                        }, 'google_translate_element');
                                                    }
                                                </script>
                                                <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                                            <a href="{{route('cnx247-themes')}}" class="btn btn-out-dashed btn-primary btn-square ml-1" >Themes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('dialog-section')
<script type="text/javascript" src="/assets/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="/assets/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="/assets/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="/assets/bower_components/modernizr/js/css-scrollbars.js"></script>

<!-- i18next.min.js -->
<script type="text/javascript" src="/assets/bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<script src="/assets/js/pcoded.min.js"></script>
<script src="/assets/js/vartical-layout.min.js"></script>
<script src="/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="/assets/js/script.js"></script>
<!-- Offline js -->
<script type="text/javascript" src="/assets/bower_components/offline/js/offline.min.js"></script>
<script type="text/javascript" src="/assets/pages/offline/offline-custom.js"></script>
<script type="text/javascript" src="{{asset('/assets/js/cus/axios.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/js/cus/notify.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/js/cus/toastify.min.js')}}"></script>
<script type="text/javascript" src="/assets/bower_components/intro.js/js/intro.js"></script>
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script src="{{asset('/assets/js/cus/parsley.min.js')}}"></script>
<script src="{{asset('/assets/js/cus/progressBar.js')}}"></script>
<script type="text/javascript" src="/assets/js/bootstrap-growl.min.js"></script>
    <script type="text/javascript" src="/assets/pages/notification/notification.js"></script>
@stack('dialer-script')
<script src="{{asset('/assets/js/cus/twilio.min.js')}}"></script>
<script>
    var theme = null;
    var themeId = null;
    var scheme = "{{ Auth::user()->userTheme->color_scheme }} !important";
    var customTheme = null;
    $(document).ready(function(){
        $('.pcoded-mtext').css("color",scheme);
        $('.pcoded-navigatio-lavel').css("color",scheme);
        $('input[name="backgroundTheme"]').click(function(){
            if($(this).prop("checked") == true){
                theme = $(this).data('background');
                scheme = $(this).data('scheme');
                themeId = $(this).val();
                var location = "/assets/uploads/themes/"+theme;
                $('#pcoded-background').css("background","url(" + location + ")");
                $('#pcoded-background').css("background-size","cover");
                $('#pcoded-background').css("background-repeat","no-repeat");
                $('.pcoded-mtext').css("color",scheme);
                $('.pcoded-navigatio-lavel').css("color",scheme);
            }

        });

        $(document).on('click', '#saveThemeChangesBtn', function(e){
            e.preventDefault();
            if(theme == null){
                $.notify("Ooops! You haven't chosen a theme.", "error");
            }else{
                $('#saveThemeChangesBtn').text("Processing...");
                axios.post('/switch-theme',{theme:themeId})
                .then(response=>{
                    $('#themeModal').modal('hide');
                    $.notify(response.data.message, "success");
                    $('#saveThemeChangesBtn').text("Save changes");
                })
                .catch(error=>{
                    $.notify("Ooops! Something went wrong. Try again", "error");
                });
            }
        });
        $(document).on('change', '#custom_background_image', function(e){
            e.preventDefault();
            var extension = $('#custom_background_image').val().split('.').pop().toLowerCase();
            if ($.inArray(extension, ['jpeg', 'jpg', 'png', 'gif']) == -1) {
                $.notify('Ooops! File format not supported.', 'error');
                $('#custom_background_image').val('');
            }else{
                customTheme = $('#custom_background_image').prop('files')[0];

            }
        });
        $('input[name="custom_color_scheme"]').click(function(){
            if($(this).prop("checked") == true){
                $('#custom_color_scheme').val(1);
            }
            else if($(this).prop("checked") == false){
                $('#custom_color_scheme').val(0);
            }
        });
        $('#customeThemeForm').parsley().on('field:validated', function() {

        }).on('form:submit', function() {
            var config = {
                        onUploadProgress: function(progressEvent) {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };
                var form_data = new FormData();
                form_data.append('name',"Custom Background {{rand(0,999)}}.");
                form_data.append('attachment',customTheme);
                form_data.append('scheme',$('#custom_color_scheme').val());
                form_data.append('custom','yes');
                $('#customBackgroundBtn').text('Processing...');
                 axios.post('/theme/gallery/upload',form_data, config)
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#customBackgroundBtn').text('Done');
                    setTimeout(function () {
                        $("#customBackgroundBtn").text("Save");
                        $('#custom_background_image').val('');
                        $('#custom_text_color').val('');
                        $('#backgroundThemeModal').modal('hide');
                        location.reload();
                    }, 2000);

                })
                .catch(error=>{
                    $.notify('Error! Something went wrong.', 'error');
                    $('#customBackgroundBtn').text("Ooops...We couldn't upload theme.");
                    setTimeout(function () {
                        $("#customBackgroundBtn").text("Save");
                    }, 2000);
                });
            return false;
        });

    });
</script>
@stack('chat-script')
@stack('clocker-script')
@stack('notification-script')
    @yield('extra-scripts')
@livewireScripts

</body>

</html>
