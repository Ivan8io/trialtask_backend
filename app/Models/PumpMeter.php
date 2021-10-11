<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PumpMeter extends Model
{
    public $timestamps = false;

    protected $table = 'pump_meter_records';

    protected $fillable = ['period_id', 'amount_volume'];

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function scopeLastMonthRecord($query)
    {
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth()->toDateTimeString();

        return $query->whereHas('period', function (Builder $q) use ($lastMonthStart) {
            $q->beginDate($lastMonthStart);
        });
    }
}
