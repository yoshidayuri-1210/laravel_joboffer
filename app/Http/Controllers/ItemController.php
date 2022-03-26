<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Area;
use App\Item;
use App\Like;
use App\User;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemImageRequest;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //TOPページ
    public function top()
    {   
        $user = \Auth::user();
        $types = Item::TYPE;
        $employments = Item::EMPLOYMENT;
        return view('items.top', [
            'title' => '求人検索',
            'area_ids' => Area::all(), 
            'categories' => Category::all(),
            'types' => $types, 
            'employments' => $employments,
            // Itemsにあるスコープrecommendを利用
            'recommend_category_items' => Item::recommend($user->category_id)->get(),
            'recommend_area_items' => Item::recommendarea($user->area_id)->get(),
            ]);
    }

    public function search(Request $request){
        $items = Item::all();
        $keyword = $request->input('keyword');
        if(!empty($keyword)){
            $items = Item::where('company_name', 'like', "%$keyword%")
            ->orwhere('title', 'like', "%$keyword%")
            ->orwhere('shop_name', 'like', "%$keyword%")
            ->orwhere('shop_name', 'like', "%$keyword%")
            ->orwhere('access', 'like', "%$keyword%")
            ->orwhere('payment_min', 'like', "%$keyword%")
            ->orwhere('payment_max', 'like', "%$keyword%")
            ->orwhere('holiday', 'like', "%$keyword%")
            ->orwhere('welfare', 'like', "%$keyword%")
            ->orwhere('description', 'like', "%$keyword%")
            ->get();
        }
        return view('items.search',[
            'items' => $items,
            'title' => '検索一覧',
            ]);
    }
    
    public function index($id){
        $areas_id = Area::all(); //エリアのテーブルの情報取得
        $area = Area::find($id);
        $items = Item::where('area_id', '=', "$id")->latest()->get(); //Itemテーブルのarea_idとパラメータのidが一致
        return view('items.index', [
            'title' => '求人一覧',
            'items' => $items,
            'areas_id' => $areas_id,
            'area' => $area,
            ]);
        
    }

    public function category($id){
        $category_id = Category::all();
        $category = Category::find($id); //該当のカテゴリを検索
        $items = Item::where('category_id', '=', $id)->latest()->get();

        return view('items.category',[
            'title' => '求人一覧',
            'items' => $items,
            'category' => $category,
            ]);
    }
    
    public function type($id){
        $type = Item::TYPE[$id];
        $items = Item::where('type', '=', $id)->latest()->get();
        return view('items.type',[
            'title' => '業種別求人一覧',
            'type' => $type,
            'items' => $items,
            ]);
    }

   public function employment($id){
        $employment = Item::EMPLOYMENT[$id];
        $items = Item::where('employment', '=', $id)->latest()->get();
        return view('items.employment',[
            'title' => '雇用形態別求人一覧',
            'employment' => $employment,
            'items' => $items,
            ]);
    }


    public function create()
    {
        if(\Auth::user()->id !== 1){
            abort(403);
        }
        return view('items.create',[
            'title' => '求人新規登録',
            'areas' => Area::all(),
            'categories' => Category::all(),
            ]);
        
    }

    public function store(ItemRequest $request)
    {
        $path ='';
        $image = $request->file('image');
            if(isset($image) === true){
                $path = $image->store('photos', 'public');
            }
            
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
            'image' => $path,
            ]);

        session()->flash('success', '求人を登録しました');
        return redirect()->route('items.top');
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
        $item = Item::find($id);
        
        if($item->image !== ''){
            \Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        \Session::flash('success', '削除しました');
        return redirect()->route('items.show', $item);
    }
    
    public function toggleLike($id){
        $user = \Auth::user();
        $item = Item::find($id);
        
        if($item->isLikedBy($user)){
            $item->likes->where('user_id', $user->id)->first()->delete();
            \Session::flash('success', '保存を取り消しました');
        }else{
            Like::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
                ]);
            \Session::flash('success', '保存しました');
        }
        return redirect()->route('items.show', $item);
    }
    
    public function editImage($id){
        $item = Item::find($id);
        return view('items.edit_image',[
            'title' => '画像変更画面',
            'item' => $item,
            ]);
    }
    
    public function updateImage($id, ItemImageRequest $request){
        $path = '';
        $image = $request->file('image');
        
        if( isset($image) === true ){
            $path = $image->store('photos', 'public');
        }
        $item = Item::find($id);
        
        if($item->image !== ''){
            \Storage::disk('public')->delete(\Storage::url($item->image));
        }
        $item->update([
            'image' => $path,
            ]);
        session()->flash('success', '画像を変更しました');
        return redirect()->route('items.show', $id);
    }
}
