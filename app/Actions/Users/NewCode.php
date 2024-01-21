<?php

namespace App\Actions\Users;

use App\Models\Users\User;
use App\Actions\Actionable;
use Illuminate\Support\Str;
use App\Models\Users\RegisterConfirmation;

class NewCode extends Actionable
{
    /**
     * @param null $user
     * @param bool|null $forceVerification
     * 
     * @return RegisterConfirmation 
     */
    public function handle(
        $user = null,
        ?bool $forceVerification = false,
    ) {
        $code = strtoupper(Str::random(6));

        if (is_string($user)) {
            $user = User::where('email', $user)->first();
        }

        if ($user) {
            if ($forceVerification) {
                $user->email_verified_at = null;
                $user->save();
            }
            
            if ($user->registerConfirmations->count()) {
                foreach ($user->registerConfirmations->count() as $registerConfirmation) {
                    $registerConfirmation->delete();            
                }
            }

            return RegisterConfirmation::create([
                'user_id' => $user->id,
                'code' => $code,
            ]);
        }

        throw new \Exception("Nenhum código foi criado");
    }
}
