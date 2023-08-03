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
    public function index(Request $request)
    {
        $employes = Employe::with('contribuable')->paginate();

        return $employes;
    }

    public function store(EmployeStoreRequest $request)
    {
        $employe = Employe::create($request->validated());

        return new EmployeResource($employe);
    }

    public function show(Request $request, Employe $employe)
    {
        return new EmployeResource($employe);
    }

    public function update(EmployeUpdateRequest $request, Employe $employe)
    {
        $employe->update($request->validated());

        return new EmployeResource($employe);
    }

    public function destroy(Request $request, Employe $employe)
    {
        $employe->delete();

        return response()->noContent();
    }
}
