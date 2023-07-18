<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $listings = Listing::latest()->limit(5)->get();

        return view('pages.home', [
            'listings' => $listings
        ]);
    }
}
