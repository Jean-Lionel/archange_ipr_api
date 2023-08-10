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
    public function sum_ipr($month , $year){

       $data = PaimentIpr::whereMonth('date_paiement', '=', $month ?? date('m'))
                    ->whereYear('date_paiement', '=', $year ?? date('Y'))
                    ->get();
        return [
            "total" => [
                'total_ipr' => $data->sum('IPR'),
                'total_inss' => $data->sum('inss'),
                'total_mfp' => $data->sum('mfp'),
                'total_remuneration_brut' => $data->sum('remuneration_brut'),
            ],
            "records" => $data
        ];
    }
    public function generate_ipr(){
        // recueillir tout les salaries qui n'ont pas encore payé le IPR pour le moins encours

        $list_payments = PaimentIpr::where('date_paiement', 'like', date('Y-m-d').'%')->get()->map->employe_id;
        $employes = Employe::whereNotIn('id', $list_payments)->get();

        foreach ($employes as $key => $employe) {
            # code...
            $ipr = $employe->calculer_ipr();
            PaimentIpr::create([
                'contribuable_id' => random_int(2,10),
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
