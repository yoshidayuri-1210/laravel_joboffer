@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
   <h1>{{ $title }}</h1>
    <h2>現在の画像</h2>
    <div class="item_body_main_image">
    @if($item->image !== '')
        <img src="{{ \Storage::url($item->image) }}">
    </div>
    @else
        画像はありません。
    @endif
    
    <form
        method="POST"
        action=""
        enctype="multipart/form-data"
    >
        @csrf
        @method('patch')
        <div>
            <label>
                画像を選択:
                <input type="file" name="image">
            </label>
        </div>
        <input type="submit" value="更新">
    </form>
    
@endsection
