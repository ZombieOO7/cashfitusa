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
							<td style="padding: 30px 15px; background: #001c38;" valign="middle" align="left"><a href="#" target="_blank" style="text-decoration:none" title="Rapidcash America"><img alt="Rapidcash America" src="{{asset('email/logo.png')}}" style="height:auto;display:block; max-width: 28%" border="0"></a></td>
						</tr>
						<tr>
							<td style="padding-bottom:50px; padding-top: 20px;" class="imgPost" valign="top" align="center"><a href="#" style="text-decoration:none"><img alt="banner" src="{{asset('email/identity-verifi-comple-banner.png')}}" style="max-width:800px;height:auto;display:block" border="0"></a></td>
						</tr>


						<tr>
							<td style="padding-bottom:0px;padding-left:30px;padding-right:30px;padding-top: 20px;" class="title" valign="top" align="left">
								<h4 style="color:#000;font-family:'Arial';font-size:21px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-align:left;padding-bottom: 30px; margin:0"><strong>Hi {{@$display_name}},</strong>
								</h4>
								<p class="midText" style="color:#000;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-right: 0px;padding-bottom: 20px;">Congratulations! It gives us an immense pleasure to inform you that your documents has been completely verified by our Rapid Cash America’s Verification Team.</p>
								<p class="midText" style="color:#000;font-family:'Arial';font-size:14px;font-weight:400;line-height:22px;text-align:left;padding:0;margin:0;padding-right: 0px; padding-bottom: 20px;">In order to procees ahead with your application please click on the button given below.</p>
							</td>
						</tr>
						<tr>
							<td style="padding-bottom: 100px; text-align: center;display: block !important;">
								<a style="text-decoration:none;color: #fff; " href="{{ route('account-verification',['id'=>@$objectData->uuid]) }}"><h4 style="font-size: 24px;color: #fff;margin-top: 10px;margin-bottom: 0;min-width: 100px;  font-weight: 600;background: #00a05e;border-radius: 5px;padding: 4px 8px;display: inline-block !important;font-family:'Arial';">Continue</h4></a>
							</td>
						</tr>



						<tr>
							<td style="padding-bottom:12px;padding-left:30px;padding-right:30px;padding-top: 20px;" class="title" valign="top" align="left">
								
								<p class="midText" style="color:#000;font-family:'Arial';font-size:14px;font-weight:500;line-height:22px;text-align:left;padding:0;margin:0;padding-right: 0px;padding-bottom: 15px;">Thank you,</p>
								<h4 class="bigTitle" style="color:#000;font-family:'Arial';font-size:21px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-align:left;padding-bottom: 0px; margin:0"><strong>Rapid Cash America Team.</strong>
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