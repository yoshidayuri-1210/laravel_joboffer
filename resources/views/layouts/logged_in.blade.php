@extends('layouts.default')
@section('header')
<header>
    <ul class="header_nav">
        <li><a href="{{ route('items.top')}}">TOP</a></li>
        <li><a href="{{ route('likes.index') }}">保存した求人</a></li>
        <li><a href="{{ route('users.show', Auth::user()) }}">プロフィール</a></li>
        @if(\Auth::user()->id === 1)
        <li><a href="{{ route('items.create')}}">求人新規作成</a></li>
        @endif
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