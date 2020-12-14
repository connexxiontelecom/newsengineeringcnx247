@extends('layouts.app')

@section('title')
    Connect to QuickBooks
@endsection

@section('extra-styles')

@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 offset-sm-3 offset-md-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <h5 class="m-0">
                        Let's get you connected to QuickBooks!
                    </h5>
                    <p class="mt-3">
                      Click the <strong>Connect</strong> button to get connected to <strong>QuickBooks online.</strong>
                    </p>
                    @php
                     $displayString = isset($accessTokenJson) ? $accessTokenJson : "No Access Token Generated Yet";
                    @endphp
                     {{ json_encode($displayString, JSON_PRETTY_PRINT) }}
                    <button class="btn btn-primary btn-mini mt-2 float-right" onclick="oauth.loginPopup()" type="button">Connect</button>
                    <button class="btn btn-danger btn-mini mt-2 float-right" onclick="apiCall.getCompanyInfo()" type="button">Get Company Info</button>
                <pre id="apiCall"></pre>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
<script src="{{asset('assets/js/cus/axios.min.js')}}"></script>
    <script>

        var url = '<?php echo $authUrl; ?>';

        var OAuthCode = function(url) {

            this.loginPopup = function (parameter) {
                this.loginPopupUri(parameter);
            }

            this.loginPopupUri = function (parameter) {

                // Launch Popup
                var parameters = "location=1,width=800,height=650";
                parameters += ",left=" + (screen.width - 800) / 2 + ",top=" + (screen.height - 650) / 2;

                var win = window.open(url, 'connectPopup', parameters);
                var pollOAuth = window.setInterval(function () {
                    try {

                        if (win.document.URL.indexOf("code") != -1) {
                            window.clearInterval(pollOAuth);
                            win.close();
                            location.reload();
                        }
                    } catch (e) {
                        console.log(e)
                    }
                }, 100);
            }
        }


        var apiCall = function() {
            this.getCompanyInfo = function() {
                /*
                AJAX Request to retrieve getCompanyInfo
                 */
                 axios.get('/call-quickbooks')
                 .then(response=>{
                     $( '#apiCall' ).html( response );
                 });
            }

            this.refreshToken = function() {
                $.ajax({
                    type: "POST",
                    url: "refreshToken.php",
                }).done(function( msg ) {

                });
            }
        }

        var oauth = new OAuthCode(url);
        var apiCall = new apiCall();
    </script>
@endsection