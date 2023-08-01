<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateListing;
use App\Actions\CreateTags;
use App\Actions\RegisterUser;
use App\Http\Requests\StoreListingRequest;
use App\Models\Listing;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use Throwable;

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

    public function create(): View
    {
        return view('pages.listings.create');
    }

    /**
     * @throws Throwable
     */
    public function store(StoreListingRequest $request): RedirectResponse
    {
        $user = Auth::check();

        if ( ! $user) {
            $user = (new RegisterUser())->handle([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);
        }

        $amount = 4999;

        $user->charge($amount, $request->input('payment_method_id'));

        $tags = (new CreateTags())->handle($request->input('tags'));

        $listing = (new CreateListing())->handle([
            ...$request->except('logo'),
            'logo' => $request->file('logo')
                ? basename($request->file('logo')?->store('public'))
                : null
        ], $user);

        $listing->tags()->attach($tags);

        return redirect()->route('home');
    }
}
