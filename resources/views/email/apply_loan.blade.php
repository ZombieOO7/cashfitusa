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
                $date = date('F jS Y, h:i A');
                @endphp
                {!! str_replace('[CONTENT]', @$content, $body) !!}
                
                <table>
                    <tr> 
                        <td>
                            Date : - 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{@$objectData->created_at}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Loan Application No. :-
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{@$objectData->auto_account_number}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Loan Amount : -
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{@$objectData->amount}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Name of Bank : -
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{@$objectData->bank_name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Loan Amount
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{@$objectData->amount}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Account Number : - 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{@$objectData->account_number}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Re-payment / per month : - 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{@$objectData->repayment_amount}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Routing Number : - 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{@$objectData->routing_number}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Rate of Intrest : - 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            8% / per month 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tenure 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{@$objectData->months}} months 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Total Re-payment : - 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{@$objectData->repayment_amount}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Last Re-payment Date : - 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{@$objectData->lastTransaction->date}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
@php
// exit;
@endphp
</html>