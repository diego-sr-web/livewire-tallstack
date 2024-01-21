<?php 

namespace App\Actions\Contacts;

use App\Actions\Actionable;
use App\Models\Collaborators\Collaborator;
use Illuminate\Http\Request;
use App\Models\Companies\Company;
use App\Models\Contacts\ContactType;

class ContactStore extends Actionable
{
    public function handle($request = null, Collaborator|Company $objetRelation = null)
    {
        $contactTypes = ContactType::query()
            ->where('active', 1)
            ->get();
            
        foreach ($contactTypes as $contactType) {
            $field = 'contact.' . $contactType->name;

            if (data_get($request, $field)) {
                $objetRelation->contacts()->create([
                    'contact_type_id' => $contactType->id,
                    'rel_id' => $objetRelation->id,
                    'rel_type' => $objetRelation::class,
                    'contact' => cleanPhone($contactType->name, data_get($request, $field)),
                ]);
            }
        }

        return true;
    }
}