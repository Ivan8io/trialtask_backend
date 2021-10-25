<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveResidentRequest;
use App\Http\Resources\ResidentCollection;
use App\Models\Resident;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResidentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResidentCollection
     */
    public function index()
    {
        return new ResidentCollection(Resident::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveResidentRequest $request
     * @return JsonResponse
     */
    public function store(SaveResidentRequest $request)
    {
        $validatedData = $request->validated();

        try {
            return Resident::create($validatedData);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['area' => ['Слишком большая площадь.']]], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SaveResidentRequest $request
     * @param  Resident  $resident
     * @return JsonResponse|Resident
     */
    public function update(SaveResidentRequest $request, Resident $resident)
    {
        $validatedData = $request->validated();

        try {
            $resident->update($validatedData);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['area' => ['Слишком большая площадь']]], 422);
        }

        return $resident;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Resident  $resident
     * @return JsonResponse
     */
    public function destroy(Resident $resident)
    {
        $resident->delete();

        return response()->json(null, 204);
    }
}
