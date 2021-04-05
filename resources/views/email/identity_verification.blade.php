<!DOCTYPE html>
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
                $body = str_replace('[LINK]','<a href="'.route('upload.document',['id'=>@$objectData->id]).'">Verify Now</a>',$body);
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
</html>