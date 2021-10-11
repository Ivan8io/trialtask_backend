<?php

namespace App\Models;

use App\Filters\TariffFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $fillable = ['period_id', 'price'];

    protected $with = ['period:id,begin_date'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder       $query
     * @param  TariffFilters $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, TariffFilters $filters)
    {
        return $filters->apply($query);
    }
}
