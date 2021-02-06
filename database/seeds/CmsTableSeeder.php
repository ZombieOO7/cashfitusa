<?php

use Illuminate\Database\Seeder;

class CmsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cms')->delete();
        
        \DB::table('cms')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uuid' => '0d904ecd-6ac2-4b06-b33d-9610744dbcb1',
                'page_title' => 'Terms & Conditions',
                'page_slug' => 'terms-conditions',
                'api_page_slug' => NULL,
                'page_content' => '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>',
                'meta_title' => NULL,
                'meta_keyword' => 'Lorem Ipsum',
                'meta_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'meta_robots' => NULL,
                'created_by' => NULL,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => '2020-02-24 08:59:12',
                'updated_at' => '2020-02-24 08:59:12',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'uuid' => 'c3ce9053-7ad1-4095-8225-3f20de6d9877',
                'page_title' => 'About us',
                'page_slug' => 'about-us',
                'api_page_slug' => NULL,
                'page_content' => '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s</p>',
                'meta_title' => NULL,
                'meta_keyword' => NULL,
                'meta_description' => NULL,
                'meta_robots' => NULL,
                'created_by' => NULL,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => '2020-02-24 08:59:46',
                'updated_at' => '2020-02-24 08:59:46',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'uuid' => '74f746b6-42d7-4a5f-a550-d04443b72f61',
                'page_title' => 'Privacy Policy',
                'page_slug' => 'privacy-policy',
                'api_page_slug' => NULL,
                'page_content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum nunc mi, in accumsan nulla maximus a. Morbi eleifend sem dolor, eu mattis orci molestie non. Pellentesque tristique ligula tortor. Suspendisse potenti. Pellentesque luctus enim at convallis mattis. Nunc euismod sagittis odio sed fringilla. Morbi non diam ut dui posuere vehicula. Vivamus lorem nunc, lobortis quis ultrices vel, aliquam scelerisque justo. Vivamus sapien nunc, dapibus non porta ac, accumsan non enim. Nulla eget dui maximus diam semper gravida sed nec lectus. Praesent consequat massa at massa auctor, ut fermentum libero tempor.&nbsp;</p>',
                'meta_title' => NULL,
                'meta_keyword' => NULL,
                'meta_description' => NULL,
                'meta_robots' => NULL,
                'created_by' => NULL,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => '2020-02-25 13:15:20',
                'updated_at' => '2020-02-26 07:04:15',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'uuid' => 'b7cbd6b7-d1da-4918-8c50-5b61674456c8',
                'page_title' => 'Identification',
                'page_slug' => 'identification',
                'api_page_slug' => NULL,
                'page_content' => '<p><em>Lorem ipsum</em>, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s De Finibus Bonorum et Malorum for use in a type specimen book.</p>',
                'meta_title' => NULL,
                'meta_keyword' => NULL,
                'meta_description' => NULL,
                'meta_robots' => NULL,
                'created_by' => NULL,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => '2020-10-10 11:08:08',
                'updated_at' => '2020-10-10 11:08:08',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'uuid' => 'b7cbd6b7-d1da-4918-8c50-5b61674456c9',
                'page_title' => 'About Us',
                'page_slug' => 'about_us',
                'api_page_slug' => NULL,
                'page_content' => '<p><em>Lorem ipsum</em>, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s De Finibus Bonorum et Malorum for use in a type specimen book.</p>',
                'meta_title' => NULL,
                'meta_keyword' => NULL,
                'meta_description' => NULL,
                'meta_robots' => NULL,
                'created_by' => NULL,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => '2020-10-10 11:08:08',
                'updated_at' => '2020-10-10 11:08:08',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'uuid' => 'f33a9f07-bd2c-4f57-a9c6-f9e5e60933f6',
                'page_title' => 'Terms Of Use',
                'page_slug' => 'terms-of-use',
                'api_page_slug' => NULL,
                'page_content' => '<p><strong>RAPIDCASH AMERICA TERMS OF USE</strong></p>

<p>Thank you for visiting Rapidcash America! Your use of this website <a href="https://www.rocketloans.com/">www.RapidcashAmerica.com</a> and any pages thereof (&quot;Site&quot;) is controlled by these Terms of Use. By entering this Site and through your use of this Site, you agree to these Terms of Use whether or not you are a registered user of our products and services (each a &quot;Service&quot; and collectively our &quot;Services&quot;). IF YOU DO NOT AGREE WITH THESE TERMS OF USE, YOU MAY NOT USE THE SITE.</p>

<p>&nbsp;</p>

<p>1.&nbsp; &nbsp; &nbsp; <strong>OWNERSHIP OF SITE.</strong> Rapidcash America (&quot;RapidcashAmerica,&quot; &quot;Rapidcash America,&quot; &quot;we,&quot; &quot;us,&quot; &quot;Company,&quot; or &quot;our&quot;) owns and operates this Site. You acknowledge and agree that all content, web pages, source code, calculations, products, materials, data, information, text, screen, functionality, services, design, layout, screen interfaces, &quot;look and feel,&quot; and the operation of this website (collectively, &quot;Site Content&quot;) are protected by various intellectual property laws, including, but not limited to, copyrights, patents, trade secrets, trademarks, and service marks, and you do not acquire any rights by downloading or viewing any Site Content. You agree that Rapidcash America and all logos related to our products and Services are our or our licensors&#39; trademarks or registered trademarks. You may not copy, imitate or use them without our prior written consent. In addition, all page headers, custom graphics, button icons, and scripts are our service marks, trademarks and/or trade dress. You may not copy, imitate, or use them without our prior written consent.</p>

<p><br />
&nbsp;</p>

<p>2.&nbsp; &nbsp; &nbsp; <strong>ELIGIBILITY.</strong> The Platform is designed exclusively for people who are 18 years of age or older, and any registration or usage of the Site by those under the age of 18 is illegal and in breach of these Terms of Use. By accessing the Web, you reflect that you are 18 years of age or older and that you accept and abide by all the terms and conditions of these Terms of Use.The Website is intended primarily for those who are 18 years of age or older, and any registration or use of the Site by persons under the age of 18 is unlawful and in violation of these Terms of Use. By using the Site, you reflect that you are 18 years of age or older and that you agree and abide by all of the terms and conditions of these Terms of Use.</p>

<p>&nbsp;</p>

<p>3.&nbsp; &nbsp; &nbsp; <strong>COMMUNICATIONS AND AFFILIATE SHARING.</strong> By accepting these Terms of Use, you expressly consent to having Rapidcash America, our affiliates, agents, or representatives,&nbsp; contact you about your inquiry by text message, SMS, email, or phone (including use of an automatic telephone dialing system or an artificial or pre-recorded voice) to the residential or cellular telephone number you have provided, even if the telephone number is on a corporate, state, or national Do Not Call Registry. You do not have to agree to receive such calls or messages as a condition of getting any services from Rapidcash America or its affiliates. You acknowledge that you provided us your cellular number and you provided your cellular number during a transaction that if consummated will result in you owing a debt to Cross Rapidcash America. You also consent to us contacting you through the email address you have provided us. The phone number provided must be a phone number registered to you or which you have authorization to use and not a phone number of any third party such as a debt relief agency or other. If you want to opt out of receiving marketing information by email, telephone, text message, and/or mail, please email support@RapidcashAmerica.com with the subject &quot;Opt Out&quot; or call (800) 333-7625. If you have established an account with us, you can also change your communication preference through editing your preferences in &quot;My Communication Preferences&quot; under your &quot;My Profile&quot; once you sign into your account with Rapidcash America. In the event you consummate a loan you agree that you will provide a phone number and address that is associated with you and not a third party.</p>

<p>&nbsp;</p>

<p>By agreeing these Terms of Use, you understand and consent that we can share the details you provide to us, including, but not limited to, your full name, date of birth, location, telephone number, email address and social security number with our affiliates. You also accept and consent that representatives of our affiliates, including Quicken Loans, Rocket Homes and Rapid Advance, can share with us any information you have given. Your record includes, but is not limited to, your full name, date of birth, age, telephone number, email address and social security number, and any credit profiles that could be assigned to you. You understand that our Affiliates and/or Partners may retain the information you have given to us even if you decide not to use their services. In the event that you no longer wish to accept messages from our affiliates or Partners, you consent to contact them directly.</p>

<p>&nbsp;</p>

<p>4.&nbsp; &nbsp; &nbsp; <strong>LOAN REQUESTS.</strong> You will have the ability to apply for a loan via the Web. When you apply for a loan, you agree to have up-to-date, full and detailed details about yourself. You accept that you would not, in accordance with any Programs, manipulate your personality or identify, view or represent yourself as a person other than yourself If any information you provide is outdated, incorrect, not up-to-date or incomplete, we have the right to refuse any request you have made, cancel any arrangement we have with you and limit your potential use of the Site and our Services. We reserve the right to deny any offer for a loan. You accept that if you seek a loan from our Platform, you will not apply for a loan for any unauthorized or unlawful reason. You accept and consent that your offer for a loan will not be financed. You accept that we will first do a soft credit pull and that any offer of credit to you will be subject to a hard credit pull that we will complete before you sign the Loan Agreement to ensure that your credit has not improved. You understand and recognize that the terms of any credit deal you will differ from day-to-day and, to some degree, hour-by-hour, and if you leave the Site or the loan application process, any rate and term details you have listed on the Platform will adjust. Applications for completed loans expire after 30 days unless otherwise agreed in writing.</p>

<p>&nbsp;</p>

<p>5.&nbsp; &nbsp; &nbsp; <strong>SIGN IN AND PASSWORDS.</strong> If you apply for a loan via the Web, you would need to build an account and password. You accept that you will respect and preserve the security of any user ID, password or other identifying details you receive from your use of the Site and that you will not reveal this information to any third party. You accept that you can promptly contact Rapidcash America if you suspect that your user ID, password, or identity information has been compromised, lost, or robbed. Note that Rapidcash America will never contact you with an unsolicited email or phone call asking for your username or password. You also accept and consent that you are solely responsible for any losses or lawsuits that might occur as a result of any access to or use of this Site by any person to whom you have given your user ID, password or other identifying details, or by any person who has obtained such information from you, including, Not limited to, however, any access to or use of this Site that might occur before you have told us that your user ID, password or other identifying information has been lost, damaged or otherwise violated and that we have had adequate time to respond.</p>

<p><br />
&nbsp;</p>

<p>6.&nbsp; &nbsp; &nbsp; <strong>PERMITTED USE.</strong> You agree that:</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; The use of this Site shall be subject to and regulated by these Terms of Use;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; you can only enter or use this Platform and exchange with us if you are at least 18 years of age;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; you can abide with and be bound by these Terms of Use when they appear on this Site any time you view and use this Site;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; every use of this Site by you shows and acknowledges your consent to and willingness to be bound by these Terms of Use;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; these Terms of Use are legally binding arrangements between you and Rapidcash America that will be enforceable against you;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; When using and using this Platform, you also use the Google Maps API and accept to be bound by Google&#39;s Terms of Service. Rapidcash America takes no responsibility for the content of the Google Terms of Operation.</p>

<p>&nbsp;</p>

<p>You accept that you may not use or attempt to use this Platform for any reason other than personal consumer loans for your particular reasons with Rapidcash America as a bona fide member of Rapidcash America; you can not use or attempt to use this Site or any portion of this Site for any purpose:that interferes with or induces a breach of the contractual relationships between Rapidcash America and its employees</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; that is illegal or forbidden in some way, or that is dangerous or damaging to someone or their property;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; that transmits any ads, solicitations, schemes, spam, floods or other unsolicited emails, unsolicited commercial communications;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; transmits any dangerous or deactivating machine codes or viruses;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Harvesting email addresses from this Site;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; who sends unsolicited e-mails to this Site or to someone whose e-mail address contained a domain name under this Site;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; it interferes with our network services;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; an effort to obtain unauthorized access to our network services;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; that means an express or tacit association with Rapidcash America, its affiliates (without the express written authorization of Rapidcash America);that impairs or limits our ability to operate this Site or any other person&#39;s ability to access and use this Site;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; that uses any tools, means or computers to click on this Site or making a visit to this Site for the purpose of exploiting the results of any Internet search engine or for any other purpose other than the conduct of consumer lending related business with Rapidcash America or Cross River Bank as a loyal client of Rapidcash America;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; that illegally impersonates or otherwise distorts your relationship with another person or entity;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; hurting minors in any manner, including, though not limited to, the dissemination or downloading of material that violates the laws on child pornography, the laws on child sexual abuse and the laws banning the appearance of minors engaging in sexual activity;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; transmits or uploads pornographic, aggressive, indecent, sexually explicit, racist, hateful, threatening, hostile, defamatory, insulting, harassing or otherwise unacceptable material or images;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; hurting, bullying, insulting, abusing or manipulating another person in some way or including pictures or material that represents, supports, facilitates, points out, advocates or appears to provoke the committing of a crime or other unlawful activity;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; that dilutes or depreciates the name and reputation of Cross Rapidcash America, or any of their affiliates;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; that transmits or uploads any content or photographs that infringe the intellectual property rights of any third party or infringe the privacy rights of any third party;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; It illegally transmits or uploads any private, proprietary or commercial secret information.</p>

<p>&nbsp;</p>

<p>7.&nbsp; &nbsp; &nbsp; <strong>RESTRICTIONS ON USE.</strong> You consent to comply with all relevant laws and regulations governing your use of the Platform and our Services. In addition, you accept that you would not do the following:</p>

<p>&nbsp;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Apply for more than one loan (if you have a loan) or apply for a loan on behalf of a person other than yourself or on behalf of a party or entity;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Upload or otherwise make available content or take any action on the Web that may constitute libel or defamation or that infringes or infringes the rights of another person or is protected by any copyright or trademark or otherwise infringes the law;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; &bull; post or otherwise make available content that is objectionable in our judgment, such as content that is harmful, threatening, inflammatory, obscene, fraudulent, invasive of privacy or publicity rights, hateful or otherwise objectionable; that restricts or inhibits any other person from using or enjoying the Site; or that may expose us or our users to any harm or liability of any kind;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Upload or otherwise make available any unsolicited or illegal ads, solicitation or promotional material or any other form of solicitation;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; use the details or content of our Site to send inappropriate messages to every other user;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; impersonate another person or entity, or wrongly claim or otherwise distort yourself, your age or your association with any person or entity;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; publish or otherwise make freely accessible on the Web the personal or financial details by any third party;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; require confidential information from someone under the age of 18 or request passwords or individually identify information for private or illegal purposes;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; use the Site or our Services in any way that can damage, deactivate, overburden or impair the Site;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; use the Site or our Services in any way that can damage, deactivate, overburden or impair the Site;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Post or otherwise make available any content that includes software viruses or any other programming code, files or programs intended to disrupt, destroy or limit the capabilities of any computer software or hardware or telecommunications equipment.</p>

<p>&nbsp;</p>

<p>8.&nbsp; &nbsp; &nbsp; <strong>COPYRIGHT COMPLAINTS.</strong> If you feel that any content on the Web infringes any rights that you own or manage, you can give us a written notification via email to support@RapidcashAmerica.com or via daily mail to Rapidcash America, Attn: Legal Staff, 1274 Library Lane, 2nd Floor, Detroit, Michigan, 48226. In your notification, please read:</p>

<p>&nbsp;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Confirm that you are the owner or allowed to operate on behalf of the owner of the copyrighted work that has been infringed;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Describe the copyrighted work or works that you say have been infringed;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Describe the content that you say is infringing or is subject to infringing action and is to be deleted (please provide details that is sufficiently appropriate to enable us to find the material);</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; include your contact information, including your email address;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; make a declaration that the information you have given is correct and that you have a good faith conviction that the use of the content in the manner complained of is not allowed by the owner of the copyright, his agent or the law;</p>

<p>&nbsp;</p>

<p>9.&nbsp; &nbsp; &nbsp; <strong>INDEMNIFICATION.</strong> You promise to protect and hold harmless Cross River Bank, Rapidcash America, its affiliates, and its officers, directors, staff and third party vendors against and against any and all third party actions, suits, lawsuits and/or claims and all subsequent injuries, charges, penalties, costs and other liability (including fair attorneys&#39; fees As a consequence of or in relation to your submitted content, usage or abuse of some part of the Services or the Web or your breach of these Terms of Use. You shall comply as thoroughly as legally possible in the protection of any other claim or claim. We and any third party involved in designing, manufacturing or providing the Web and/or the Facilities reserve the right to claim exclusive defense and oversight over any matter otherwise subject to indemnification by you, at your expense, and you will in no event resolve any such matter without our prior written consent and that of any such third party.</p>

<p>&nbsp;</p>

<p>10.&nbsp; <strong>SEVERABILITY </strong>You accept that any provision of these Terms of Use shall be considered to be unconstitutional or void or, for whatever cause whatsoever, unenforceable, so that provision shall be presumed to be deductible from the other provisions of these Terms of Use which shall not impair the fairness and enforceability of all other provisions.</p>

<p>&nbsp;</p>

<p>11.&nbsp; <strong>YOUR COOPERATION NEEDED.</strong> Usually, Rapidcash America will begin processing the application upon submission of a full and complete application. When you submit an application, you agree to comply with the application process (including submitting all required documentation in a timely manner). If required, Rapidcash America can require details from third parties, such as your bank or boss, etc. In addition, you promise to alert Rapidcash America of any modifications to any details provided in accordance with your submission.</p>

<p>&nbsp;</p>

<p><strong>12.</strong>&nbsp; <strong>NOTIFICATIONS </strong>Rapidcash America can provide you with updates via e-mail and regular mail at the most recent address you have given, or by posting information to this Site as permitted by law.</p>

<p>&nbsp;</p>

<p>13.&nbsp; <strong>NO WARRANTY; ERRORS; DISCLAIMERS.</strong> ALTHOUGH WE WILL USE REASONABLE EFFORTS TO PROVIDE AN ACCURATE SITE AND SERVICES, THE SITE AND OUR SERVICES ARE PROVIDED &quot;AS IS&quot; AND WITHOUT ANY REPRESENTATION OR WARRANTY, WHETHER EXPRESS OR IMPLIED. WE AND OUR AFFILIATES, OFFICERS, DIRECTORS, EMPLOYEES, AND THIRD PARTY SUPPLIERS (COLLECTIVELY, THE &quot;RAPIDCASH AMERICA PARTIES&quot;) DISCLAIM ANY AND ALL REPRESENTATIONS, WARRANTIES, OR GUARANTEES OF ANY KIND, WHETHER EXPRESS, IMPLIED, OR STATUTORY, RELATING TO THE SITE, THE SERVICES, ANY DOCUMENTATION PROVIDED OR MADE AVAILABLE TO YOU AND ANY OTHER PRODUCTS AND RELATED MATERIALS AND/OR SERVICES PROVIDED TO YOU BY ANY OF THE RAPIDCASH AMERICA PARTIES, INCLUDING, BUT NOT LIMITED TO, ANY WARRANTIES: (I) AS TO TITLE, MERCHANTABILITY, FITNESS FOR ORDINARY PURPOSES, FITNESS FOR A PARTICULAR PURPOSE, NON-INFRINGEMENT, SYSTEM INTEGRATION, AND WORKMAN LIKE EFFORT; (II) AS TO THE QUALITY, ACCURACY, TIMELINESS, OR COMPLETENESS OF THE SITE OR THE SERVICES OR ANY ASPECT THEREOF; (III) ARISING THROUGH COURSE OF DEALING, COURSE OF PERFORMANCE, OR USAGE OF TRADE; (IV) RELATING TO THE SITE OR SERVICES CONFORMING TO ANY FUNCTION, DEMONSTRATION, OR PROMISE BY ANY RAPIDCASH AMERICA PARTY; AND (V) THAT ACCESS TO OR USE OF THE SITE AND/OR SERVICES WILL BE UNINTERRUPTED, ERROR-FREE, OR COMPLETELY SECURE. ANY RELIANCE UPON THE SITE AND/OR SERVICES IS AT YOUR OWN RISK AND THE RAPIDCASH AMERICA PARTIES MAKE NO WARRANTIES.</p>

<p><br />
&nbsp;</p>

<p>14.&nbsp; <strong>LIMITATION OF LIABILITY.</strong> You agree that all access and use of the Site and its contents and your use of the Services are at your own risk. Neither we nor any of the Rapidcash America parties involved in the development, processing or distribution of the Site and/or the Services shall have or shall have any responsibility for any repercussions relating, directly or indirectly, to any action or inaction you might take on the basis of the Site and/or the Services or any element thereof.&nbsp; You accept that you, and not Rapidcash America, will bear the full cost of any facilities, fixes, corrections, or restorations that may be required for your records, software programs, or computer equipment due to any viruses, errors, or other problems you may have as a result of accessing or visiting this Site.</p>

<p>&nbsp;</p>

<p>WE WILL NOT BE HELD LIABLE FOR ANY DEFECTS, FAULTS, INTERRUPTIONS, OR DELAYS IN THE OPERATION OR TRANSMISSION OF ANY PRODUCT, AND/OR ANY INACCURACIES, ERRORS OR OMISSIONS IN THE INFORMATION CONTAINED IN THE SITE AND/OR THE SERVICES. UNDER NO CIRCUMSTANCES WILL ANY OF THE ROCKET LOAN PARTIES BE HELD LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, EXEMPLARY, PUNITIVE, OR OTHER DAMAGES, INCLUDING, BUT NOT LIMITED TO, LOST PROFITS, ARISING OUT OF, BASED ON, RESULTING FROM, OR IN CONNECTION WITH THE SITE AND/OR THE SERVICES OR ANY PRODUCTS, THESE TERMS OF USE OR YOUR USE OR INABILITY TO USE ANY OF THE FOREGOING, EVEN IF THE RAPIDCASH AMERICA PARTIES HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.</p>

<p>&nbsp;</p>

<p>ALL OF THESE LIMITATIONS APPLY REGARDLESS OF THE CAUSE OR FORM OF ACTION, WHETHER THE DAMAGES ARE CLAIMED UNDER THE TERMS OF A CONTRACT, TORT, OR OTHERWISE, AND EVEN IF WE OR OUR REPRESENTATIVES HAVE BEEN NEGLIGENT OR HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. NO ACTION ARISING OUT OF OR PERTAINING TO THESE TERMS OF SERVICE MAY BE BROUGHT MORE THAN ONE (1) YEAR AFTER THE CAUSE OF ACTION HAS ARISEN.</p>

<p><br />
&nbsp;</p>

<p>15.&nbsp; <strong>ACCESS TO SITE.</strong> Rapidcash America reserves the right at all times, in its sole discretion and without notice to you, to deny your access to and use of the Site.</p>

<p><br />
&nbsp;</p>

<p>16.&nbsp; <strong>LINKING.</strong> The Web can, from time to time, include links to other sites. Rapidcash America does not support, authorize, sponsor or regulate and we are in no way responsible for any of the content, programs, calculations, facts, items or materials that you can obtain from any website where we may have given a connection. Through accessing this Site, you accept and consent that Rapidcash America will not be responsible or liable to you or any other party for any losses or claims that may arise from your use of such content, programs, estimates, documents, products or materials.</p>

<p>&nbsp;</p>

<p>No Release/No Ties. Rapidcash America does not authorize ads to third parties on this Platform. But with the express written consent of Rapidcash America, you accept that you will not create connections from any of the websites or websites on this List or any of the websites on this Site.</p>

<p>&nbsp;</p>

<p>17.&nbsp; <strong>REVISIONS AND MODIFICATIONS.</strong> We reserve the right to temporarily or permanently modify or discontinue the Site, or any portion of the Site, for any reason, without notice to you. You accept that Rapidcash America can, without warning to you, temporarily or permanently update or modify these Terms of Use at any time, and you agree that you will be bound by the conditions of these Terms of Use when they appear on this Site when you visit this Site Because these Terms of Use can change, we urge you to refer back regularly to these Terms of Use. In addition, you accept and understand that all other information, features, goods and materials on or accessible via this Platform may be updated and changed without notice to you. You also accept and consent that any changes to the Terms of Use will not be modified by contract, unless permitted in writing by Rapidcash America.</p>

<p><br />
<br />
<br />
<br />
<br />
<br />
&nbsp;</p>

<p>18.&nbsp; <strong>FOR CALIFORNIA RESIDENTS ONLY.</strong> This section details your rights under the California Consumer Privacy Act.</p>

<p>&nbsp;</p>

<p><strong>Data Collection and Data Sharing</strong></p>

<p>These are the types of data we might collect about you:</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Identifiers</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Any personal data described in subdivision (e) of Section 1798.80 of the California Consumer Privacy Act</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Characteristics of protected classifications under California or federal law</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Commercial data</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Biometric data (for employees only as required by law)</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Internet or other electronic network activity data</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Geolocation data</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Sensory data</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Professional or employment data</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Education data</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Inferences drawn from any of the data used to create a customer profile</p>

<p>&nbsp;</p>

<p>Sources of collected data:</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information collected through our websites</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information you provided when getting a product or a service from us</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information you provided when signing up for communications from us</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information you provide when entering promotions or sweepstakes</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information you provided through telephone or web-based surveys, online chat, customer service correspondence or general feedback</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information you provided when applying for a position with us</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information provided by third parties such as lead buy partners, data brokers and credit bureaus</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information collected using web technologies</p>

<p>&nbsp;</p>

<p>Ways we might use your data:</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Marketing (unless you&#39;ve opted out)</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Auditing</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Fraud detection</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Debugging</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Providing services</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Quality control</p>

<p>&nbsp;</p>

<p>Reasons we might share your data with third parties:</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Business purposes</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Auditing</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Detecting fraud</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Debugging</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Providing services</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Internal research</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Quality control</p>

<p>&nbsp;</p>

<p>With your consent, we might share your personal data with third parties, including our affiliates, mortgage partners and service providers, for these reasons:</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Business purposes</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Marketing</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Analytics</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Pre-populating your information to make your experience easier</p>

<p>&nbsp;</p>

<p><strong>18.1 Sale of Data</strong></p>

<p>We may sell your personal information to affiliates or trusted business partners. You have the right to opt-out of the sale of your data to third parties.</p>

<p>To exercise this right, please contact us.</p>

<p>&nbsp;</p>

<p><strong>18.2 Your Privacy Rights</strong></p>

<p>If you&rsquo;d like to review, access, revise or delete personal data we&rsquo;ve collected about you, please contact us.</p>

<p>&nbsp;</p>

<p><strong>18.3 Right to Know</strong></p>

<p>You have a right to know what personal data we&rsquo;ve collected about you, what data we&rsquo;ve sold, who we&rsquo;ve sold your data to, and what data we&rsquo;ve shared for business purposes.</p>

<p>To exercise this right, please contact us.</p>

<p>&nbsp;</p>

<p><strong>18.4 Right to Access</strong></p>

<p>You have the right to see what specific pieces of data we have about you, and to get this data in a portable and easily accessible format.</p>

<p>To exercise this right, please contact us.</p>

<p>&nbsp;</p>

<p><strong>18.5 Right to Delete</strong></p>

<p>You have the right to request that we delete your data. We&rsquo;re legally required to keep some data about you, but we&rsquo;ll delete everything we can. Keep in mind that we might reacquire some of your data if we purchase data from a third party.</p>

<p>To exercise this right, please contact us.</p>

<p>&nbsp;</p>

<p><strong>18.6 How We Process Your Privacy Rights</strong></p>

<p>First we will verify your identity using your personal info. Then we&#39;ll process your request according to company guidelines. You can usually expect a response within 45 days.</p>

<p>&nbsp;</p>

<p><strong>18.7 Authorized Agent</strong></p>

<p>If you&#39;re an authorized agent (such as power of attorney) making a request on behalf of someone else, please contact us.</p>

<p>&nbsp;</p>

<p><strong>18.8 Right to Non-Discrimination for The Exercise of Your Privacy Rights</strong></p>

<p>You won&#39;t be discriminated against for exercising your privacy rights.</p>

<p>&nbsp;</p>

<p><strong>18.9 How to Contact Us About Your Data</strong></p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Call us at (855) 503-0462</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Send an email to support@RapidcashAmerica.com</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Visit <a href="http://www.rocketloans.com/">RapidcashAmerica.com</a> and log into your account</p>

<p>&nbsp;</p>

<p>19.&nbsp; <strong>GOVERNING LAW AND DISPUTE RESOLUTION. </strong>You agree that these Terms of Use shall be governed by and construed in accordance with the laws of the State of Michigan, without giving effect to any principles of conflicts of law. You understand and agree to resolve through final and binding arbitration the following claims, disputes, or controversies arising between you and Rapidcash America, and its parents, affiliates, subsidiaries, or related companies: all claims, disputes, or controversies arising from the Telephone Consumer Protection Act of 1991 (&ldquo;TCPA&rdquo;), or state law claims similar to the TCPA. You will arbitrate TCPA claims between you and Rapidcash America at a location the arbitrator will determine in compliance with Rapidcash America&rsquo; Governing Law provision. The arbitrator, not the court, will resolve the issue of arbitrability. Any state or federal court having jurisdiction thereof may enter judgment of any award the arbitrator renders. This arbitration contract is made under a transaction in interstate commerce, and the Federal Arbitration Act (&ldquo;FAA&rdquo;) will govern its interpretation, application, enforcement, and proceedings. As the Governing Law provision indicates, the laws of the State of Michigan govern the enforceability of this arbitration provision as a contract, but not the scope of this provision. Neither you nor Rapidcash America are entitled to join or consolidate claims in arbitration by or against other consumers or to arbitrate any claim as a representative or member of a class or in a private attorney general capacity. The parties voluntarily and knowingly waive any right they have to a jury trial for TCPA-related matters which, based on the above, will be arbitrated. You agree that any other action(s) at law or in equity arising out of or relating to these Terms of Use or the use of this website shall be filed only in the state or federal courts located in Wayne County, Michigan, and you hereby consent and submit to the personal jurisdiction of such courts for the purposes of litigating.</p>

<p><br />
&nbsp;</p>

<p>20.&nbsp; <strong>MISCELLANEOUS.</strong> Because Michigan law controls this Site, all record keeping and data gathering is based on Eastern Standard Time; as such, if you consent, acknowledge, or e-sign a document through this Site, such consents, acknowledgment, and signature will be time-stamped based on Eastern Standard Time even though you may physically be in a different time zone.</p>

<p><br />
&nbsp;</p>

<p>21.&nbsp; Your obligations under these Terms of Use are binding on your successors, legal representatives, and assigns. You may not assign or transfer (by operation of law or otherwise) your right to use the Site and/or the Services or any aspect thereunder, in whole or in part, without our prior written consent.</p>

<p><br />
&nbsp;</p>

<p>22.&nbsp; Please contact us via email at support@RapidcashAmerica.com with any questions regarding these Terms of Use.</p>',
                    'meta_title' => NULL,
                    'meta_keyword' => NULL,
                    'meta_description' => NULL,
                    'meta_robots' => NULL,
                    'created_by' => NULL,
                    'updated_by' => 1,
                    'status' => 1,
                    'created_at' => '2021-02-03 03:22:17',
                    'updated_at' => '2021-02-03 03:22:17',
                    'deleted_at' => NULL,
                ),
                6 => 
                array (
                    'id' => 7,
                    'uuid' => '4b241b68-9233-46d9-a0e4-38e5727c840a',
                    'page_title' => 'Security and Privacy',
                    'page_slug' => 'security-and-privacy',
                    'api_page_slug' => NULL,
                    'page_content' => '<p><strong>Security and Privacy Policy</strong></p>

<p><strong>Security and Privacy</strong></p>

<p>Rapidcash America acknowledges its affirmative and continuing obligation to respect the privacy of its customers and to protect the security and confidentiality of non-public personal information of those customers. Rapidcash America is committed to fulfilling its responsibility to protect your private information through (1) strong information technology systems and (2) a strong culture of compliance.</p>

<p>&nbsp;</p>

<p>Rapidcash America uses a number of technologically sophisticated processes to validate your identity, avoid unwanted sharing of your information, and keep your information secure. Rapidcash America is now preparing its staff members to comply with existing privacy laws and regulations.</p>

<p>&nbsp;</p>

<p><strong>Guidance concepts</strong></p>

<p>Rapidcash America recognizes the deep faith that its customers place in having access to non-public consumer personal information (&quot;NPPI&quot;). Rapidcash America not only meets relevant regulations, but also industry best practices that go above and beyond what is strictly needed to ensure that we are at the forefront of the industry in supporting our consumers. RapidcashAmerica has adhered to the following guiding principles:</p>

<p>Protected Uses</p>

<p>&bull; Rapidcash America receives and uses the details of its clients only when it finds it necessary to perform its business, including the provision of consumer loans.</p>

<p>&bull; Rapidcash America does not exchange customer NPPI or consumer information except as allowed by regulation and disclosed in its privacy notice.</p>

<p>&bull; Rapidcash America takes steps to combat data fraud and prevent fraudulent purchases, through the participation of eligible industry-leading third-party service providers to help with those programs.</p>

<p>&bull; Rapidcash America does business with third parties only if Rapidcash America is sure that those third parties have the necessary practices, protocols and processes in order to follow our stringent protection and privacy requirements.Clear</p>

<p>&nbsp;</p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Privacy Notice</p>

<p>Please refer to Rapidcash America&#39;s Official Privacy Notifications about our use of personal information and the right to prevent the exchange of such information, if appropriate.</p>

<p>&nbsp;&nbsp;&nbsp; Compliance with State and Federal Laws</p>

<p>Rapidcash America recognizes and abides by comprehensive federal and state legislation and regulations addressing your privacy rights. This website information on your privacy rights and Rapidcash America&#39;s policies do not cover anything we do to protect your privacy. In addition, you may need to contact the relevant state department responsible for administering applicable state law relating to Privacy privileges, since these rights can differ from state to state. Notice that certain federal and state regulations can decide our record keeping policies and the length of time we are allowed to retain your personal information.</p>

<p>&nbsp;</p>

<p>&nbsp;&nbsp;&nbsp;Secure System</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; We use industry-recognized security protections to help protect personally identifying information that you have given to us from deletion, abuse, or unwanted modification. All data submitted to Rapidcash America is secured by code that allows the data to be encrypted. We use, among other things:</p>

<p>&nbsp;</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Secure Socket Layer (SSL): Rapidcash America&#39;s Web server follows the Secure Socket Layer (SSL) transaction protocol that is widely accepted as an industry standard. This security protocol is in order to keep information exchanged back and forth between a Web server and its users confidential.</p>

<p>&nbsp;</p>

<p>&bull; 256-Bit Domestic Grade Strong Encryption: We use 256-Bit Domestic Grade Strong Encryption, a popular encryption technique currently available for Internet devices. You can download 256-bit browsers from Mozilla, Apple or Microsoft for free.</p>

<p>&nbsp;</p>

<p><strong>Site Access</strong></p>

<p>Through visiting our site, you also use the Google Maps App. Through accessing and utilizing our platform or facilities, you are required by Google&#39;s Privacy Policy, which is incorporated herein through default. Through using our Google Maps API integration and your approval, Rapidcash America will be able to access your geolocation details. This knowledge is collected and used to help you fill out the address field on our platform using a list of position prediction resources. The holding of this geolocation knowledge until obtained shall be permanent. You can, at any point, revoke your consent to this access through your Internet browser. Rapidcash America takes no responsibility for the substance of the Google Privacy Policy.</p>

<p>&nbsp;</p>

<p><strong>Data Partners</strong></p>

<p>In order to provide you with an online loan process, Rapidcash America has formed partnerships with some data partners (&quot;Data Partners&quot;). Data Partners may encourage the verification of your identity by Rapidcash America or its financing partners or affirm your financing status for some administrative processes, among other purposes. For eg, from time to time, we can use the following Data Partners to check your income and other information on your bank account(s):</p>

<p>&nbsp;</p>

<p>&middot; &nbsp; &nbsp; &nbsp; <a href="https://www.finicity.com/">&nbsp;Finicity Corporation</a> (&quot;Finicity&quot;)</p>

<p>&middot; &nbsp; &nbsp; &nbsp; <a href="https://decisionlogic.com/">&nbsp;Clarilogic, Inc. dba Decision Logic</a> (&quot;DecisionLogic&quot;)</p>

<p>&middot; &nbsp; &nbsp; &nbsp; <a href="https://www.plaid.com/">&nbsp;Plaid Technologies, Inc.</a> (&quot;Plaid&quot;)</p>

<p>Through using our platform, you accept that we may share and maintain your information with these Data Partners. The details we share could include, but is not limited to, your name, date of birth, address, telephone number and social security number. You also give Rapidcash America and Plaid Data Partners the freedom, power and jurisdiction to operate on your behalf to view and distribute your personal and financial information from the financial institution concerned. You consent to the transfer, storing and retrieval of your personal and financial information by our Data Partners and Rapidcash America in compliance with their respective privacy policies.</p>

<p><br />
&nbsp;</p>

<p><strong>Application and Dashboard</strong></p>

<p>By applying for a loan on our website, you are building an account with us. Your username is your email address and you can generate a password when you send your application to us. You will be able to sign in to your account by clicking the &quot;Sign In&quot; icon at the top of the website. You&#39;re going to get an account whether or not you&#39;re eligible for a loan. When you sign up, you will be able to see the status of your loan application along with any paperwork you have signed online, such as your Electronic Transfers and Disclosures Consent and your Credit Pull Permit.</p>

<p>You will use the &quot;My Profile&quot; feature of &quot;My Dashboard&quot; to edit your personal details, such as your address and your phone number. We use your contact details to provide you with reminders and updates on your loan status. If you have applied for a loan and have not got an email from us, please search the spam or junk folder in your email address to make sure the letter is not filtered.</p>

<p>With regard to your password, it is important that you secure your password and, if you think it has been stolen, you must contact us as soon as possible to protect your privacy. When you create a password on our web, we will inform you the &quot;Password Strength.&quot; We suggest that you create a password that exceeds the &quot;Strong&quot; or &quot;Very Strong&quot; stage.</p>

<p>&nbsp;</p>

<p><strong>Cookies</strong></p>

<p>We use some of the common web technology to help maintain our website, like cookies.</p>

<p>A &quot;cookie&quot; is a little piece of information that our website will provide to your computer when you are on our website. Our website supplies cookies to your browser that contain a unique identifier used to help understand the use of the website as a whole and at a person level, so that we know which parts of our website users choose (for example, based on the number of visits to those areas). This is achieved by a monitoring utility that helps one, for example, to restore session activity or user activity for troubleshooting and resolution purposes. Rapidcash America can also hire service providers to help us gather and interpret the data we use on our website.</p>

<p>&nbsp;</p>

<p>When periodic surveys are introduced to website users, cookies are used to prevent numerous invites from being made to the same person. You can get a cookie when you log in if you are a registered customer. This cookie is saved in your browser and includes your identifier. This cookie is also used to authenticate your identity and to grant you access to parts of our website that are exclusive to registered users, such as those that allow you to view and maintain your personal profile.</p>

<p>&nbsp;</p>

<p>You do not have to allow cookies from our site if you just want to search. However, if you feel that you would like to register and sign in to specific parts of the website and have changed the browser settings so that cookies are not allowed, You will need to reset your browser to accept the cookies we sent. Otherwise, you would not be allowed to interact in those parts of the internet. Most browsers accept and retain cookies by default.</p>

<p>&nbsp;</p>

<p><strong>Data Collection and Data Sharing</strong></p>

<p>These are the types of data we might collect about you:</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Identifiers</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Any personal data described in subdivision (e) of Section 1798.80 of the California Consumer Privacy Act</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Characteristics of protected classifications under California or federal law</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Commercial data</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Biometric data (for employees only as required by law)</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Internet or other electronic network activity data</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Geolocation data</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Sensory data</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Professional or employment data</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Education data</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Inferences drawn from any of the data used to create a customer profile</p>

<p>&nbsp;</p>

<p>Sources of collected data:</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information collected through our websites</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information you provided when getting a product or a service from us</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information you provided when signing up for communications from us</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information you provide when entering promotions or sweepstakes</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information you provided through telephone or web-based surveys, online chat, customer service correspondence or general feedback</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information you provided when applying for a position with us</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information provided by third parties such as lead buy partners, data brokers and credit bureaus</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Information collected using web technologies</p>

<p>&nbsp;</p>

<p>Ways we might use your data:</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Marketing (unless you&#39;ve opted out)</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Auditing</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Fraud detection</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Debugging</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Providing services</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Quality control</p>

<p>&nbsp;</p>

<p>Reasons we might share your data with third parties:</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Business purposes</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Auditing</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Detecting fraud</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Debugging</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Providing services</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Internal research</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Quality control</p>

<p>&nbsp;</p>

<p>With your consent, we might share your personal data with third parties, including our affiliates, mortgage partners and service providers, for these reasons:</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Marketing</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Analytics</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Pre-populating your information to make your experience easier</p>

<p><br />
&nbsp;</p>

<p>California Residents: Sections 1.1 &ndash; 1.9 Detail Your Rights Under the California Consumer Privacy Act</p>

<p>1.1 Sale of Data</p>

<p>We may sell your personal information to affiliates or trusted business partners. You have the right to opt-out of the sale of your data to third parties.</p>

<p>&nbsp;</p>

<p>To exercise this right, please contact us.</p>

<p>&nbsp;</p>

<p>1.2 Your Privacy Rights</p>

<p>If you&#39;d like to review, access, revise or delete personal data we&#39;ve collected about you, please contact us.</p>

<p>&nbsp;</p>

<p>1.3 Right to Know</p>

<p>You have a right to know what personal data we&#39;ve collected about you, what data we&#39;ve sold, who we&#39;ve sold your data to, and what data we&#39;ve shared for business purposes.</p>

<p>&nbsp;</p>

<p>To exercise this right, please contact us.</p>

<p>&nbsp;</p>

<p>1.4 Right to Access</p>

<p>You have the right to see what specific pieces of data we have about you, and to get this data in a portable and easily accessible format.</p>

<p>&nbsp;</p>

<p>To exercise this right, please contact us.</p>

<p>&nbsp;</p>

<p>1.5 Right to Delete</p>

<p>You have the right to request that we delete your data. We&#39;re legally required to keep some data about you, but we&#39;ll delete everything we can. Keep in mind that we might reacquire some of your data if we purchase data from a third party.</p>

<p>&nbsp;</p>

<p>To exercise this right, please contact us.</p>

<p>&nbsp;</p>

<p>1.6 How We Process Your Privacy Rights</p>

<p>First we&#39;ll verify your identity using your personal info. Then we&#39;ll process your request according to company guidelines. You can usually expect a response within 45 days.</p>

<p>&nbsp;</p>

<p>1.7 Authorized Agent</p>

<p>If you&#39;re an authorized agent (such as power of attorney) making a request on behalf of someone else, please contact us.</p>

<p>&nbsp;</p>

<p>1.8 Right to Non-Discrimination For The Exercise Of Your Privacy Rights</p>

<p>You won&#39;t be discriminated against for exercising your privacy rights.</p>

<p>&nbsp;</p>

<p>1.9 How to Contact Us About Your Data</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Call us at (855) 503-0462</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Send an email to Privacy@RapidcashAmerica.com</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Visit <a href="https://www.rocketloans.com/">RapidcashAmerica.com</a> and log into your account</p>

<p><br />
&nbsp;</p>

<p><strong>Changes to Security and Privacy Practices</strong></p>

<p>Since we track security and privacy issues and best practices on a regular basis, our practices can adjust from time to time to help protect you. When our policies change and it is necessary to change this page, you will be able to notify us why this page has changed depending on the effective date below. For more information, to share any comments or concerns regarding our privacy policies, or to view previous iterations of this website, please contact us at Support@RapidcashAmerica.com.</p>

<h1><strong>Rapidcash America Site Accessibility Assistance</strong></h1>

<p>Rapidcash America is committed to making our website available to all, including people with disabilities. If you have an usability problem or require help, please email support@RapidcashAmerica.com (subject: Accessibility).</p>

<p>&nbsp;</p>

<p>In your email, please include the web page address or URL with the specific problem you are having.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<h1><strong>Rates and Fees</strong></h1>

<p>At Rapidcash America, we are committed to supplying you with a personalized loan to fulfill your financial objectives. We offer loans from $2,000 to $7,800 for a duration of 36 or 60 months.Loan interest rates are fixed by Rapidcash America on the basis of the following Conditions:</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; FICO Score</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Monthly Income</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; DTI Ratio</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Home Ownership</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Number of credit inquiries</p>

<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; Loan Term</p>

<p>Annual Percentage Rate (APR) of our loan deals range from a minimum of 8 per cent (Autopay Discount Rate) to a high of 29.99 per cent (rate without autopay discount). APR is the cost of credit as an annual average. (The range of APRs permitted in the state where you live can vary.)</p>

<p><strong>Fee Schedule</strong></p>

<p>&nbsp;</p>

<table cellspacing="0">
<tbody>
<tr>
<td style="background-color:#ffffff; height:36.75pt; vertical-align:top">
<p>Name and Description</p>
</td>
<td style="background-color:#ffffff; height:36.75pt; vertical-align:top">
<p>Amount</p>
</td>
<td style="background-color:#ffffff; height:36.75pt; vertical-align:top">
<p>Frequency</p>
</td>
</tr>
<tr>
<td style="height:64.5pt; vertical-align:top">
<p>Origination Fee &ndash; This is a one-time, non-refundable fee that you will be paying until your loan is fully financed. This fee is taken immediately from the proceeds of the loan.</p>
</td>
<td style="height:64.5pt; vertical-align:top">
<p>1 - 8% of Loan Amount</p>
</td>
<td style="height:64.5pt; vertical-align:top">
<p>This is a one-time fee at funding.</p>
</td>
</tr>
<tr>
<td style="height:51pt; vertical-align:top">
<p>Late Payment Fee &ndash; This fee is paid if you refuse to make any monthly payment within 10 calendar days of the due date (any payment made after 2 p.m. Eastern Time is deemed made on the next business day).</p>
</td>
<td style="height:51pt; vertical-align:top">
<p>$15.00</p>
</td>
<td style="height:51pt; vertical-align:top">
<p>Per occurrence</p>
</td>
</tr>
<tr>
<td style="height:51pt; vertical-align:top">
<p>ACH Refund Charge/Returned Check Fee &ndash; This fee is charged if an electronic clearing house (&#39;ACH&#39;) transfer or search is refused or returned (including non-sufficient).</p>
</td>
<td style="height:51pt; vertical-align:top">
<p>$15.00</p>
</td>
<td style="height:51pt; vertical-align:top">
<p>Per occurrence</p>
</td>
</tr>
</tbody>
</table>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><br />
&nbsp;</p>',
                    'meta_title' => NULL,
                    'meta_keyword' => NULL,
                    'meta_description' => NULL,
                    'meta_robots' => NULL,
                    'created_by' => NULL,
                    'updated_by' => 1,
                    'status' => 1,
                    'created_at' => '2021-02-03 03:23:58',
                    'updated_at' => '2021-02-03 03:23:58',
                    'deleted_at' => NULL,
                ),
            ));
        
        
    }
}