@extends('layouts.default')
@section('header')
<header>
    <ul class="header_nav">
        <li><a href="{{ route('items.top')}}">TOP</a></li>
        <li><a href="{{ route('likes.index') }}">保存した求人</a></li>
        <li><a href="{{ route('users.show', Auth::user()) }}">プロフィール</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" value="ログアウト">
            </form>
            
        </li>
    </ul>
    <p>{{ Auth::user()->name }}さん、こんにちは！</p>
</header>
@endsection