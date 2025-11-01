<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'event_id',
        'quantity',
        'total_amount',
        'status',
        'booking_date',
    ];

    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
