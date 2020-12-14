@include('partials.frontend._header')
<body>
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
@include('partials.frontend._header-menu')

    @yield('content')

@include('partials.frontend._footer')
