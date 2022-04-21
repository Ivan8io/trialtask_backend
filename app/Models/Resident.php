<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    public $timestamps = false;

    protected $fillable = ['fio', 'area', 'start_date'];

    protected $appends = ['locale_date'];

    public function getLocaleDateAttribute(): string
    {
        return Carbon::parse($this->start_date)->formatLocalized('%e %B %Y');
    }
}
