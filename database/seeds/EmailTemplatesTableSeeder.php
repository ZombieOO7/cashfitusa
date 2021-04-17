<?php

use Illuminate\Database\Seeder;

class EmailTemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('email_templates')->delete();
        
        \DB::table('email_templates')->insert(array (
            0 => 
            array (
                'id' => 6,
                'uuid' => 'e884ade7-4a79-4168-9512-0302d90600a7',
                'title' => 'Login',
                'slug' => 'login',
                'subject' => 'Login Notification',
                'body' => '<p><strong>Hi there,<br />
&nbsp;&nbsp;&nbsp;&nbsp; </strong>Your Mydigitalgoodies account was just signed in with the following device. You&#39;re getting this email to make sure that is was you.<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong> [USER FULL NAME]<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [EMAIL]</strong><br />
[CONTENT]</p>',
                'status' => 1,
                'created_at' => '2021-04-01 17:09:24',
                'updated_at' => '2021-04-16 16:40:02',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 7,
                'uuid' => 'ee3f5902-fbe2-4091-9f6d-51a130271c9e',
                'title' => 'Reset Password',
                'slug' => 'reset-password',
                'subject' => 'Reset Password',
                'body' => '<p><strong>HI </strong>[USER FULL NAME],<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We have received your request for a password reset, which you do here. This link will expire in 15 minutes,<br />
Your new password must include:<br />
&nbsp;</p>

<ul>
<li>one uppercase</li>
<li>one lowercase</li>
<li>one number</li>
</ul>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [LINK]</p>',
                'status' => 1,
                'created_at' => '2021-04-03 06:04:38',
                'updated_at' => '2021-04-03 09:57:06',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 8,
                'uuid' => '9d3ae5ee-911a-446d-9440-8c66c483d0b0',
                'title' => 'Loan Application',
                'slug' => 'loan-application',
                'subject' => 'Loan Application',
                'body' => '<p><strong>Hi </strong>[USER FULL NAME],<br />
Thank you for choosing us,<br />
<br />
[CONTENT]</p>',
                'status' => 1,
                'created_at' => '2021-04-03 13:49:24',
                'updated_at' => '2021-04-03 17:50:39',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 9,
                'uuid' => '222f2493-5426-416f-a2fa-9b69f41be96b',
                'title' => 'Identity Verification',
                'slug' => 'identity-verification',
                'subject' => 'Identity Verification',
                'body' => '<p><strong>Hi </strong>[USER FULL NAME],<br />
We hope you are having a good time with RapidCashAmerica. But to apply for loan you have to complete your identity verification. Without identity verification you cannot apply for loan</p>

<p>[LINK]<br />
<br />
You can trust us with your information. If you still have some doubts you can read our Pricacy Policy.<br />
<br />
Thank you,<br />
<br />
<strong>Rapid Cash America Team.</strong></p>',
                'status' => 1,
                'created_at' => '2021-04-03 20:52:16',
                'updated_at' => '2021-04-03 20:52:16',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 10,
                'uuid' => '1d00a9de-0737-4c8f-a3aa-bcb6ebb3d420',
                'title' => 'Identity Verification Under Process',
                'slug' => 'identity-verification-under-process',
                'subject' => 'Identity Verification Under Process',
                'body' => '<p><strong>Hi </strong>[USER FULL NAME],<br />
The docuement you <strong>Have </strong>submitted are under process of verification. <strong>THIS PROCESS IS FOR VERIFYING </strong>whether a real person is using the account and living on the same address provided to us.</p>

<p>In order to verify the documents provided by user we have to undergo many verification steps hence the process sometimes.<br />
<br />
Thank you,<br />
<strong>Rapid Cash America Team.</strong></p>',
                'status' => 1,
                'created_at' => '2021-04-03 21:15:47',
                'updated_at' => '2021-04-03 21:15:47',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 11,
                'uuid' => '49db7b64-f594-4381-86d9-998a473241c2',
                'title' => 'Identity Verification Completed',
                'slug' => 'identity-verification-completed',
                'subject' => 'Identity Verification Completed',
                'body' => '<p><strong>HI </strong>[USER FULL NAME],</p>

<p>Congratualations! it gives us an immense pleasure to inform you that your documents has completely verified by our Rapid Cash America&#39;s Verification Team.</p>

<p>In order to process ahead with your application please click on the button given below</p>

<p>[LINK]</p>',
                'status' => 1,
                'created_at' => '2021-04-03 21:28:34',
                'updated_at' => '2021-04-03 21:28:34',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 12,
                'uuid' => 'c4736564-0881-4fe1-89f3-d406a3de6ccf',
                'title' => 'Identity Verification Rejected',
                'slug' => 'identity-verification-rejected',
                'subject' => 'Identity Verification Rejected',
                'body' => '<p><strong>Hi</strong> [USER FULL NAME],<br />
<br />
We are sorry to inform you that you identity verification has been rejected due to some error in your information. So to continue you can upload your information again carefully.</p>

<p>If you are having some problem in uploading the information we have added some tips on our pages according to it you can upload your information.</p>

<p>Please avoid uploading fake information otherwise leagal action will be taken against the respective.</p>',
                'status' => 1,
                'created_at' => '2021-04-16 18:29:00',
                'updated_at' => '2021-04-16 18:29:00',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 13,
                'uuid' => 'fc8f0c83-2f06-485e-9404-2de9d77b3ff4',
                'title' => 'Bank Verification Under Process',
                'slug' => 'bank-verification-under-process',
                'subject' => 'Bank Verification Under Process',
                'body' => '<p><strong>Hi [USER FULL NAME],</strong></p>

<p>The Bank details provided by you is under process of verification. Once our Rapid Cash America Verification Team successfully verifies your Bank details you will be notified.</p>

<p>This process ensures that the bank details provided by the user is Valid and Legal in all terms.</p>',
                'status' => 1,
                'created_at' => '2021-04-17 05:11:09',
                'updated_at' => '2021-04-17 05:11:09',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 14,
                'uuid' => '5fa87a58-0242-4f04-99c6-5bf392912cdb',
                'title' => 'Bank Verification Completed',
                'slug' => 'bank-verification-completed',
                'subject' => 'Bank Verification Completed',
                'body' => '<p><strong>Hi [USER FULL NAME],</strong></p>

<p>Congratulations! We are Happy to inform you that our Rapid Cash America Verification Team has successfully verified your Bank Details and soon the Loan amount will be transferred to your Bank Account</p>',
                'status' => 1,
                'created_at' => '2021-04-17 05:18:25',
                'updated_at' => '2021-04-17 05:18:25',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 15,
                'uuid' => 'dede60db-abfc-4c51-aa04-5fd47541dceb',
                'title' => 'Bank Verification Rejected',
                'slug' => 'bank-verification-rejected',
                'subject' => 'Bank Verification Rejected',
                'body' => '<p><strong>Hi [USER FULL NAME],</strong></p>

<p>The Bank Details submitted by you for the verification of the process has been rejected. During the verification of the procedure our Rapid Cash America&rsquo;s Verification Team found out that there is something missing / Invalid in the Bank Details you have submitted.</p>',
                'status' => 1,
                'created_at' => '2021-04-17 05:21:26',
                'updated_at' => '2021-04-17 05:21:26',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 16,
                'uuid' => '6e1a23df-11c8-49f7-a8e5-905408e8f1e8',
                'title' => 'Loan Confirmed',
                'slug' => 'loan-confirmed',
                'subject' => 'Loan Confirmed',
                'body' => '<p>CONGRATULATIONS!! We are happy to inform you that your Loan has been confirmed.</p>',
                'status' => 1,
                'created_at' => '2021-04-17 06:00:59',
                'updated_at' => '2021-04-17 06:00:59',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 17,
                'uuid' => '7f94d559-f0e0-4791-b73d-14dfa757f610',
                'title' => 'Loan Declined',
                'slug' => 'loan-declined',
                'subject' => 'Loan Declined',
                'body' => '<p><strong>Hi [USER FULL NAME],</strong></p>

<p>We are sorry to infom you that your recent Loan Applicaton is declined. Please contact customer support for further assistance.</p>',
                'status' => 1,
                'created_at' => '2021-04-17 06:04:45',
                'updated_at' => '2021-04-17 06:04:45',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 18,
                'uuid' => 'ae60fb53-a429-42d9-9ca2-822d5b23a1ca',
                'title' => 'Loan Credited',
                'slug' => 'loan-credited',
                'subject' => 'Loan Credited',
                'body' => '<p>[CONTENT]</p>',
                'status' => 1,
                'created_at' => '2021-04-17 06:19:49',
                'updated_at' => '2021-04-17 06:19:49',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}