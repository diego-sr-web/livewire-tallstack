<?php 

namespace App\Actions\Addresses;

use App\Actions\Actionable;
use App\Models\Addresses\Address;
use App\Models\Collaborators\Collaborator;
use App\Models\Companies\Company;

class AddressStore extends Actionable
{
    public function handle($request = null, Collaborator|Company $objetRelation = null)
    {
        return Address::create([
            'rel_id' => $objetRelation->id,
            'rel_type' => $objetRelation::class,
            "zip_code" => data_get($request, 'zip_code'),
            "street" => data_get($request, 'street'),
            "number" => data_get($request, 'number'),
            "complement" => data_get($request, 'complement'),
            "neighborhood" => data_get($request, 'neighborhood'),
            "city" => data_get($request, 'city'),
            "state" => data_get($request, 'state'),
        ]);
    }
}