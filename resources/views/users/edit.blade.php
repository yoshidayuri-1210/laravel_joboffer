@extends('layouts.logged_in')
@section('title', $title)
@section('content')
    <h1>{{ $title }}</h1>
    <div class="profile_table">
    <form method="post" action="{{ route('profile.update', $user) }}">
        @csrf
        @method('patch')
        <table>
            <tbody>
                <tr>
                    <th>名前</th>
                    <td><input type="text" name="name" value="{{ $user->name }}"></td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                    <select name="sex">
                    <option value="" @if($user->sex === "") selected @endif>選択してください</option>
                    <option value="male" @if($user->sex === "male") selected @endif>男性</option>
                    <option value="female" @if($user->sex === "female") selected @endif>女性</option>
                    <option value="other" @if($user->sex === "other") selected @endif>その他</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>生年月日</th>
                    <td><input type="date" name="birthdate" value="{{ $user->birthdate }}"></td>
                </tr>
                <tr>
                    <th>希望勤務地</th>
                    <td>
                    <select name="area_id">
                    <option value="">選択してください</option>
                    @foreach($areas as $area)
                    <option value="{{ $area->id }}" @if($user->area_id === $area->id) selected @endif>{{ $area->name }}</option>
                    @endforeach
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>こだわり条件</th>
                    <td>
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
                    </td>
                </tr>
                <tr>
                    <th>プロフィール</th>
                    <td><textarea name="profile" rows="10" value="{{ $user->profile }}">{{ $user->profile }}</textarea></td>
                </tr>
                </tbody>
            </table>
    </div>
            <input type="submit" class="edit_input" value="更新">
    </form>        
@endsection