<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'lat', 'lng'];

    public function reverseConnections()
    {
        return $this->hasMany(BarConnection::class, 'connected_bar_id');
    }

    public function connections()
    {
        return $this->hasMany(BarConnection::class);
    }
}
