@extends('layouts.logged_in')
 
@section('title', $title)

@section('content')
  <h1>{{ $title }}</h1>
  <p>名前：{{ $user->name }}  さん</p>
  <p>希望勤務地：@if(!empty($user->area->name)){{ $user->area->name }}@else希望勤務地設定はありません</p>@endif
  <p>こだわり条件：@if(!empty($user->category->name)){{ $user->category->name }}@elseこだわり条件の設定はありません</p>@endif
  <p>プロフィール：@if(!empty($user->profile)){{ $user->profile }}@elseプロフィールの設定がありません</p>@endif
  <p><a href="{{ route('profile.edit') }}">[編集]</a></p>
  <h2>応募履歴</h2>
@endsection