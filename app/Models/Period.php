<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    public $timestamps = false;

    public function tariff()
    {
        return $this->hasOne(Tariff::class);
    }

    public function scopeBeginDate($query, $monthStart)
    {
        return $query->where('begin_date', $monthStart);
    }
}
