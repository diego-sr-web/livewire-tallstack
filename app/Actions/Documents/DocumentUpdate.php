<?php 

namespace App\Actions\Documents;

use App\Actions\Actionable;
use App\Models\Collaborators\Collaborator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Companies\Company;

class DocumentUpdate extends Actionable
{
    public function handle($request = null, Collaborator|Company $objetRelation = null)
    {
        foreach ($objetRelation->documents as $document) {
            $field = 'document.' . $document->documentType->name;
            
            if (data_get($request, $field)) {
                $document->document = cleanCnpjCpf($document->documentType->name, data_get($request, $field));
                $document->save();
            }
        }

        return true;
    }
}