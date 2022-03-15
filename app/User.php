<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Category;
use App\Area;
use App\Order;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'profile', 'category_id', 'area_id', 'birthdate', 'sex'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //リレーションの設定
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
    public function area(){
        return $this->belongsTo('App\Area');
    }
    
    public function like(){
        return $this->hasMany('App\Like');
    }
    public function likeItems(){
        return $this->belongsToMany('App\Item', 'likes');
    }
    
    public function order(){
        return $this->hasMany('App\Order');
    }
    
    public function order_items(){
        return $this->belongsToMany('App\Item', 'orders')->withPivot('created_at')->orderBy('pivot_created_at', 'desc');
    }
    
    public function isOrdering($item){
        $result = $this->order_items->pluck('id')->contains($item->id);
        return $result;
    }

}