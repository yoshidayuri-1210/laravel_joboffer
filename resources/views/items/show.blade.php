<?php
use App\Item;
?>

@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  @if(!empty($item))
    <h1>{{ $title }}</h1>
    <h2>{{ $item->title }}</h2>
      <p>{{ $item->company_name }} {{ $item->shop_name }}</p>
      <span>雇用形態：{{ Item::EMPLOYMENT[$item->employment] }}</span>
      <span>業種：{{ Item::TYPE[$item->type] }}</span>
      <span>{{ $item->category->name }}</span>
      <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
      <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
        @csrf
        @method('patch')
      </form>

      <div class="item_body_main_image">
        @if($item->image !== '')
        <img src="{{ asset('storage/' . $item->image) }}">
        @else
        <img src="{{ asset('storage/images/no_image.png') }}">
        @endif
      </div>
      
            
      <h2>求人情報</h2>
      <p>給与：{{ $item->payment_min }}円 ~ {{ $item->payment_max }}円</p>
      <p>{{ $item->area->name }}</p>
      <p>アクセス：{{ $item->access }}</p>
      <p>求人内容：</br>{!! nl2br(e($item->description)) !!}</p>
      <p>雇用形態：{{ Item::EMPLOYMENT[$item->employment] }}</p>
      <p>福利厚生：</br>{!! nl2br(e($item->welfare)) !!}</p>

  @if(\Auth::user()->id === 1)
  [<a href="{{ route('items.edit', $item) }}">編集</a>]
  <form method="post" class="delete" action="{{ route('items.destroy', $item) }}">
    @csrf
    @method('delete')
    <input type="submit" value="削除">
  </form>
  @endif
  @else 該当求人はありません
  @endif

<!--▼adminユーザーは応募確認画面を表示しない-->
@if(\Auth::user()->id !== 1)
<form method="post" action="{{ route('orders.confirm', $item) }}">
　@csrf
　@method('patch')
 　@if($item->isOrderdBy(Auth::user()) === false)
　<input type="submit" value="応募確認画面へ">
　 @else
　 応募済み
　 @endif
</form>
@endif
<!--▲adminユーザーは応募確認画面を表示しない-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  /* global $ */
  $('.like_button').on('click', (event) => {
      $(event.currentTarget).next().submit();
  })
</script>

@endsection