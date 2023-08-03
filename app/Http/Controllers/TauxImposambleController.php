<?php

namespace App\Http\Controllers;

use App\Http\Requests\TauxImposambleStoreRequest;
use App\Http\Requests\TauxImposambleUpdateRequest;
use App\Http\Resources\TauxImposambleCollection;
use App\Http\Resources\TauxImposambleResource;
use App\Models\TauxImposamble;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TauxImposambleController extends Controller
{
    public function index(Request $request): Response
    {
        $tauxImposambles = TauxImposamble::all();

        return new TauxImposambleCollection($tauxImposambles);
    }

    public function store(TauxImposambleStoreRequest $request): Response
    {
        $tauxImposamble = TauxImposamble::create($request->validated());

        return new TauxImposambleResource($tauxImposamble);
    }

    public function show(Request $request, TauxImposamble $tauxImposamble): Response
    {
        return new TauxImposambleResource($tauxImposamble);
    }

    public function update(TauxImposambleUpdateRequest $request, TauxImposamble $tauxImposamble): Response
    {
        $tauxImposamble->update($request->validated());

        return new TauxImposambleResource($tauxImposamble);
    }

    public function destroy(Request $request, TauxImposamble $tauxImposamble): Response
    {
        $tauxImposamble->delete();

        return response()->noContent();
    }
}
