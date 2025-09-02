<?php

namespace App\Services;

use App\Models\Sg\SgCompany;
use App\Models\Mx\MxCompany;
use Illuminate\Support\Str;

class CompanySearchService
{
    /**
     * Unified search across SG and MX by company name (partial match).
     * Returns standardized array of results.
     *
     * @param string $query
     * @param int $limit
     * @return array<int, array<string, mixed>>
     */
    public function searchUnified(string $query, int $limit = 50): array
    {
        $q = trim($query);
        if ($q === '') return [];

        // SG search
        $sg = SgCompany::select(['id', 'slug', 'name', 'brand_name', 'address'])
            ->where('name', 'like', '%' . addcslashes($q, '%_') . '%')
            ->limit($limit)
            ->get()
            ->map(function ($c) {
                return [
                    'country' => 'SG',
                    'slug' => $c->slug,
                    'name' => $c->name,
                    'brand_name' => $c->brand_name,
                    'address' => $c->address,
                    'url' => route('companies.show', ['country' => 'SG', 'slug' => $c->slug]),
                ];
            })->toArray();

        // MX search
        $mx = MxCompany::select(['id', 'slug', 'name', 'brand_name', 'address'])
            ->where('name', 'like', '%' . addcslashes($q, '%_') . '%')
            ->limit($limit)
            ->get()
            ->map(function ($c) {
                return [
                    'country' => 'MX',
                    'slug' => $c->slug,
                    'name' => $c->name,
                    'brand_name' => $c->brand_name,
                    'address' => $c->address,
                    'url' => route('companies.show', ['country' => 'MX', 'slug' => $c->slug]),
                ];
            })->toArray();

        // Merge and cap
        $merged = array_slice(array_merge($sg, $mx), 0, $limit);
        return $merged;
    }
}
