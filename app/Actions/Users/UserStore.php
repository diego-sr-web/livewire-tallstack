<?php 

namespace App\Actions\Users;

use App\Models\Users\User;
use App\Actions\Actionable;
use App\Models\Collaborators\Collaborator;
use Illuminate\Http\Request;
use App\Models\Companies\Company;
use App\Models\Users\Profile;

class UserStore extends Actionable
{
    public function handle($request = null, Collaborator|Company $objetRelation = null)
    {
        $user = User::create([            
            'email' => data_get($request, 'email'),
            'email_verified_at' => now(),
            'password' => bcrypt(data_get($request, 'password')),
            'is_admin' => data_get($request, 'is_admin') ?? 0,
        ]);

        Profile::create([
            'user_id' => $user->id,
            'rel_id' => $objetRelation->id,
            'rel_type' => $objetRelation::class,
            'role_id' => data_get($request, 'role')
        ]);

        return $user;
    }
}