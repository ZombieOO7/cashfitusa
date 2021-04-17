{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td style="padding: 0 20px;">
                @php
                $body = str_replace('[EMAIL]',@$email,$body);
                $body = str_replace('[USER FULL NAME]',@$display_name,$body);
                $body = str_replace('[LINK]','<a href="'.route('upload.document',['id'=>@$objectData->uuid]).'">Verify Now</a>',$body);
                $date = date('F jS Y, h:i A');
                @endphp
                {!! str_replace('[CONTENT]', @$content, $body) !!}
            </td>
        </tr>
    </table>
</body>
@php
// exit;
@endphp
</html> --}}
<html>

<head>
</head>

<body style="margin: 0;">
    <table width="100%" bgcolor="#fff" align="center">
        <tbody>
            <tr>
                <td align="center">
                    <table style="background: #fff" width="600" cellspacing="0" cellpadding="0" border="0"
                        bgcolor="#fff">
                        <tbody bgcolor="#ebebeb">
                            <tr>
                                <td style="padding: 30px 15px; background: #001c38;" valign="middle" align="left"><a
                                        href="#" target="_blank" style="text-decoration:none"
                                        title="Rapidcash America"><img alt="Rapidcash America"
                                            src="{{ asset('email/logo.png') }}"
                                            style="height:auto;display:block; max-width: 28%" border="0"></a></td>
                            </tr>
                            <tr>
                                <td style="padding-bottom:50px; padding-top: 20px;" class="imgPost" valign="top"
                                    align="center"><a href="#" style="text-decoration:none"><img alt="banner"
                                            src="{{ asset('email/identity-verifi-notifi-banner.png') }}"
                                            style="max-width:800px;height:auto;display:block" border="0"></a></td>
                            </tr>


                            <tr>
                                <td style="padding-bottom:20px;padding-left:30px;padding-right:30px;padding-top: 20px;"
                                    valign="top" align="left">
                                    <h4
                                        style="color:#000;font-family:'Arial';font-size:21px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-align:left;padding-bottom: 30px; margin:0">
                                        <strong>Hi {{ @$display_name }},</strong>
                                    </h4>
                                    <p class="midText"
                                        style="color:#000;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-right: 0px;">
                                        We hope you are having a good time with RapidCashAmerica. But to apply for loan
                                        you have to complete your identity verification. Without identity verification
                                        you cannot apply for loan.</p>

                                </td>
                            </tr>


                            <tr>
                                <td style="padding-bottom: 15px; text-align: center;display: block;">
                                    <a style="text-decoration:none;color: #fff; " href="{{route('upload.document',['id'=>@$objectData->uuid])}}">
                                        <h4
                                            style="font-size: 18px;color: #fff;margin-top: 0px;margin-bottom: 0; font-weight: 600;background: #001d38;border-radius: 5px;padding: 10px 30px;display: inline-block;font-family:'Arial';">
                                            Verify Now</h4>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-bottom:80px;padding-left:30px;padding-right:30px;padding-top: 0px;"
                                    valign="top" align="left">
                                    <p class="midText"
                                        style="color:#000;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-right: 0px;">
                                        You can trust us with your imformation. If you still have some doubts you can
                                        read our Privacy Policy.</p>
                                </td>
                            </tr>


                            <tr>
                                <td style="padding-bottom:12px;padding-left:30px;padding-right:30px;padding-top: 20px;"
                                    class="title" valign="top" align="left">

                                    <p class="midText"
                                        style="color:#000;font-family:'Arial';font-size:14px;font-weight:500;line-height:22px;text-align:left;padding:0;margin:0;padding-right: 0px;padding-bottom: 15px;">
                                        Thank you,</p>
                                    <h4 class="bigTitle"
                                        style="color:#000;font-family:'Arial';font-size:21px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-align:left;padding-bottom: 0px; margin:0">
                                        <strong>Rapid Cash America Team.</strong>
                                    </h4>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <hr style="border: 3px solid #001c38;">
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-bottom: 20px;padding-left: 140px;padding-right: 140px;">
                                    <a href="{{route('loan')}}"
                                        style="display:block;color:#000;font-family:'Arial';font-size:18px;font-weight:500;line-height:24px;text-decoration:none;text-align:left; padding-bottom: 5px;"
                                        target="_blank">
                                        <img alt="Linkdin" src="{{ asset('email/webhostimg.png') }}"
                                            style="height:auto;margin:5px;width: auto; display: inline-block;vertical-align: middle;"
                                            border="0">https://www.rapidcashamerica.com/
                                    </a>
                                    <a href="mailto:support@RapidcashAmerica.com"
                                        style="display:block;color:#000;font-family:'Arial';font-size:18px;font-weight:500;line-height:24px;text-decoration:none;text-align:left; padding-bottom: 5px;"
                                        target="_blank">
                                        <img alt="Linkdin" src="{{ asset('email/mailimg.png') }}"
                                            style="height:auto;margin:5px;width: auto; display: inline-block;vertical-align: middle;"
                                            border="0"> support@RapidcashAmerica.com
                                    </a>
                                    <a href="tel:+1 336-501-4510"
                                        style="display:block;color:#000;font-family:'Arial';font-size:18px;font-weight:500;line-height:24px;text-decoration:none;text-align:left; padding-bottom: 5px;"
                                        target="_blank">
                                        <img alt="Linkdin" src="{{ asset('email/callimg.png') }}"
                                            style="height:auto;margin:5px;width: auto; display: inline-block;vertical-align: middle;"
                                            border="0"> +1 336-501-4510
                                    </a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
@php
// exit;
@endphp