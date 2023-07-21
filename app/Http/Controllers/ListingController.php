<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\View\View;
use Illuminate\Pipeline\Pipeline;

class ListingController extends Controller
{
    public function index(): View
    {
        $resultsPerPage = request()->input('results') ?? 10;

        $listings = app(Pipeline::class)
            ->send(Listing::query())
            ->through([
                \App\QueryFilters\Tags::class,
                \App\QueryFilters\Title::class,
                \App\QueryFilters\Salary::class,
                \App\QueryFilters\OrderBy::class
            ])
            ->thenReturn()
            ->paginate($resultsPerPage)
            ->withQueryString();

        return view('pages.listings.index', [
            'listings' => $listings
        ]);
    }
}
