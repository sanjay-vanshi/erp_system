<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanySettingRequest;
use App\Models\CompanySetting;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class CompanySettingController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware(
                'permission:view company settings',
                only: [
                    'index',
                ]
            ),

            new Middleware(
                'permission:edit company settings',
                only: [
                    'update',
                ]
            ),

        ];
    }

    /**
     * Display settings
     */
    public function index()
    {

        $company = CompanySetting::first();

        return view(
            'company_settings.index',
            compact('company')
        );

    }

    /**
     * Update settings
     */
    public function update(
        UpdateCompanySettingRequest $request
    ) {

        $company = CompanySetting::first();

        $data = $request->validated();

        if ($request->hasFile('logo')) {

            if ($company && $company->logo) {

                Storage::disk('public')
                    ->delete($company->logo);

            }

            $data['logo'] = $request
                ->file('logo')
                ->store(
                    'company',
                    'public'
                );

        }

        if ($company) {

            $company->update($data);

        } else {

            CompanySetting::create($data);

        }

        return redirect()

            ->route('company-settings.index')

            ->with(
                'success',
                'Company settings updated successfully'
            );

    }
}
