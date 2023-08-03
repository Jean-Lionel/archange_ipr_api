<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContribuableStoreRequest;
use App\Http\Requests\ContribuableUpdateRequest;
use App\Http\Resources\ContribuableCollection;
use App\Http\Resources\ContribuableResource;
use App\Models\Contribuable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContribuableController extends Controller
{
    public function index(Request $request): Response
    {
        $contribuables = Contribuable::all();

        return new ContribuableCollection($contribuables);
    }

    public function store(ContribuableStoreRequest $request): Response
    {
        $contribuable = Contribuable::create($request->validated());

        return new ContribuableResource($contribuable);
    }

    public function show(Request $request, Contribuable $contribuable): Response
    {
        return new ContribuableResource($contribuable);
    }

    public function update(ContribuableUpdateRequest $request, Contribuable $contribuable): Response
    {
        $contribuable->update($request->validated());

        return new ContribuableResource($contribuable);
    }

    public function destroy(Request $request, Contribuable $contribuable): Response
    {
        $contribuable->delete();

        return response()->noContent();
    }
}
