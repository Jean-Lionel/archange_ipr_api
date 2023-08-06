<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperPaimentIpr
 */
class PaimentIpr extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
         'contribuable_id', 'employe_id', 'date_paiement', 'montant_employe', 'base_imposable', 'remuneration_brut', 'inss',
        'mfp', 'IPR', 'montant_employeur', 'total_paiement'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'contribuable_id' => 'integer',
        'employe_id' => 'integer',
        'date_paiement' => 'date',
        'montant_employe' => 'double',
        'montant_employeur' => 'double',
        'total_paiement' => 'double',
    ];

    public function contribuable(): BelongsTo
    {
        return $this->belongsTo(Contribuable::class);
    }

    public function employe(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
