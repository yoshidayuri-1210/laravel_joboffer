@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <form method="post" action="{{ route('profile.update', $user) }}">
        @csrf
        @method('patch')
        <div><label>名前(必須):<input type="text" name="name" value="{{ $user->name }}"></label></div>
        <div>
            <label>性別
            <select name="sex">
                <option value="" @if($user->sex === "") selected @endif>選択してください</option>
                <option value="male" @if($user->sex === "male") selected @endif>男性</option>
                <option value="female" @if($user->sex === "female") selected @endif>女性</option>
                <option value="other" @if($user->sex === "other") selected @endif>その他</option>
            </select>
            </label>
        </div>
        <div>
            <label>生年月日<input type="date" name="birthdate" value="{{ $user->birthdate }}">
            </label>
        </div>
        <div>
            <label>希望勤務地
            <select name="area_id">
                <option value="">選択してください</option>
                @foreach($areas as $area)
                <option value="{{ $area->id }}" @if($user->area_id === $area->id) selected @endif>{{ $area->name }}</option>
                @endforeach
            </select>
            </label>
        </div>
         
        <div>
          <label>こだわり条件
          <select name="category_id">
              <option value="">選択してください</option>
              @foreach($categories as $category)
              <option value="{{ $category->id }}"
              @if($user->category_id === $category->id)
                selected
              @endif
              >{{ $category->name }}</option>
              @endforeach
          </select>
          </label>
        </div>
        <div>
            <label>プロフィール：
            <textarea name="profile" rows="10" value="{{ $user->profile }}">{{ $user->profile }}</textarea>
            </label>
        </div>
        <input type="submit" calue="更新">
    </form>
@endsection