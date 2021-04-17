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
</html> --}}
<html>
<head>
</head>
<body style="margin: 0;"><table width="100%" bgcolor="#fff" align="center">
	<tbody>
		<tr>
		<td align="center">
			<table style="background: #fff" width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#fff"> 				
					<tbody bgcolor="#ebebeb">
						<tr>
							<td style="padding: 30px 15px; background: #001d38;" valign="middle" align="left"><a href="#" target="_blank" style="text-decoration:none" title="Rapidcash America"><img alt="Rapidcash America" src="{{asset('email/logo.png')}}" style="height:auto;display:block; max-width: 28%" border="0"></a></td>
						</tr>
						<tr>
							<td style="padding-bottom:50px; padding-top: 20px;" class="imgPost" valign="top" align="center"><a href="#" style="text-decoration:none"><img alt="banner" src="{{asset('email/loan-credited-banner.png')}}" style="max-width:800px;height:auto;display:block" border="0"></a></td>
						</tr>

						<tr>
							<td style="padding-bottom: 0px; text-align: center;display: block;">
								<h4 style="font-size: 20px;color: #fff;margin-top: 0px;margin-bottom: 15px; font-weight: 600;background: #001d38;border-radius: 10px;padding: 12px 40px;display: inline-block;font-family:'Arial';">Report Problem</h4>
							</td>
						</tr>

						<tr>
							<td>
								<table cellspacing="0" cellpadding="0" border="0" style="background: #dfdfdf;margin: auto;padding: 15px 20px;width: 540px;margin-bottom: 10px;">
									<tbody>
								<tr>
									<td style="width: 50%;display: inline-block;vertical-align: middle;">
										<p style="color:#001d38;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-bottom: 20px;">
											<b style="font-weight: 700;color: #000;font-size: 16px;display: block;padding-bottom: 10px;">Date :-</b>
											{{@$objectData->proper_created_at_text}}
										</p>
										<p style="color:#001d38;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-bottom: 0px;">
											<b style="font-weight: 700;color: #000;font-size: 16px;display: block;padding-bottom: 10px;">Loan Amount :-</b>
											${{@$objectData->loan_amount}}
										</p>
									</td>
									<td style="width: 50%;display: inline-block;vertical-align: middle;">
										<p style="color:#001d38;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-bottom: 20px;">
											<b style="font-weight: 700;color: #000;font-size: 16px;display: block;padding-bottom: 10px;">Loan Application No. :-</b>
											{{@$objectData->auto_account_number}}
										</p>
									</td>
								</tr>
								</tbody>
								</table>
							</td>
						</tr>

						<tr>
							<td>
								<table cellspacing="0" cellpadding="0" border="0" style="background: #dfdfdf;margin: auto;padding: 15px 20px;width: 540px;margin-bottom: 10px;">
									<tbody>
								<tr>
									<td style="width: 50%;display: inline-block;vertical-align: middle;">
										<p style="color:#001d38;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-bottom: 20px;">
											<b style="font-weight: 700;color: #000;font-size: 16px;display: block;padding-bottom: 10px;">Name of Bank :-</b>
											{{strtoupper(@$objectData->bank_name)}}
										</p>
										<p style="color:#001d38;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-bottom: 20px;">
											<b style="font-weight: 700;color: #000;font-size: 16px;display: block;padding-bottom: 10px;">Account Number :-</b>
											{{@$objectData->account_number}}
										</p>
										<p style="color:#001d38;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-bottom: 0px;">
											<b style="font-weight: 700;color: #000;font-size: 16px;display: block;padding-bottom: 10px;">Routing Number :-</b>
											{{@$objectData->routing_number}}
										</p>
									</td>
									<td style="width: 50%;display: inline-block;vertical-align: middle;">
										<p style="color:#001d38;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-bottom: 20px;">
											<b style="font-weight: 700;color: #000;font-size: 16px;display: block;padding-bottom: 10px;">Loan Amount :-</b>
											${{@$objectData->loan_amount}}
										</p>
										<p style="color:#001d38;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-bottom: 20px;">
											<b style="font-weight: 700;color: #000;font-size: 16px;display: block;padding-bottom: 10px;">Re-payment / per month :-</b>
											${{@$objectData->repayment_amount}}
										</p>
										<p style="color:#001d38;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-bottom: 0px;">
											<b style="font-weight: 700;color: #000;font-size: 16px;display: block;padding-bottom: 10px;">Rate of Intrest :-</b>
											8% / per annum
										</p>
									</td>
								</tr>
								</tbody>
								</table>
							</td>
						</tr>

						<tr>
							<td>
								<table cellspacing="0" cellpadding="0" border="0" style="background: #dfdfdf;margin: auto;padding: 15px 20px;width: 540px;margin-bottom: 10px;">
									<tbody>
								<tr>
									<td style="width: 50%;display: inline-block;vertical-align: top;">
										<p style="color:#001d38;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-bottom: 20px;">
											<b style="font-weight: 700;color: #000;font-size: 16px;display: block;padding-bottom: 10px;">Tenure :-</b>
											{{@$objectData->months}} months
										</p>
										<p style="color:#001d38;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-bottom: 0px;">
											<b style="font-weight: 700;color: #000;font-size: 16px;display: block;padding-bottom: 10px;">Last Re-payment Date :-</b>
											{{@$objectData->lastTransaction->proper_date}}
										</p>
									</td>
									<td style="width: 50%;display: inline-block;vertical-align: top;">
										<p style="color:#001d38;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-bottom: 0px;">
											<b style="font-weight: 700;color: #000;font-size: 16px;display: block;padding-bottom: 10px;">Total Re-payment :-</b>
											{{@$objectData->transaction_amount}}
										</p>
									</td>
								</tr>
								</tbody>
								</table>
							</td>
						</tr>

						<tr>
							<td style="padding-bottom:0px;padding-left:30px;padding-right:30px;padding-top: 0px;padding-bottom: 0px;" valign="top" align="left">
								<p class="midText" style="color:#000;font-family:'Arial';font-size:16px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-right: 0px; padding-bottom: 0px;">Your Loan Amount is been credited in your account.</p>
								
							</td>
						</tr>

						


						<tr>
							<td style="padding-bottom:12px;padding-left:30px;padding-right:30px;padding-top: 0px;" class="title" valign="top" align="left">
								<p class="midText" style="color:#000;font-family:'Arial';font-size:14px;font-weight:500;line-height:22px;text-align:left;padding:0;margin:0;padding-right: 0px;padding-bottom: 50px;">Thank you,</p>
								<h4 style="color:#000;font-family:'Arial';font-size:21px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-align:right;padding-bottom: 0px; margin:0"><strong>Rapid Cash America Team.</strong>
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
								<a href="{{route('loan')}}" style="display:block;color:#000;font-family:'Arial';font-size:18px;font-weight:500;line-height:24px;text-decoration:none;text-align:left; padding-bottom: 5px;" target="_blank">
									<img alt="Linkdin" src="{{asset('email/webhostimg.png')}}" style="height:auto;margin:5px;width: auto; display: inline-block;vertical-align: middle;" border="0">https://www.rapidcashamerica.com/
								</a>
								<a href="mailto:support@RapidcashAmerica.com" style="display:block;color:#000;font-family:'Arial';font-size:18px;font-weight:500;line-height:24px;text-decoration:none;text-align:left; padding-bottom: 5px;" target="_blank">
									<img alt="Linkdin" src="{{asset('email/mailimg.png')}}" style="height:auto;margin:5px;width: auto; display: inline-block;vertical-align: middle;" border="0"> support@RapidcashAmerica.com
								</a>
								<a href="tel:+1 336-501-4510" style="display:block;color:#000;font-family:'Arial';font-size:18px;font-weight:500;line-height:24px;text-decoration:none;text-align:left; padding-bottom: 5px;" target="_blank">
									<img alt="Linkdin" src="{{asset('email/callimg.png')}}" style="height:auto;margin:5px;width: auto; display: inline-block;vertical-align: middle;" border="0"> +1 336-501-4510
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