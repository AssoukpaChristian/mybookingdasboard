<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quartier extends Model
{
    /** @use HasFactory<\Database\Factories\QuartierFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'commune_id'
    ];

    public function commune(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Commune::class);
    }

    public function residences(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Residence::class);
    }
}
