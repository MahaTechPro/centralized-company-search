<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompanySearchService;

class SearchController extends Controller
{
    public function index(Request $request, CompanySearchService $service)
    {
        $q = $request->query('q', '');
        $results = [];
        if ($q !== '') {
            $results = $service->searchUnified($q, 50);
        }
        return view('search.index', compact('q', 'results'));
    }

    public function search(Request $request, CompanySearchService $service)
    {
        $q = $request->get('q', '');
        $results = $q ? $service->searchUnified($q, 50) : [];
        return view('search.index', compact('q', 'results'));
    }
}
