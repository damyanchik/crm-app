<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanyDetailsRequest;
use App\Models\CompanyInfo;

class CompanyDetailsController extends Controller
{
    public function edit(): object
    {
        $companyDetails = CompanyInfo::all()->first();
        return view('admin.company_details', [
            'companyDetails' => $companyDetails
        ]);
    }

    public function update(UpdateCompanyDetailsRequest $detailsRequest)
    {
        $formFields = $detailsRequest->validated();

        CompanyInfo::updateOrCreate(
            ['id' => 1],
            $formFields
        );

        return back()->with('Dane zostały zaktualizowane');
    }
}
