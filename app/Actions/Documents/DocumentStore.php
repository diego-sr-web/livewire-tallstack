<?php 

namespace App\Actions\Documents;

use App\Actions\Actionable;
use App\Models\Collaborators\Collaborator;
use Illuminate\Http\Request;
use App\Models\Companies\Company;
use App\Models\Documents\DocumentType;

class DocumentStore extends Actionable
{
    public function handle($request = null, Collaborator|Company $objetRelation = null)
    {
        $type = $objetRelation::class == Collaborator::class ? 'COL' : 'COM';
        $documentTypes = DocumentType::query()
            ->where('type', $type)
            ->get();
            
        foreach ($documentTypes as $documentType) {
            $objetRelation->documents()->create([
                'document_type_id' => $documentType->id,
                'rel_id' => $objetRelation->id,
                'rel_type' => $objetRelation::class,
                'document' => cleanCnpjCpf($documentType->name, data_get($request, 'document.' . $documentType->name)),
            ]);            
        }

        return true;
    }
}