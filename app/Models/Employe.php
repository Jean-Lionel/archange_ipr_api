<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
