<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;

class Area extends Model
{
        public function item(){
        return $this->belongsTo('App\Item');
    }
}
