@extends('layouts.logged_in')
@section('title', $title)
@section('content')
  <h1>{{ $title }}</h1>
  <form method="post" action="{{ route('items.store') }}" enctype="multipart/form-data">
      @csrf
    <div class="profile_table">
        <table>
            <tbody>
                <tr>
                    <th>法人名</th>
                    <td><div class="company_name"><input type="text" name="company_name"></div></td>
                </tr>
                <tr>
                    <th>店舗名</th>
                    <td><div class="company_name"><input type="text" name="shop_name"></div></td>
                </tr>
                <tr>
                    <th>タイトル</th><td><textarea name="title" rows="2" cols="50"></textarea></td>
                </tr>
                <tr>
                    <th>業種</th>
                    <td>
                        <label><input type="radio" name="type" value="1">調剤薬局</label>
                        <label><input type="radio" name="type" value="2">病院・クリニック</label>
                        <label><input type="radio" name="type" value="3">ドラッグストア</label>
                        <label><input type="radio" name="type" value="4">一般企業</label>
                    </td>
                </tr>
                <tr>
                    <th>就業エリア</th>
                    <td>
                    <select name="area_id">
                    <option value="">選択してください</option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>最寄駅</th>
                    <td><input type="text" name="access" placeholder="例) JR線 大阪駅"></td>
                </tr>
                <tr>
                    <th>雇用形態</th>
                    <td>
                        <input type="radio" name="employment" value="1">正社員
                        <input type="radio" name="employment" value="2">契約社員
                        <input type="radio" name="employment" value="3">パート
                        <input type="radio" name="employment" value="4">その他
                    </td>
                </tr>
                <tr>
                    <th>こだわり条件</th>
                    <td>
                        <select name="category_id">
                        <option value="">選択してください</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>給与</th>
                    <td><input type="number" name="payment_min" placeholder="例)4,000,000">円</label>〜<label><input type="number" name="payment_max" placeholder="例) 5,000,000">円</td>
                </tr>
                <tr>
                    <th>年間休日</th>
                    <td><input type="number" name="holiday"></td>
                </tr>
                <tr>
                    <th>福利厚生</th>
                    <td><textarea name="welfare" rows="3" cols="50"></textarea></td>
                </tr>
                <tr>
                    <th>求人詳細情報</th>
                    <td><textarea name="description" rows="10" cols="50"></textarea></td>
                </tr>
                <tr>
                  <th>画像を選択</th>
                  <td><input type="file" name="image"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <input type="submit" value="登録">
  </form>
@endsection