<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'artist_id',
        'producer_id',
        'status',
        'start_date',
        'end_date',
    ];
}
