<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarConnection extends Model
{
    use HasFactory;

    protected $fillable = ['bar_id', 'connected_bar_id', 'similarity', 'user_id'];
}
