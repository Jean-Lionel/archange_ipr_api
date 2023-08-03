<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdresseStoreRequest;
use App\Http\Requests\AdresseUpdateRequest;
use App\Http\Resources\AdressCollection;
use App\Http\Resources\AdresseResource;
use App\Models\Adresse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdresseController extends Controller
{
    public function index(Request $request)
    {
        $adresses = Adresse::all();

        return new AdressCollection($adresses);
    }

    public function store(AdresseStoreRequest $request)
    {
        $adresse = Adresse::create($request->validated());

        return new AdresseResource($adresse);
    }

    public function show(Request $request, Adresse $adresse)
    {
        return new AdresseResource($adresse);
    }

    public function update(AdresseUpdateRequest $request, Adresse $adresse)
    {
        $adresse->update($request->validated());

        return new AdresseResource($adresse);
    }

    public function destroy(Request $request, Adresse $adresse)
    {
        $adresse->delete();

        return response()->noContent();
    }
}
