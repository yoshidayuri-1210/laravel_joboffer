<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Area;
use App\Item;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{

    //TOPページ
    public function top()
    {
        return view('items.top', [
            'title' => '求人一覧.検索',
            ]);
    }
    
    public function index(){
        return view('items.index', [
            'title' => '求人一覧',
            ]);
        
    }
    public function create()
    {
        return view('items.create',[
            'title' => '求人新規登録',
            'areas' => Area::all(),
            'categories' => Category::all(),
            ]);
    }

    public function store(ItemRequest $request)
    {
        Item::create([
            'company_name' => $request->company_name,
            'shop_name' => $request->shop_name,
            'title' => $request->title,
            'type' => $request->type,
            'area_id' => $request->area_id,
            'access' => $request->access,
            'employment' => $request->employment,
            'category_id' => $request->category_id,
            'payment_min' => $request->payment_min,
            'payment_max' => $request->payment_max,
            'holiday' => $request->holiday,
            'welfare' => $request->welfare,
            'description' => $request->description,
            'image' => '',
            ]);
        session()->flash('success', '求人を登録しました');
        return redirect()->route('items.show', Item::find($request->id));
    }


    public function show($id)
    {
        $item = Item::find($id);
        return view('items.show',[
            'title' => '求人詳細',
            'item' => $item,
            ]);
    }

    public function edit($id)
    {
        $item = Item::find($id);
        return view('items.edit',[
            'title' => '求人編集',
            'item' => $item,
            'areas' => Area::all(),
            'categories' => Category::all(),

            ]);
    }

    public function update(ItemRequest $request, $id)
    {
        $item = Item::find($id);
        $item->update($request->only([
        'company_name','shop_name','title','type','area_id','access','employment',
        'category_id','payment_min','payment_max','holiday','welfare','description']));
        session()->flash('success', '求人を編集しました');
        return redirect()->route('items.show', $item);
    }


    public function destroy($id)
    {
        //
    }
}
