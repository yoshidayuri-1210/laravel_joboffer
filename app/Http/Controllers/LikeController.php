<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    // いいね一覧
    public function index()
    {
        return view('likes.index', [
          'title' => '気になる求人一覧',
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
