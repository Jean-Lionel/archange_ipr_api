<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
* @mixin IdeHelperEmploye
*/
class Employe extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'cni',
        'nom',
        'prenom',
        'status_employe',
        'mfp',
        'salaire_base',
        'frais_deplacement',
        'indeminite_compansatoire',
        'avantage_en_nature',
        'contribuable_id',
    ];

    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'id' => 'integer',
        'salaire_base' => 'double',
        'frais_deplacement' => 'double',
        'indeminite_compansatoire' => 'double',
        'avantage_en_nature' => 'double',
        'contribuable_id' => 'integer',
    ];

    public function contribuable(): BelongsTo
    {
        return $this->belongsTo(Contribuable::class);
    }
    public function calculer_ipr()
    {
        $remuneration_brut = $this->salaire_base + $this->frais_deplacement + $this->indeminite_compansatoire + $this->avantage_en_nature;

        $base = $remuneration_brut;
        /**L'inss est calculé sur un revenu qui n'est pas supérieur à 450 000 */
        if($remuneration_brut >= 450000){
            $base = 450000;
        }
        $inss =   $base * 4 / 100;

        $mfp = ($remuneration_brut - $this->indeminite_compansatoire) * 4 / 100;

        $base_imposable = $remuneration_brut ;
        //  print_r($base_imposable);
        if((($this->frais_deplacement * 100 ) / $this->salaire_base) > 15){
            $base_imposable -= ($this->salaire_base * 15) / 100;
        }else{
            $base_imposable -= $this->frais_deplacement;
        }
        if(((($this->indeminite_compansatoire * 100 ) / $this->salaire_base) > 60)){
            $base_imposable -= ($this->salaire_base * 60) / 100;
        }else{
            $base_imposable -= $this->indeminite_compansatoire;
        }
        $base_imposable += $this->avantage_en_nature;
        if(((($this->cotisations * 100 ) / $this->salaire_base) > 20)){
            $base_imposable += $this->cotisations;
        }
        //BAREME QUI S’APPLIQUE  MENSUELLEMENT

       /**De A
            0 150,000 0%
            150,001 300,000 20% de la part qui
            dépasse 150,000 fbu
            30000
            300,001 Et plus 30% de la part qui
            dépasse 300,000 fbu
            Plus de 30 000
            */


       $base_imposable = ($base_imposable - $inss - $mfp);
        $ipr = 0;

        if($base_imposable < 150000){
            $ipr = 0;
        }
        if($base_imposable > 150000 && $base_imposable < 300000){
            $ipr = ($base_imposable - 150000 ) * 20 / 100;
        }

        if($base_imposable > 300000 ){
            $ipr = 30000 + (($base_imposable - 300000) * 30 / 100);
        }

        return [
            "inss" => $inss,
            "IPR" => $ipr,
            "mfp" => $mfp,
            "remuneration_brut" => $remuneration_brut,
            "base_imposable" => $base_imposable,
        ];
    }
}
