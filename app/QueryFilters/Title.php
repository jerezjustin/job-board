<?php

declare(strict_types=1);

namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class Title
{
    public function handle(Builder $query, Closure $next): Builder
    {
        $query->when(request()->get('title'), fn (Builder $query) => $query->where('title', 'like', '%' . request()->title . '%'));

        return $next($query);
    }
}
