<?php

namespace App\Http\Controllers;
use App\Item;
use App\User;

use Illuminate\Http\Request;

class LikeController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }

    // いいね一覧
    public function index()
    {   
        $like_items = \Auth::user()->likeItems;
        return view('likes.index', [
          'title' => '保存求人一覧',
          'like_items' => $like_items,
        ]);
    }
 
     // いいね追加処理
    public function store(Request $request)
    {
        //
    }
 
    // いいね削除処理
    public function destroy($id)
    {
        //
    }

}
