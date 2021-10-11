<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class TariffFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['begin_date'];

    /**
     * Search tariff by month begin date.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function begin_date()
    {
        return $this->builder->whereHas('period', function (Builder $query) {
            $query->where('begin_date', '=', request('begin_date'));
        });
    }
}