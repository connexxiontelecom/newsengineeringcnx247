<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>{{Auth::user()->tenant->company_name}}</title>
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
                    <img class="img-fluid ml-5 mt-3" src="{{asset('/assets/images/company-assets/logos/'.Auth::user()->tenant->logo ?? 'logo.png')}}" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="75" width="120" style="display:block;">
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#ffffff" style="padding: 75px 20px 40px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px; border-bottom: 1px solid #f6f6f6;">
                    <b>Just one more step...{{ $user->first_name }}</b><br>
                    Click the big button below to activate your account.
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 30px 20px; font-family: Arial, sans-serif;">
                    <table bgcolor="#0073AA" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
                        <tr>
                            <td align="center" height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;" class="button">
                                <a href="{{url('/')}}/verify/{{$user->verification_link}}" style="color: #ffffff; text-align: center; text-decoration: none;">Activate Account</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
                    <b>{{ Auth::user()->tenant->company_name }}</b><br> {{Auth::user()->tenant->street_1 ?? '2A, Iller crescent Maitama, FCT, Abuja. +2349 2905 141'}} {{Auth::user()->tenant->postal_code ?? ''}} {{Auth::user()->tenant->city}}
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 10px 15px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="center" width="100%" style="color: #fff; font-family: Arial, sans-serif; font-size: 12px;">
                                2020 &copy; <a href="https://connexxiongroup.com/" style="color: #0073AA;">Connexxion Group</a>
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
