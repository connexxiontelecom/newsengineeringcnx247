
<section class="bg-home d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-6">
                <div class="mr-lg-5">
                    <img src="/frontend/images/user/login.svg" class="img-fluid d-block mx-auto" alt="">
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="card login-page bg-white shadow rounded border-0">
                    <div class="card-body">
                        <h4 class="card-title text-center">Login</h4>
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
                            @if(session()->has('success'))
                                <div class="alert alert-success border-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled"></i>
                                    </button>

                                {!! session('success') !!}

                                </div>
                            @endif
                        <form class="login-form mt-4" wire:submit.prevent="loginNow">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group position-relative">
                                        <label>Your Email <span class="text-danger">*</span></label>
                                        <i data-feather="user" class="fea icon-sm icons"></i>
                                        <input type="email" wire:model.debounce.90000ms="email" class="form-control pl-5" placeholder="Email">
                                        @error('email')
                                            <span class="mt-3">
                                                <i class="text-danger">{{ $message }}</i>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group position-relative">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                        <input type="password" wire:model.debounce.90000ms="password" class="form-control pl-5" placeholder="Password">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" wire:model="remember" class="custom-control-input">
                                                <label class="custom-control-label" for="customCheck1">Remember me</label>
                                            </div>
                                        </div>
                                        <p class="forgot-pass mb-0"><a href="{{route('reset-password') }}" class="text-dark font-weight-bold">Forgot password ?</a></p>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                                </div>
                                <div class="col-12 text-center">
                                    <p class="mb-0 mt-3"><small class="text-dark mr-2">Don't have an account ?</small> <a href="{{route('pricing')}}" class="text-dark font-weight-bold">Sign Up</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


