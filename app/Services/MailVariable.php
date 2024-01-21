<?php
namespace App\Services;

use App\Models\Users\User;
use App\Models\MailTemplate;

class MailVariable
{
    public function __construct(public User $user, public MailTemplate $mailTemplate, public $params = array())
    {
    }

    public function data()
    {
        $body = $this->mailTemplate->body;
        
        $body = str_replace('{EMAIL}', $this->user->email, $body);
        $body = str_replace('{APP_NAME}', env('APP_NAME'), $body);
        
        if (isset($this->params['code'])) {
            $body = str_replace('{CODIGO}', $this->params['code'], $body);
        }
        
        if (isset($this->params['password'])) {
            $body = str_replace('{PASSWORD}', $this->params['password'], $body);
        }

        return $body;
    }

    public function setSubject($subject)
    {
        $subject = str_replace('{APP_NAME}', env('APP_NAME'), $subject);
        $subject = str_replace('{NOME}', $this->user->name, $subject);

        return $subject;
    }
}
