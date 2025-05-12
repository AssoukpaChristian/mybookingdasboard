<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    /** @use HasFactory<\Database\Factories\CommuneFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'pays_id'
    ];

    public function pays(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pays::class);
    }

    public function quartiers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Quartier::class);
    }
}
