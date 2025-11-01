<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    use HasFactory;

    protected $table = 'event_schedules';

    protected $fillable = [
        'event_id',
        'time',
        'duration',
        'title',
        'details',
    ];

    /**
     * Schedule belongs to an event
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
