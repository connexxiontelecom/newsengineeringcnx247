<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Change Password</h5>
                <form wire:submit.prevent="changePassword">
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    @if (session()->has('warning'))
                        <div class="alert alert-warning background-warning mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('warning') !!}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Current Password</label>
                                <input type="password" class="form-control" placeholder="Current Password" wire:model.debounce.900000ms="current_password">
                                @error('current_password')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Choose New Password</label>
                                <input type="password" class="form-control" placeholder="Choose New Password" wire:model.debounce.900000ms="password">
                                @error('password')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Re-type Password</label>
                                <input type="password" class="form-control" placeholder="Re-type Password" wire:model.debounce.900000ms="password_confirmation">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <button class="btn btn-mini btn-danger" wire:click="cancelEdit" type="button"> <i class="ti-close"></i> Cancel</button>
                            <button class="btn btn-mini btn-primary" type="submit"> <i class="ti-lock"></i> Change password</button>
                            <div class="preloader3 loader-block" wire:loading wire.target="changePassword">
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
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Set Transaction Password</h5>
                <form wire:submit.prevent="setTransactionPassword">
                    @if (session()->has('trans_success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('trans_success') !!}
                        </div>
                    @endif
                    @if (session()->has('trans_warning'))
                        <div class="alert alert-warning background-warning mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('trans_warning') !!}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Transaction Password</label>
                                <input type="password" class="form-control" placeholder="Transaction Password" wire:model.debounce.900000ms="transaction_password">
                                @error('transaction_password')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Confirm Transaction Password</label>
                                <input type="password" class="form-control" placeholder="Confirm Transaction Password" wire:model.debounce.900000ms="confirm_transaction_password">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <button class="btn btn-mini btn-danger" wire:click="cancelEdit" type="button"> <i class="ti-close"></i> Cancel</button>
                            <button class="btn btn-mini btn-primary" type="submit"> <i class="ti-lock"></i> Set Transaction Password</button>
                            <div class="preloader3 loader-block" wire:loading wire.target="setTransactionPassword">
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
    </div>
</div>


