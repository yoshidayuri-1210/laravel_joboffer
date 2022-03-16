@extends('layouts.default')
@section('header')

<header>
    <div class="header_content">
    <ul class="header_nav">
        <div class="header_list">
        <li>{{ Auth::user()->name }}さん、こんにちは！</li>
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
        </div>
    </ul>
    
<!--▼フリーワード検索ボックス-->
      <form method="get" action="{{ route('items.search') }}" class="search">
        <input type="text" name="keyword">
        <input type="submit" value="検索">
      </form>
<!--▲フリーワード検索ボックス-->
</div>

</header>
@endsection