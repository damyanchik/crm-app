<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanyRequest;
use App\Services\CompanyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function __construct(protected CompanyService $companyService)
    {
    }

    public function edit(): View
    {
        return view('admin.company_details', [
            'companyDetails' => $this->companyService->getAll()
        ]);
    }

    public function update(UpdateCompanyRequest $detailsRequest): RedirectResponse
    {
        try {
            $this->companyService->update($detailsRequest->validated());
            return redirect()->route('companyDetailsAdmin')->with('message', 'Dane zostały zaktualizowane.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie zapisu.');
        }
    }
}
