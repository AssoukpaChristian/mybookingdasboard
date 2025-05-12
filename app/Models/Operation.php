<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    /** @use HasFactory<\Database\Factories\OperationFactory> */
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'residence_id',
        'montant',
        'mode_paiement',
        'operationdate',
        'periode'
    ];
    public function transaction(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
    public function residence(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Residence::class);
    }
    public function Bookings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Booking::class);
    }
    // public function scopeFilter($query, array $filters)
    // {
    //     $query->when($filters['search'] ?? false, function ($query, $search) {
    //         $query->where('montant', 'like', '%' . $search . '%')
    //             ->orWhere('operationdate', 'like', '%' . $search . '%')
    //             ->orWhere('periode', 'like', '%' . $search . '%');
    //     });
    // }
    // public function scopeFilterByDate($query, $date)
    // {
    //     return $query->whereDate('operationdate', $date);
    // }
}
