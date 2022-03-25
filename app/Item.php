<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Area;
use App\User;

class Item extends Model
{
    const TYPE = [1=>'調剤薬局', 2=>'病院・クリニック', 3=>'ドラッグストア', 4=>'一般企業'];
    const EMPLOYMENT = [1=>'正社員', 2=>'契約社員', 3=>'パート・アルバイト', 4=>'その他'];

    //リレーションの設定
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
    public function area(){
        return $this->belongsTo('App\Area');
    }
    
    public function likes(){
        return $this->hasMany('App\Like');
    }
    
    public function likedUsers(){
        return $this->belongsToMany('App\User', 'likes');
    }
    
    public function isLikedBy($user){
        $liked_users_ids = $this->likedUsers->pluck('id');
        $result = $liked_users_ids->contains($user->id);
        return $result;
    }
    
    protected $fillable = [
            'company_name', 'shop_name', 'title', 'type', 'access', 'employment', 'payment_min','payment_max',
            'holiday', 'welfare', 'description', 'image', 'status', 'area_id', 'category_id',
            ];
            
    public function orders(){
        return $this->hasMany('App\Order');
    }
    
    public function orderdUsers(){
        return $this->belongsToMany('App\User', 'orders');
    }
    
    public function isOrderdBy($user){
        $orderd_users_ids = $this->orderdUsers->pluck('id');
        $result = $orderd_users_ids->contains($user->id);
        return $result;
    }
    
    //scopeの設定
    //$idは、該当ユーザーのcategory_id
    public function scopeRecommend($query, $id){
        return $query->where('category_id', '=', $id)->latest();
    }

    public function scopeRecommendarea($query, $id){
        return $query->where('area_id', '=', $id)->latest();
    }
}
