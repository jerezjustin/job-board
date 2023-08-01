<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Listing;
use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;

class CreateListing
{
    public function handle(array $data, ?Authenticatable $user = null): Listing
    {
        if ( ! $user) {
            $user = Auth::user();
        }

        return $user->listings()->create([
            'title' => $title = $data['title'],
            'slug' => Str::slug($title) . '-' . rand(1111, 9999),
            'company' => $data['company'],
            'location' => $data['location'],
            'salary' => $data['salary'],
            'contract_type' => $data['contract_type'],
            'apply_link' => $data['apply_link'],
            'content' => $data['content'],
            'logo' => $data['logo']
        ]);
    }
}
