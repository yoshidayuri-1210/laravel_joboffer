<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Area;

class Item extends Model
{
    //リレーションの設定
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
    public function area(){
        return $this->belongsTo('App\Area');
    }
    
    protected $fillable = [
            'company_name', 'shop_name', 'title', 'type', 'area_id', 'access', 'employment', 'category_id','payment_min',
            'payment_max', 'holiday', 'welfare', 'description', 'image',
            ];
}
