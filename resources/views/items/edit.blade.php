@extends('layouts.logged_in')
@section('title', $title)

@section('content')
  <h1>{{ $title }}</h1>
    <form method="post" action="{{ route('items.update', $item) }}" enctype="multipart/form-data">
      @csrf
      @method('patch')
    <div class="profile_table">
        <table>
            <tbody>
                <tr>
                    <th>法人名</th>
                    <td><div class="company_name"><input type="text" name="company_name" value="{{ $item->company_name}}"></div></td>
                </tr>
                <tr>
                    <th>店舗名</th>
                    <td><div class="company_name"><input type="text" name="shop_name" value="{{ $item->shop_name}}"></div></td>
                </tr>
                <tr>
                    <th>タイトル</th>
                    <td><textarea name="title" rows="2" cols="50">{{ $item->title }}</textarea></td>
                </tr>
                <tr>
                    <th>業種:</th>
                    <td>
                        <label><input type="radio" name="type" value="1" @if($item->type === 1 ) checked @endif>調剤薬局</label>
                        <label><input type="radio" name="type" value="2" @if($item->type === 2 ) checked @endif>病院・クリニック</label>
                        <label><input type="radio" name="type" value="3" @if($item->type === 3 ) checked @endif>ドラッグストア</label>
                        <label><input type="radio" name="type" value="4" @if($item->type === 4 ) checked @endif>一般企業</label>
                    </td>
                </tr>
                <tr>
                    <th>就業エリア</th>
                    <td>
                    <select name="area_id">
                    <option value="">選択してください</option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}" @if($item->area->name === $area->name) selected @endif>{{ $area->name }}</option>
                        @endforeach
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>最寄駅</th>
                    <td><input type="text" name="access" value="{{ $item->access }}"></td>
                </tr>
                <tr>
                    <th>雇用形態</th>
                    <td>
                        <input type="radio" name="employment" value="1" @if($item->employment === 1 ) checked @endif>正社員</label>
                        <input type="radio" name="employment" value="2" @if($item->employment === 2 ) checked @endif>契約社員</label>
                        <input type="radio" name="employment" value="3" @if($item->employment === 3 ) checked @endif>パート</label>
                        <input type="radio" name="employment" value="4" @if($item->employment === 4 ) checked @endif>その他</label>
                    </td>
                </tr>
                <tr>
                    <th>こだわり条件</th>
                    <td>
                       <select name="category_id">
                        <option value="">選択してください</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($item->category->name === $category->name) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>給与</th>
                    <td><input type="number" name="payment_min" value="{{ $item->payment_min }}">円</label>〜<label><input type="number" name="payment_max" value="{{ $item->payment_min }}">円</td>
                </tr>
                <tr>
                    <th>年間休日</th>
                    <td><input type="number" name="holiday" value="{{ $item->holiday }}"></td>
                </tr>
                <tr>
                    <th>福利厚生</th>
                    <td><textarea name="welfare" rows="3" cols="50">{{ $item->welfare }}</textarea></td>
                </tr>
                <tr>
                    <th>求人詳細情報</th>
                    <td><textarea name="description" rows="10" cols="50">{{ $item->description }}</textarea></td>
                </tr>
                <tr>
                  <th>現在の画像</th>
                  <td><div class="item_body_main_image">
                    @if($item->image !== '')
                        <img src="{{ \Storage::url($item->image) }}">
                    @else
                        <img src="{{ asset('images/no_image.png') }}">
                    @endif
                    <span class="edit_image_button"><a href="{{ route('items.edit_image', $item) }}">画像を変更</a></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <input type="submit" class="edit_input" value="更新">
    </form>
@endsection