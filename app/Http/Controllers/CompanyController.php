<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sg\SgCompany;
use App\Models\Sg\SgReport;
use App\Models\Mx\MxCompany;
use App\Models\Mx\MxReport;
use App\Models\Mx\MxReportState;
use App\Models\Mx\MxState;
use App\Services\PricingService;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function show(string $country, string $slug, PricingService $pricing)
    {
        $country = strtoupper($country);
        if ($country === 'SG') {
            $company = SgCompany::where('slug', $slug)->firstOrFail();
            $reports = SgReport::orderBy('order')->get()->map(function($r) use ($pricing) {
                return [
                    'id' => $r->id,
                    'name' => $r->name,
                    'info' => $r->info,
                    'price' => $pricing->priceForSgReport($r),
                    'country' => 'SG',
                ];
            });
            return view('companies.show', [
                'company' => [
                    'country' => 'SG',
                    'slug' => $company->slug,
                    'name' => $company->name,
                    'brand_name' => $company->brand_name ?? null,
                    'address' => $company->address ?? null,
                    'extra' => $company->toArray(),
                ],
                'reports' => $reports,
            ]);
        }

        if ($country === 'MX') {
            $company = MxCompany::where('slug', $slug)->with('state')->firstOrFail();

            // reports available for this company's state
            $reportStates = MxReportState::where('state_id', $company->state_id)
                ->with('report')
                ->orderBy('id')
                ->get();

            $reports = $reportStates->map(function($rs) {
                return [
                    'id' => $rs->report->id,
                    'name' => $rs->report->name,
                    'info' => $rs->report->info,
                    'price' => (float) $rs->amount,
                    'country' => 'MX',
                ];
            });

            return view('companies.show', [
                'company' => [
                    'country' => 'MX',
                    'slug' => $company->slug,
                    'name' => $company->name,
                    'brand_name' => $company->brand_name ?? null,
                    'address' => $company->address ?? null,
                    'state' => $company->state ? $company->state->name : null,
                    'extra' => $company->toArray(),
                ],
                'reports' => $reports,
            ]);
        }

        abort(404);
    }
}
