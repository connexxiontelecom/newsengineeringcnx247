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
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#0073AA" style="padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold;">
                    <img class="img-fluid ml-5 mt-3" src="{{asset('/assets/images/company-assets/logos/'.$user->tenant->logo ?? 'logo.png')}}" alt="{{$user->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="75" width="120" style="display:block;">
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#ffffff" style="padding: 40px 20px 40px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px; border-bottom: 1px solid #f6f6f6;">
                    <b>Forgot your password? Let's get you a new one!</b>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#f9f9f9" style="padding: 20px 20px 0 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;">
                <p>Hi, {{ $user->first_name}}, you're receiving this mail because someone recently requested to reset your password on <strong>{{ config('app.name')}}</strong> </p>
                <p>Ignore this mail if you didn't request for this or you did it in error.</p>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 30px 20px; font-family: Arial, sans-serif; border-bottom: 1px solid #f6f6f6;">
                    <table bgcolor="#0073AA" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
                        <tr>
                            <td align="center" height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;" class="button">
                                <a href="{{url('/')}}/reset-password/{{$token}}" style="color: #ffffff; text-align: center; text-decoration: none;">Reset Password</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#ffffff" style="padding: 10px 20px 10px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 15px; line-height: 24px;">
                    <i>Ignore this mail if you didn't request for this or you did it in error.</i>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
                    <b>{{ config('app.name') }}</b><br>2A, Iller crescent Maitama, FCT, Abuja. +2349 2905 141
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
        <![endif]--></body>
</html>
