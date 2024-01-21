<?php

namespace App\Actions\Companies;

use App\Actions\Actionable;
use App\Models\Companies\Company;
use Illuminate\Http\Request;

class CompanyStore extends Actionable
{
    public function handle($request = null)
    {
        return Company::create([
            'name' => data_get($request, 'name'),
            'fantasy_name' => data_get($request, 'fantasy_name'),
            'site' => data_get($request, 'site'),
        ]);
    }    
}
