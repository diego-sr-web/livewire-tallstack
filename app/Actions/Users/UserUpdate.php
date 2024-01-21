<?php 

namespace App\Actions\Users;

use App\Actions\Actionable;
use App\Models\Collaborators\Collaborator;
use App\Models\Companies\Company;

class UserUpdate extends Actionable
{
    public function handle($request = null, Collaborator|Company $objetRelation = null)
    {
        $user = $objetRelation->profile->user;

        $dataUser = [
            'email' => data_get($request, 'email'),
            'is_admin' => data_get($request, 'is_admin') ?? 0,
        ];

        if (data_get($request, 'password')) {
            $dataUser['password'] = bcrypt(data_get($request, 'password'));
        }

        $user->update($dataUser);

        if (data_get($request, 'role')) {
            $user->profile->role_id = data_get($request, 'role');
            $user->profile->save();
        }

        return true;
    }
}