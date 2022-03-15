<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Item;
use App\User;

class OrderController extends Controller
{
    public function confirm($item){
        $item = Item::find($item);
        return view('orders.confirm', [
            'title' => '応募確認',
            'item' => $item,
            ]);
    }
    
    public function store($item){
       $item = Item::find($item);
        Order::create([
            'user_id' => \Auth::user()->id,
            'item_id' => $item->id,
            ]);
        \Session::flash('success', '応募しました');
        return redirect()->route('items.show', $item);
    }
    
}
