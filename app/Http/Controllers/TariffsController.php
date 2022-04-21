<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Filters\TariffFilters;
use App\Http\Requests\SaveTariffRequest;
use App\Http\Resources\TariffResource;
use App\Models\Tariff;
use App\Services\TariffService;
use Illuminate\Http\JsonResponse;

class TariffsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|TariffResource
     */
    public function index(TariffFilters $filters)
    {
        $tariff = Tariff::filter($filters)->first();

        if ($tariff) {
            return new TariffResource($tariff);
        }

        return response()->json(null, 204);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveTariffRequest $request
     * @return JsonResponse|Tariff
     */
    public function store(SaveTariffRequest $request, TariffService $service)
    {
        $validatedData = $request->validated();

        return $service->create($validatedData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Tariff $tariff
     * @return TariffResource|JsonResponse
     */
    public function update(SaveTariffRequest $request, Tariff $tariff)
    {
        $validatedData = $request->validated();

        $tariff->update($validatedData);

        return new TariffResource($tariff);
    }
}
