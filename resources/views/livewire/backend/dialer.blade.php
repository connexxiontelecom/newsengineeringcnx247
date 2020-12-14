<div class="container">
    <form >
    <div class="row mb-3">
        <div class="col-md-12">
            <div id="dialer-screen" style="text-align:center; height:40px;">
            </div>
        </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button  value="1" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">1</button>
            </div>
            <div class="col-md-4">
                <button value="2" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">2</button>
            </div>
            <div class="col-md-4">
                <button value="3" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">3</button>
            </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button value="4" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">4</button>
            </div>
            <div class="col-md-4">
                <button value="5" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">5</button>
            </div>
            <div class="col-md-4">
                <button value="6" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">6</button>
            </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button value="7" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">7</button>
            </div>
            <div class="col-md-4">
                <button value="8" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">8</button>
            </div>
            <div class="col-md-4">
                <button value="9" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">9</button>
            </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button value="*" disabled type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">*</button>
            </div>
            <div class="col-md-4">
                <button value="0" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">0</button>
            </div>
            <div class="col-md-4">
                <button value="#" disabled type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">#</button>
            </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button value="+" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">+</button>
            </div>
            <div class="col-md-4">
                <button  type="button"   id="makeCall" class="makeCall btn btn-primary btn-icon"><i class="zmdi zmdi-phone"></i></button>
                <button  type="button" style="display:none;" id="endCall" class="endCall btn btn-danger btn-icon"><i class="zmdi zmdi-phone-end"></i></button>
            </div>
            <div class="col-md-4">
                <button type="button" class="deleteNumberBtn btn btn-danger btn-icon"><i class="zmdi zmdi-long-arrow-left"></i></button>
            </div>
    </div>
    @if(session()->has('stage'))
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="label-main">
                    <label class="label label-inverse-info-border">{{ $call_progress }}</label>
                </div>
            </div>
        </div>
    @endif
</form>
</div>

@push('dialer-script')
<script src="/js/vendor.js"></script>
<script src="/js/manifest.js"></script>
<script src="/js/browser-calls.js"></script>
<script>
    var screen = null;
    var phoneNumber = '';
    $(document).ready(function(){
        $(document).on('click', '.pressNumberBtn', function(e){
            var digit = $(this).val();
            updateContact(digit);
        });

        $(document).on('click', '.deleteNumberBtn', function(e){
            e.preventDefault();
            phoneNumber = phoneNumber.slice(0,-1);
            displayPhoneNumber();
        });
    });
    function updateContact(number){
        phoneNumber = phoneNumber + number;
        displayPhoneNumber();
    }
    function displayPhoneNumber() {
        $('#dialer-screen').text(phoneNumber);
    }
    function makeCall(){

    }







































</script>
@endpush
