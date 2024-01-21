<?php 

namespace App\Actions\Addresses;

use App\Actions\Actionable;
use App\Models\Addresses\Address;
use Illuminate\Http\Request;

class AddressUpdate extends Actionable
{
    public function handle($request = null, Address $address = null)
    {
        $address->update([
            "zip_code" => data_get($request, 'zip_code'),
            "street" => data_get($request, 'street'),
            "number" => data_get($request, 'number'),
            "complement" => data_get($request, 'complement'),
            "neighborhood" => data_get($request, 'neighborhood'),
            "city" => data_get($request, 'city'),
            "state" => data_get($request, 'state'),
        ]);

        return $address;
    }
}