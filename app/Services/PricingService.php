<?php

namespace App\Services;

use App\Models\Sg\SgReport;

class PricingService
{
    public function priceForSgReport(SgReport $report): float
    {
        // Expecting `price` numeric column on SG reports table
        return (float) ($report->price ?? 0);
    }
}
