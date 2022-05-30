<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    use HasFactory;

    protected $fillable = ['google_place_description', 'google_place_id', 'town_id', 'name', 'description', 'lat', 'lng'];

    public function connections()
    {
        // Has Many Through ??
        return $this->hasMany(BarConnection::class);
    }
}
