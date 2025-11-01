<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    use HasFactory;
    protected $fillable=['title','description','location','venue_id','date','start_time','end_time','price','available_tickets','image'];

    public function getImageAttribute($value)
    {
        return $value ? url('/' . $value) : null;
    }

    /**
     * Event has many schedules
     */
    public function schedules()
    {
        return $this->hasMany(\App\Models\EventSchedule::class);
    }

    /**
     * Optional: event belongs to a venue (if Venue model exists)
     */
    public function venue()
    {
        return $this->belongsTo(\App\Models\Venue::class);
    }
}
