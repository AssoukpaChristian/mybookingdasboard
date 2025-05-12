<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    /** @use HasFactory<\Database\Factories\PaysFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    public function clients(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function communes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Commune::class);
    }
}
