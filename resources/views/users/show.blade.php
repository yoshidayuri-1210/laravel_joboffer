@extends('layouts.logged_in')
 
@section('title', $title)

@section('content')
  <div class="container">
  <div class="profile">

  <div class="profile_title"><h1>{{ $title }}</h1></div>
  <p>名前：{{ $user->name }}  さん</p>
  <p>希望勤務地：@if(!empty($user->area->name)){{ $user->area->name }}@else希望勤務地設定はありません</p>@endif
  <p>こだわり条件：@if(!empty($user->category->name)){{ $user->category->name }}@elseこだわり条件の設定はありません</p>@endif
  <p>プロフィール：</br>@if(!empty($user->profile)){!! nl2br(e($user->profile)) !!}@elseプロフィールの設定がありません</p>@endif
  <p><a href="{{ route('profile.edit') }}">[編集]</a></p>

  <div class="profile_order_title"><h1>応募履歴</h1></div>
  @forelse($order_items as $order_item)
  <ul>
    <div class="ordering_list">
      <li><a href="{{ route('items.show', $order_item) }}">法人名：{{ $order_item->company_name }} 店舗名：{{ $order_item->shop_name }}
      (応募日:{{ $order_item->pivot->created_at }})</a></li>
    </div>
  </ul>
  @empty
    <p>応募企業はありません</p>
  @endforelse
  </div>
  </div>
@endsection