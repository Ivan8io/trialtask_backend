<?php

namespace App\Services;

use App\Models\Period;
use App\Models\PumpMeter;
use Carbon\Carbon;

class PumpMeterService
{
    public function create($validatedData)
    {
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth()->toDateTimeString();

        $periodId = Period::beginDate($lastMonthStart)->value('id');

        if ($periodId) {
            $validatedData['period_id'] = $periodId;

            return PumpMeter::create($validatedData);
        }

        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth()->endOfDay()->toDateTimeString();

        return \DB::transaction(function () use ($lastMonthStart, $lastMonthEnd, $validatedData) {
            $period = new Period();
            $period->begin_date = $lastMonthStart;
            $period->end_date = $lastMonthEnd;
            $period->save();

            $validatedData['period_id'] = $period->id;

            return PumpMeter::create($validatedData);
        });
    }
}