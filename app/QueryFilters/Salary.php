<?php

declare(strict_types=1);

namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class Salary
{
    public function handle(Builder $query, Closure $next): Builder
    {
        $query->when(request()->get('salary'), function ($query): void {
            $query->where('salary', '>=', request()->salary);
        });

        return $next($query);
    }
}
