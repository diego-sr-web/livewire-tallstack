<?php

namespace App\Mail;

use App\Models\Machines\Step;
use App\Models\MailTemplates\MailTemplate;
use App\Models\Users\User;
use App\Services\MailVariable;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param User $user
     * @param MailTemplate $mailTemplate
     * @param array $param
     *
     * @return void
     */
    public function __construct(
        public User $user, 
        public Step $step,
        // public MailTemplate $mailTemplate,
        public $params = array()
    )
    {
    }

    public function build()
    {
        // $mailVariable = new MailVariable($this->user, $this->mailTemplate, $this->params);
        // $this->subject = $mailVariable->setSubject($this->mailTemplate->subject);
        $this->subject = $this->step->name;

        // $data = $mailVariable->data();
        $data = [];

        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->view('mail.mail-template', ['body' => $data])
            ->text('mail.mail-template-text', ['user' => $data]);
    }
}
