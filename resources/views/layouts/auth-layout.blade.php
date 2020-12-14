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

@yield('content')

<script src="{{asset('/frontend/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('/frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/frontend/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('/frontend/js/scrollspy.min.js')}}"></script>
<script src="{{asset('/frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('/frontend/js/owl.init.js')}}"></script>
<script src="{{asset('/frontend/js/feather.min.js')}}"></script>
<script src="{{asset('/frontend/js/swiper.min.js')}}"></script>
<script src="{{asset('/frontend/js/swiper.init.js')}}"></script>
<script src="{{asset('/frontend/js/jquery.flexslider-min.js')}}"></script>
<script src="{{asset('/frontend/js/flexslider.init.js')}}"></script>
<script src="https://unicons.iconscout.com/release/v2.1.9/script/monochrome/bundle.js"></script>

<script type="text/javascript" src="{{asset('/assets/js/cus/axios.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/js/cus/notify.js')}}"></script>
@livewireScripts
@yield('extra-scripts')
<script src="{{asset('/frontend/js/app.js')}}"></script>
</body>
</html>
