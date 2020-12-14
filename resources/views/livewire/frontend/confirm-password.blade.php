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

                        <form class="login-form mt-4" wire:submit.prevent="setNewPassword">
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
                                    <p class="text-muted">You've successfully verified your account. Enter new password below.</p>
                                    <div class="form-group position-relative">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input  wire:model.debounce.500000ms="password" type="password"  class="form-control"  placeholder="New Password">
                                        @error('password')
                                        <span class="mt-5">
                                                <i class="text-danger">{{ $message }}</i>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group position-relative">
                                        <label>Re-type Password <span class="text-danger">*</span></label>
                                        <input  wire:model.debounce.500000ms="password_confirmation" type="password"  class="form-control"  placeholder="Re-type Password">
                                        @error('password_confirmation')
                                        <span class="mt-5">
                                                <i class="text-danger">{{ $message }}</i>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="hidden" name="token" value="{{$link}}">
                                    <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
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

