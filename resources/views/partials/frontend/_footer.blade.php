<footer class="footer bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                <a href="#" class="logo-footer">
                    <img src="{{asset('/frontend/images/logo.png')}}" height="80" alt="">
                </a>
                <p class="mt-2"><span class="text-primary font-weight-bold">CNX247</span> is an enterprise resource planning solution designed to suit the modern African workplace and enables you to manage your business smartly.</p>
                <ul class="list-unstyled social-icon social mb-0 mt-4">
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="facebook" class="fea icon-sm fea-social"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="instagram" class="fea icon-sm fea-social"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="twitter" class="fea icon-sm fea-social"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="linkedin" class="fea icon-sm fea-social"></i></a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h4 class="text-dark footer-head">Software</h4>
                <ul class="list-unstyled footer-list mt-3">
                    <li><a href="{{route('product')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Product</a></li>
                    <li><a href="{{route('pricing')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Pricing</a></li>
                    <li><a href="{{route('contact_us')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Contact Us</a></li>
                    <li><a href="javascript:void(0)" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Help Center</a></li>
{{--                    <li><a href="javascript:void(0)" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Logistics</a></li>--}}
                </ul>
            </div>

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h4 class="text-dark footer-head">Useful Links</h4>
                <ul class="list-unstyled footer-list mt-3">
                    <li><a href="https://telecom.connexxiongroup.com/company-overview" target="_blank" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> About Us</a></li>
                    <li><a href="javascript:void(0)" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Terms of Services</a></li>
                    <li><a href="javascript:void(0)" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Privacy Policy</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h4 class="text-dark footer-head">Start Today</h4>
                <p class="mt-3">Get your team on board and start collaborating.</p>
                <form>
                    <div class="row">
                        <div class="col-lg-12">
{{--                            <a href="javascript:void(0)" class="btn btn-outline-primary btn-block">Start Free</a>--}}
                            <a href="{{route('pricing')}}" class="btn btn-primary btn-block">Sign Up</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>
<footer class="footer footer-bar">
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="text-sm-left">
                    <p class="mb-0">© {{date('Y')}} All Rights Reserved <a href="https://telecom.connexxiongroup.com/" target="_blank" class="text-reset">Connexxion Telecom</a>.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<a href="#" class="btn btn-icon btn-outline-primary back-to-top"><i data-feather="arrow-up" class="icons"></i></a>

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
