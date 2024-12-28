<?php

namespace App\Http\QueryFilters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;


class UnsolvedQueryFilter implements Filter {
    public function __invoke (Builder $query, $value, string $property) {
        
        $query->whereNull('solution_post_id');
    }
}