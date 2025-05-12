<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    /** @use HasFactory<\Database\Factories\ResidenceFactory> */
    use HasFactory;

    protected $fillable =[
        'name',
        'quartier_id',
        'contact',
        'pieces',
        'prix'
    ];

    public function quartier(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quartier::class);
    }

    public function bookings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
