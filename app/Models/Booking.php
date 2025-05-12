<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $fillable = [
        'client_id',
        'residence_id',
        'montant',
        'start',
        'end',
        'reliquat',
        'status',
        'montant_total',
        'mode_paiement',
        'operation_id'
    ];

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function residence(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Residence::class);
    }

    public function operation ():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Operation::class);
    }
}
