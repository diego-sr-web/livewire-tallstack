<?php

namespace App\Actions\SendMail;

use App\Actions\Actionable;
use App\Actions\Verification\NewCode;
use App\Mail\SendMailTemplate;
use Illuminate\Support\Facades\Mail;
use App\Models\MailTemplates\MailTemplate;
use App\Models\Users\RegisterConfirmation;

class NewCodeToActivate extends Actionable
{    
    public function handle(
        ?string $email = null,
    ) {
        /** @var RegisterConfirmation $registerConfirmation */
        $registerConfirmation = NewCode::run($email);

        $mailTemplate = MailTemplate::find(3);
        $params = array('code' => $registerConfirmation->code);

        Mail::to($registerConfirmation->user)
            ->send(new SendMailTemplate($registerConfirmation->user, $mailTemplate, $params));

        return $registerConfirmation;
    }
}
