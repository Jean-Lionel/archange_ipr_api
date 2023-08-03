<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeStoreRequest;
use App\Http\Requests\EmployeUpdateRequest;
use App\Http\Resources\EmployeCollection;
use App\Http\Resources\EmployeResource;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeController extends Controller
{
    public function index(Request $request): Response
    {
        $employes = Employe::all();

        return new EmployeCollection($employes);
    }

    public function store(EmployeStoreRequest $request): Response
    {
        $employe = Employe::create($request->validated());

        return new EmployeResource($employe);
    }

    public function show(Request $request, Employe $employe): Response
    {
        return new EmployeResource($employe);
    }

    public function update(EmployeUpdateRequest $request, Employe $employe): Response
    {
        $employe->update($request->validated());

        return new EmployeResource($employe);
    }

    public function destroy(Request $request, Employe $employe): Response
    {
        $employe->delete();

        return response()->noContent();
    }
}
