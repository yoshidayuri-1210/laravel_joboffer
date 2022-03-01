<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Area;
use App\Http\Requests\ProfileRequest;

class UserController extends Controller
{
      public function show($id)
    {
        $user = User::find($id);
        return view('users.show',[
            'title' => 'プロフィール',
            'user' => $user,
            ]);
    }

//プロフィール編集画面表示
    public function edit(){
        $user = \Auth::user();
        return view('users.edit', [
            'title' => 'プロフィール編集',
            'user' => $user,
            'categories' => Category::all(),
            'areas' => Area::all(),
            ]);
    }

//プロフィール更新処理    
    public function update(ProfileRequest $request){
        $user = \Auth::user();
        $user->update($request->only(['name', 'sex', 'birthdate', 'area_id', 'category_id', 'profile']));
        session()->flash('success', 'プロフィールを更新しました');
        return redirect()->route('users.show', $user);
    }

}
