<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferalPayment extends Model
{
    protected $table = "referal_payments";

    protected $fillable = [
        'referal_id', 'referer_id', 'percentToReferer'
    ];
}
