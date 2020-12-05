<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remainder extends Model
{
    public function bill()
    {
        return $this->belongsTo('App\Models\Bill');
    }
}
