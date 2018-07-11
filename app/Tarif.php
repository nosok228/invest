<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $fillable = [
        'title', 'description', 'hour', 'percent', 'min', 'max'
    ];
}
