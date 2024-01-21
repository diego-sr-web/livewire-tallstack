<?php

namespace App\Actions\Companies;

use App\Actions\Actionable;
use App\Models\Companies\Company;
use Illuminate\Http\Request;

class CompanyUpdate extends Actionable
{
    public function handle($request = null, Company $company = null)
    {
        $company->update([
            'name' => data_get($request, 'name'),
            "fantasy_name" => data_get($request, 'fantasy_name'),
            "site" => data_get($request, 'site'),
            'status' => data_get($request, 'status') ?? $company->status,
        ]);

        return $company;
    }
}
