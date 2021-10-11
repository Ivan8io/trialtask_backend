<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePumpMeterRequest;
use App\Models\PumpMeter;
use App\Services\PumpMeterService;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class PumpMetersController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePumpMeterRequest  $request
     * @return JsonResponse|PumpMeter
     */
    public function store(StorePumpMeterRequest $request, PumpMeterService $service)
    {
        $validatedData = $request->validated();

        try {
            return $service->create($validatedData);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['amount_volume' => ['Показания уже переданы']]], 422);
        }
    }

    /**
     * @return string|null
     */
    public function getLastMonthRecord(): ?string
    {
        return PumpMeter::lastMonthRecord()->value('amount_volume');
    }
}
