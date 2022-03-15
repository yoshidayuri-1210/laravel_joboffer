@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
    <form method="post" action="{{ route('items.update', $item) }}" enctype="multipart/form-data">
      @csrf
      @method('patch')

    <div>業種:
        <label><input type="radio" name="type" value="1" @if($item->type === 1 ) checked @endif>調剤薬局</label>
        <label><input type="radio" name="type" value="2" @if($item->type === 2 ) checked @endif>病院・クリニック</label>
        <label><input type="radio" name="type" value="3" @if($item->type === 3 ) checked @endif>ドラッグストア</label>
        <label><input type="radio" name="type" value="4" @if($item->type === 4 ) checked @endif>一般企業</label>
    </div>

    <div><label>法人名:<input type="text" name="company_name" value="{{ $item->company_name}}"></label></div>
    <div><label>店舗名:<input type="text" name="shop_name" value="{{ $item->shop_name}}"></label></div>
    <label>求人タイトル:<textarea name="title" rows="2" cols="50">{{ $item->title }}</textarea></label>
    <div>
        <label>就業エリア:
            <select name="area_id">
            <option value="">選択してください</option>
                @foreach($areas as $area)
                <option value="{{ $area->id }}" @if($item->area->name === $area->name) selected @endif>{{ $area->name }}</option>
                @endforeach
            </select>
        </label>
    </div>
    <div><label>最寄駅:<input type="text" name="access" value="{{ $item->access }}"></label></div>
    <div>雇用形態:
        <label><input type="radio" name="employment" value="1" @if($item->employment === 1 ) checked @endif>正社員</label>
        <label><input type="radio" name="employment" value="2" @if($item->employment === 2 ) checked @endif>契約社員</label>
        <label><input type="radio" name="employment" value="3" @if($item->employment === 3 ) checked @endif>パート</label>
        <label><input type="radio" name="employment" value="4" @if($item->employment === 4 ) checked @endif>その他</label>
    </div>

    <label>こだわり条件:
        <select name="category_id">
        <option value="">選択してください</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" @if($item->category->name === $category->name) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
        </label>
    <div><label>給与:<input type="number" name="payment_min" value="{{ $item->payment_min }}">円</label>〜<label><input type="number" name="payment_max" value="{{ $item->payment_min }}">円</label></div>
    <div><label>年間休日:<input type="number" name="holiday" value="{{ $item->holiday }}"></label></div>
    <div>
        <label>福利厚生：<br>
        <textarea name="welfare" rows="3">{{ $item->welfare }}</textarea>
        </label>
    </div>
    <div>
        <label>求人詳細情報：<br>
        <textarea name="description" rows="10">{{ $item->description }}</textarea>
        </label>
    </div>

    <div>
      <label>現在の画像:<br>
      <div class="item_body_main_image">
        @if($item->image !== '')
            <img src="{{ \Storage::url($item->image) }}">
        @else
            <img src="{{ asset('/storage/images/no_image.png') }}">
        @endif
        <a href="{{ route('items.edit_image', $item) }}">画像を変更</a>
      </div>

    </div>

    <input type="submit" value="登録">

  </form>
@endsection