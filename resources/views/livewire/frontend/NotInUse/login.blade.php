<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form class="md-float-material form-material" wire:submit.prevent="loginNow">
                    <div class="text-center">
                        <img src="/assets/images/logo.png" alt="logo.png" height="75" width="120">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center sub-title txt-primary">Sign in</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @if(session()->has('unverified'))
                                        <div class="alert alert-warning border-warning">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="icofont icofont-close-line-circled"></i>
                                            </button>
                                        
                                           {!! session('unverified') !!}  

                                        </div>
                                    @endif
                                    @if(session()->has('wrongCredentials'))
                                        <div class="alert alert-warning border-warning">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="icofont icofont-close-line-circled"></i>
                                            </button>
                                        
                                           {!! session('wrongCredentials') !!}  

                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <label for="">Email address</label>
                                <input wire:model.lazy="email" type="text" class="form-control" placeholder="Email address">
                                @error('email')
                                    <span class="mt-3">
                                        <i class="text-danger">{{ $message }}</i>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group form-primary">
                                <label for="">Password</label>
                                <input wire:model.lazy="password" type="password" class="form-control" placeholder="Password">
                                @error('password')
                                    <span class="mt-3">
                                        <i class="text-danger">{{ $message }}</i>
                                    </span>
                                @enderror
                            </div>
                            <div class="row m-t-25 text-left">
                                <div class="col-12">
                                    <div class="checkbox-fade fade-in-primary d-">
                                        <label>
                                            <input type="checkbox" wire:model="remember">
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">Remember me</span>
                                        </label>
                                    </div>
                                    <div class="forgot-phone text-right f-right">
                                        <a href="{{route('reset-password') }}" class="text-right f-w-600"> Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-30 d-flex justify-content-center">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20 btn-sm">Signin</button>
                                </div>
                                <div class="preloader3 loader-block" wire:loading wire.target="loginNow">
                                    <div class="circ1 loader-primary"></div>
                                    <div class="circ2 loader-primary"></div>
                                    <div class="circ3 loader-primary"></div>
                                    <div class="circ4 loader-primary"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-inverse text-left m-b-0">Thank you.</p>
                                    <p class="text-inverse text-left"><a href="{{ route('home') }}"><b class="f-w-600">Back to Homepage</b></a></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-inverse text-left m-b-0">Don't have an account?</p>
                                    <p class="text-inverse text-left"><a href="{{ route('signup') }}"><b class="f-w-600">Sign up</b></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>