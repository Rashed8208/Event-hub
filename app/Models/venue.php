<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venue extends Model
{
    use HasFactory;
    protected $fillable=['name','description','address','city','capacity','price_per_day','image','status'];
    
     public function getImageAttribute($value)
    {
        return $value ? url('/' . $value) : null;
    }
}
