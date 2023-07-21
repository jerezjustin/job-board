<?php

declare(strict_types=1);

namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class Tags
{
    public function handle(Builder $query, Closure $next): Builder
    {
        $query->when(request()->get('tags'), function (Builder $query): void {
            $tags = request()->tags;

            if (is_string(request()->tags)) {
                $tags = explode(',', trim($tags));
            }

            foreach ($tags as $tag) {
                $query->orWhereHas('tags', function ($query) use ($tag): void {
                    $query->where('name', 'like', '%' . $tag . '%');
                });
            }
        });

        return $next($query);
    }
}
