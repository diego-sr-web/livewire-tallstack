<?php

namespace App\Actions\SendMail;

use App\Actions\Actionable;
use App\Actions\Verification\NewCode;
use App\Mail\SendMailTemplate;
use Illuminate\Support\Facades\Mail;
use App\Models\MailTemplates\MailTemplate;
use App\Models\Users\RegisterConfirmation;

class CreateNewUser extends Actionable
{    
    public function handle(
        $user = null,
    ) {
        /** @var RegisterConfirmation $registerConfirmation */
        $registerConfirmation = NewCode::run($user);

        $mailTemplate = MailTemplate::find(1);
        $params = array('code' => $registerConfirmation->code);

        Mail::to($registerConfirmation->user)
            ->send(new SendMailTemplate($registerConfirmation->user, $mailTemplate, $params));

        return $registerConfirmation;
    }
}
