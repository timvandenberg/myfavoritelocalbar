<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lat', 'lng'];

    public function bars()
    {
        // has many t
        return $this->hasMany(Bar::class);
    }
}
