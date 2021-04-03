<?php

namespace App\Notifications;

use App\Helpers\BaseHelper;
use App\Models\Admin;
use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;

class MailResetPasswordNotification extends Notification
{
    use Queueable;
    public $helper;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $link = route("password.reset",['token' => $this->token]);
        $view = 'email.reset';
        $userObj = $notifiable;
        $objectData['link'] = $link;
        // $helper = new BaseHelper();
        // $mail = $helper->sendMailToAdmin(config('constant.mail_template.2'),$view,$userObj,null,$objectData);
        $emailObjData = EmailTemplate::whereSlug(config('constant.mail_template.2'))->first();
        if (isset($emailObjData)) {
            $emailData = [ 'email' => @$userObj->email,'display_name' => @$userObj->full_name , 'content' => @$emailObjData->content,'body'=>@$emailObjData->body,'objectData'=>@$objectData];
            $subject = $emailObjData->subject;
            $emails = Admin::where('status',1)->pluck('email')->toArray();
        }
        return ( new MailMessage )
                ->markdown('email.reset',$emailData)
                ->from('info@example.com')
                ->subject($subject);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
