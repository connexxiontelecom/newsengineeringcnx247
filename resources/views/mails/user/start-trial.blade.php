<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>{{config('app.name')}}</title>
        <meta name="viewport" content="width=device-width">
        <link rel="icon" href="img\favicon.ico" type="image/x-icon">
       <style type="text/css">
            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                body[yahoo] .buttonwrapper { background-color: transparent !important; }
                body[yahoo] .button { padding: 0 !important; }
                body[yahoo] .button a { background-color: #9b59b6; padding: 15px 25px !important; }
            }

            @media only screen and (min-device-width: 601px) {
                .content { width: 600px !important; }
                .col387 { width: 387px !important; }
            }
        </style>
    </head>
    <body bgcolor="#34495E" style="margin: 0; padding: 0;" yahoo="fix">
        <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
        <![endif]-->
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
            <tr>
                <td style="padding: 15px 10px 15px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="center" style="color: #fff; font-family: Arial, sans-serif; font-size: 12px;">
                                Email not displaying correctly?  <a href="#" style="color:#0073AA;">View it in your browser</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#0073AA " style="padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold;">
                    <img class="img-fluid ml-5 mt-3" src="{{asset('/assets/images/company-assets/logos/logo.png')}}" alt="{{config('app.name')}}" height="75" width="120" style="display:block;">
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#ffffff" style="padding: 75px 20px 40px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px; border-bottom: 1px solid #f6f6f6;">
                    <p>Great news, {{$user->first_name}}!</p>
										<p>Your site is now up and running - just log in with your username <strong class="text-primary">{{$user->email}}</strong>	and password to get started.
											</p>
											<p>This is your step towards saving dozens of working hours each month - and that's not a number we just made up.</p>

										<p>Go ahead, take a look around! We’ll be in touch shortly with more tips to help you get the most out of your trial.</p>
                    <p>
                        <a href="{{route('signin')}}" style="color: #00B2B2; text-align: center; text-decoration: none;">Click here </a> to login
										</p>

                    <p>
												Here's to working smarter! <br>
												<img class="img-fluid ml-5 mt-3" src="{{asset('/assets/images/company-assets/logos/logo.png')}}" alt="{{config('app.name')}}" height="75" width="120" style="display:block;">
                        {{config('app.sponsor')}}<br>
                        {{config('app.email')}} <br>
                        {{config('app.phone')}} <br>
                        {{config('app.address')}} <br>
                    </p>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
                    <b>{{ config('app.name') }}</b><br> {{config('app.address')}}
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 10px 15px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="center" width="100%" style="color: #fff; font-family: Arial, sans-serif; font-size: 12px;">
                                {{date('Y')}} &copy; <a href="{{config('app.sponsor_website')}}" style="color: #0073AA;">{{config('app.name')}}</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
                </td>
            </tr>
        </table>
        <![endif]-->
    </body>
</html>
