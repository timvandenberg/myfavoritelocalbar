<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    use HasFactory;

    protected $fillable = ['place_id', 'name', 'description'];

    public function connections()
    {
        // Has Many Through ??
        return $this->hasMany(BarConnection::class);
    }
}
