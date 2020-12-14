<div>
    <h3 class="sub-title">Invoice & Receipt</h3>
    <form wire:submit.prevent="submitFinanceSettings">
        @if (session()->has('success'))
            <div class="alert alert-success background-success mt-3">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled text-white"></i>
                </button>
                {!! session()->get('success') !!}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Invoice Terms & Conditions</label>
                    <textarea wire:model.lazy="invoice_terms" class="form-control" placeholder="Invoice Terms & Conditions"></textarea>
                    @error('invoice_terms')
                        <i class="text-danger mt-2">{{$message}}</i>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Receipt Terms & Conditions</label>
                    <textarea wire:model.lazy="receipt_terms" class="form-control" placeholder="Receipt Terms & Conditions"></textarea>
                    @error('receipt_terms')
                        <i class="text-danger mt-2">{{$message}}</i>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Preferred Currency</label>
                    <select wire:model.lazy="preferred_currency" class="form-control">
                        <option selected disabled>Select Preferred Currency</option>
                        @foreach ($currencies as $currency)
                            <option value="{{$currency->id}}">{{$currency->name ?? ''}} ({{$currency->symbol}})</option>
                        @endforeach
                    </select>
                    @error('preferred_currency')
                        <i class="text-danger mt-2">{{$message}}</i>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Currency Position</label>
                    <select wire:model.lazy="currency_position" class="form-control">
                        <option selected disabled>Select Currency Position</option>
                        <option value="1">Prefix</option>
                        <option value="2">Suffix</option>
                    </select>
                    @error('currency_position')
                        <i class="text-danger mt-2">{{$message}}</i>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <button class="btn btn-mini btn-success" type="submit"><i class="ti-check mr-2"></i>Save Changes</button>
                <div class="preloader3 loader-block" wire:loading wire.target="submitFinanceSettings">
                    <div class="circ1 loader-primary"></div>
                    <div class="circ2 loader-primary"></div>
                    <div class="circ3 loader-primary"></div>
                    <div class="circ4 loader-primary"></div>
                </div>
            </div>
        </div>
    </form>
    <h3 class="sub-title">Bank Details</h3>
    <div class="offset-md-1">
        <p class="text-muted"> <strong class="text-danger">Note:</strong> The company's invoice will bear this bank details. </p>
        <form wire:submit.prevent="submitBankDetails">
            @if (session()->has('bank-success'))
                <div class="alert alert-success background-success mt-3">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="icofont icofont-close-line-circled text-white"></i>
                    </button>
                    {!! session()->get('bank-success') !!}
                </div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="">Bank Name</label>
                        <input type="text" wire:model.debounce.90000ms="bank_name" class="form-control" placeholder="Bank Name">
                        @error('bank_name')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Account Name</label>
                        <input type="text" wire:model.debounce.90000ms="account_name" class="form-control" placeholder="Account Name">
                        @error('account_name')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Account Number</label>
                        <input type="text" wire:model.debounce.90000ms="account_number" class="form-control" placeholder="Account Number">
                        @error('account_number')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Account Type</label>
                        <select wire:model.debounce.90000ms="account_type" class="form-control col-md-4">
                            <option value="0">Savings</option>
                            <option value="1">Current</option>
                        </select>
                        @error('account_type')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <button class="btn btn-mini btn-success" type="submit"><i class="ti-check mr-2"></i>Save Changes</button>
                    <div class="preloader3 loader-block" wire:loading wire.target="submitBankDetails">
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
