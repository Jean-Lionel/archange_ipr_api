<?php

namespace App\Models;

use App\Models\Employe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperContribuable
 */
class Contribuable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'adresse_id',
        'nif',
        'damaine_activity',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'adresse_id' => 'integer',
    ];

    public function adresse(): BelongsTo
    {
        return $this->belongsTo(Adress::class);
    }
    public function employes()
    {
        return $this->hasMany(Employe::class);
    }
}
