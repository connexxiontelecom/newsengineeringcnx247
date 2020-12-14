<form wire:submit.prevent="saveGeneralSettings">
    @if (session()->has('success'))
        <div class="alert alert-success background-success mt-3">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="icofont icofont-close-line-circled text-white"></i>
            </button>
            {!! session()->get('success') !!}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Company Name</label>
                <input type="text" placeholder="Company Name" wire:model="company_name" class="form-control">
                @error('company_name')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Tagline</label>
                <input type="text" placeholder="Tagline" wire:model="tagline" class="form-control">
                @error('tagline')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Company Email</label>
                <input type="text" placeholder="Company Email" readonly wire:model="company_email" class="form-control" value="{{Auth::user()->tenant->email ?? ''}}">
                @error('company_email')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Phone</label>
                <input type="text" placeholder="Phone" wire:model="phone" class="form-control">
                @error('phone')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Industry</label>
                <select wire:model="industry" class="form-control">
                    @foreach ($industries as $value)
                        <option value="{{$value->id}}">{{$value->industry ?? ''}}</option>
                    @endforeach
                </select>
                @error('industry')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Preferred Language</label>
                    <select wire:model="preferred_lang" class="form-control">
                        <option value="1">English</option>
                        <option value="2">French</option>
                    </select>
                @error('preferred_lang')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Date Format</label>
                    <select wire:model="date_format" class="form-control">
                        @foreach ($date_formats as $df)
                            <option value="{{$df->id}}">{{$df->format}}</option>
                        @endforeach
                    </select>
                @error('date_format')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Company Prefix</label>
                    <input type="text" wire:model="company_prefix" placeholder="Company Prefix (Ex. CNX)" class="form-control">
                @error('company_prefix')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-3 col-sm-3">
            <div class="form-group">
                <label for="">Opening Time</label>
                <input type="time" class="form-control" wire:model.debounce.9000ms="opening_time" placeholder="Opening Time">
                @error('opening_time')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-3">
            <div class="form-group">
                <label for="">Closing Time</label>
                <input type="time" class="form-control" wire:model.debounce.9000ms="closing_time" placeholder="Closing Time">
                @error('closing_time')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-3">
            <div class="form-group">
                <label for="">Clock-in Grace Period <small>(minutes)</small> <abbr data-toggle="tooltip" data-placement="top" title="" data-original-title="A period after which the clock-in button will no longer be accessible."><i class="ti-help"></i></abbr></label>
                <input type="number" class="form-control" wire:model.debounce.9000ms="grace_period" placeholder="Grace Period">
                @error('grace_period')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-3">
            <div class="form-group">
                <label for="">Timezone</label>
                <input type="number" class="form-control" wire:model.debounce.9000ms="timezone" placeholder="Grace Period">
                @error('timezone')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 class="sub-title">Address</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Street 1</label>
                <input type="text" placeholder="Street 1" wire:model="street_1" class="form-control">
                @error('street_1')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Street 2</label>
                <input type="text" placeholder="Street 2" wire:model="street_2" class="form-control">
                @error('street_2')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">City</label>
                <input type="text" placeholder="City" wire:model="city" class="form-control">
                @error('city')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Postal Code</label>
                <input type="text" placeholder="Postal Code" wire:model="postal_code" class="form-control">
                @error('postal_code')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Email Signature</label>
                <textarea wire:model="email_signature" class="form-control" placeholder="Your faithfully, ..."></textarea>
                @error('email_signature')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group" wire:ignore>
                <label for="">About us</label>
                <textarea name="about_us" id="about_us" class="form-control content" placeholder="Brief about your company">{{Auth::user()->tenant->description ?? ''}}</textarea>
                @error('about_us')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="btn-group d-flex justify-content-center">
                <a href="{{url()->previous()}}" class="btn btn-secondary btn-mini"> <i class="ti-close"></i> Cancel</a>
                <button class="btn btn-success btn-mini" type="submit"> <i class="ti-check"></i> Save changes</button>
                <div class="preloader3 loader-block" wire:loading wire.target="saveGeneralSettings">
                    <div class="circ1 loader-primary"></div>
                    <div class="circ2 loader-primary"></div>
                    <div class="circ3 loader-primary"></div>
                    <div class="circ4 loader-primary"></div>
                </div>
            </div>
        </div>
    </div>
</form>
@push('general-scripts')
<script>
    $(document).ready(function(){
        var description = tinyMCE.activeEditor.getContent(); //$("#description").val();
        $(document).on('change', '#about_us', function(e){
           // var description = tinyMCE.get('#about_us').getContent();
            var description = $('#' + 'about_us').html( tinymce.get('about_us').getContent() );
            console.log(description);
        });
    });
</script>
@endpush
