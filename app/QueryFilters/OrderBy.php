<?php

declare(strict_types=1);

namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class OrderBy
{
    public function handle(Builder $query, Closure $next): Builder
    {
        $query->when(request()->get('orderBy'), function ($query): void {
            $query->orderBy(request()->orderBy, request()->direction ?? 'desc');
        });

        return $next($query);
    }
}
