<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Bill extends Model
{
    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }
    
    public function copying()
    {
        return $this->belongsTo('App\Models\Copying');
    }

    public function bill_items()
    {
        return $this->hasMany('App\Models\Bill_items','bill_id');
    }
}
