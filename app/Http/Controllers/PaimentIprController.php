<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaimentIprStoreRequest;
use App\Http\Requests\PaimentIprUpdateRequest;
use App\Http\Resources\PaimentIprCollection;
use App\Http\Resources\PaimentIprResource;
use App\Models\Employe;
use App\Models\PaimentIpr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaimentIprController extends Controller
{

    public function generate_ipr(){
        // recueillir tout les salaries qui n'ont pas encore payé le IPR pour le moins encours

        $list_payments = PaimentIpr::where('date_paiement', 'like', date('Y-m-d').'%')->get()->map->employe_id;
        $employes = Employe::whereNotIn('id', $list_payments)->get();

        foreach ($employes as $key => $employe) {
            # code...
            $ipr = $employe->calculus_ipr();
            PaimentIpr::create([
                'contribuable_id' => 1,
                'employe_id' => $employe->id,
                'date_paiement' => date('Y-m-d H:i:s'),
                'montant_employe' => 0,
                'base_imposable' => $ipr['base_imposable'],
                'remuneration_brut' => $ipr['remuneration_brut'],
                'inss' => $ipr['inss'],
                'IPR' => $ipr['IPR'],
                'mfp' => $ipr['mfp'],
                'montant_employeur' => 0,
                'total_paiement' => 0
            ]);

        }

    }
    public function index(Request $request)
    {
        $paimentIprs = PaimentIpr::all();

        return new PaimentIprCollection($paimentIprs);
    }

    public function store(PaimentIprStoreRequest $request)
    {
        $paimentIpr = PaimentIpr::create($request->validated());

        return new PaimentIprResource($paimentIpr);
    }

    public function show(Request $request, PaimentIpr $paimentIpr)
    {
        return new PaimentIprResource($paimentIpr);
    }

    public function update(PaimentIprUpdateRequest $request, PaimentIpr $paimentIpr)
    {
        $paimentIpr->update($request->validated());

        return new PaimentIprResource($paimentIpr);
    }

    public function destroy(Request $request, PaimentIpr $paimentIpr)
    {
        $paimentIpr->delete();

        return response()->noContent();
    }
}
