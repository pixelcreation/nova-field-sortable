<?php

namespace Naxon\NovaFieldSortable\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Http\Requests\NovaRequest;

trait SortsIndexEntries
{
    /**
     * Build an "index" query for the given resource.
     *
     * @param NovaRequest $request
     * @param Builder     $query
     *
     * @return Builder
     */
    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        $query->when(empty($request->get('orderBy')), function (Builder $q) {
            $q->getQuery()->orders = [];

            return $q->orderBy(static::$defaultSortField);
        });

        return $query;
    }
}