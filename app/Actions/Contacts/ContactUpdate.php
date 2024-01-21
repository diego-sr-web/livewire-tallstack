<?php 

namespace App\Actions\Contacts;

use App\Actions\Actionable;
use App\Models\Collaborators\Collaborator;
use App\Models\Companies\Company;

class ContactUpdate extends Actionable
{
    public function handle($request = null, Collaborator|Company $objetRelation = null)
    {
        foreach ($objetRelation->contacts as $contact) {
            $field = 'contact.' . $contact->contactType->name;

            if (data_get($request, $field)) {
                $contact->contact = cleanPhone($contact->contactType->name, data_get($request, $field));
                $contact->save();
            }
        }

        return true;
    }
}