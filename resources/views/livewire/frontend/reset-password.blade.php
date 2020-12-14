<section class="bg-home d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-6">
                <div class="mr-lg-5">
                    <img src="/frontend/images/user/recovery.svg" class="img-fluid d-block mx-auto" alt="">
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="card login_page shadow rounded border-0">
                    <div class="card-body">
                        <h4 class="card-title text-center">Recover Account</h4>

                        <form class="login-form mt-4" wire:submit.prevent="resetPassword">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(session()->has('error'))
                                        <div class="alert alert-warning border-warning">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="icofont icofont-close-line-circled"></i>
                                            </button>

                                           {!! session('error') !!}

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
                                    <p class="text-muted">Kindly enter your registered email below. You will receive a link to create a new password via email for your account.</p>
                                    <div class="form-group position-relative">
                                        <label>Email address <span class="text-danger">*</span></label>
                                        <i data-feather="mail" class="fea icon-sm icons"></i>
                                        <input type="email" wire:model.debounce.90000ms="email" class="form-control pl-5" placeholder="Email Address">
                                        @error('email')
                                        <span class="mt-5">
                                                <i class="text-danger">{{ $message }}</i>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-primary btn-block" type="submit">Send</button>
                                </div>
                                <div class="mx-auto">
                                    <p class="mb-0 mt-3"><small class="text-dark mr-2">Remember your password ?</small> <a href="{{route('signin')}}" class="text-dark font-weight-bold">Sign in</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
