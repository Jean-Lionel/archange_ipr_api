<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaimentIprStoreRequest;
use App\Http\Requests\PaimentIprUpdateRequest;
use App\Http\Resources\PaimentIprCollection;
use App\Http\Resources\PaimentIprResource;
use App\Models\PaimentIpr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaimentIprController extends Controller
{
    public function index(Request $request): Response
    {
        $paimentIprs = PaimentIpr::all();

        return new PaimentIprCollection($paimentIprs);
    }

    public function store(PaimentIprStoreRequest $request): Response
    {
        $paimentIpr = PaimentIpr::create($request->validated());

        return new PaimentIprResource($paimentIpr);
    }

    public function show(Request $request, PaimentIpr $paimentIpr): Response
    {
        return new PaimentIprResource($paimentIpr);
    }

    public function update(PaimentIprUpdateRequest $request, PaimentIpr $paimentIpr): Response
    {
        $paimentIpr->update($request->validated());

        return new PaimentIprResource($paimentIpr);
    }

    public function destroy(Request $request, PaimentIpr $paimentIpr): Response
    {
        $paimentIpr->delete();

        return response()->noContent();
    }
}
