<?php

namespace App\Actions\Collaborators;

use App\Actions\Actionable;
use App\Models\Collaborators\Collaborator;

class CollaboratorStore extends Actionable
{
    public function handle($request = null)
    {
        return Collaborator::create([
            'company_id' => companyId($request),
            'name' => data_get($request, 'name'),
        ]);
    }
}
