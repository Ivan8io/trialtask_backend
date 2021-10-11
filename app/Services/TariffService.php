<?php

namespace App\Services;

use App\Http\Resources\TariffResource;
use App\Models\Period;
use App\Models\Tariff;
use Carbon\Carbon;

class TariffService
{
    public function create($validatedData)
    {
        $beginDate = $validatedData['begin_date'];
        $validatedData['begin_date'] = Carbon::parse($beginDate)->startOfMonth()->toDateTimeString();

        $periodId = Period::beginDate($validatedData['begin_date'])->value('id');

        if ($periodId) {
            unset($validatedData['begin_date']);

            $validatedData['period_id'] = $periodId;

            $tariff = Tariff::create($validatedData);

            return new TariffResource($tariff);
        }

        $validatedData['end_date'] = Carbon::parse($beginDate)->endOfMonth()->endOfDay()->toDateTimeString();

        return \DB::transaction(function () use ($validatedData) {
            $period = new Period();
            $period->begin_date = $validatedData['begin_date'];
            $period->end_date = $validatedData['end_date'];
            $period->save();

            unset($validatedData['begin_date']);
            unset($validatedData['end_date']);

            $validatedData['period_id'] = $period->id;

            $tariff = Tariff::create($validatedData);

            return new TariffResource($tariff);
        });
    }
}