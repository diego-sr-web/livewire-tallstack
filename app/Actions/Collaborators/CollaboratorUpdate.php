<?php

namespace App\Actions\Collaborators;

use App\Actions\Actionable;
use App\Models\Collaborators\Collaborator;
use Illuminate\Http\Request;

class CollaboratorUpdate extends Actionable
{
    public function handle($request = null, Collaborator $collaborator = null)
    {
        $collaborator->update([
            'name' => data_get($request, 'name'),
        ]);

        return $collaborator;
    }
}
