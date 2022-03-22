<?php
use App\Item;
?>

@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="item_show_container">
  @if(!empty($item))
    <span class="item_content_employment">{{ Item::EMPLOYMENT[$item->employment] }}</span>
    <span class="item_content_type">{{ Item::TYPE[$item->type] }}</span>
    <span class="item_content_category">{{ $item->category->name }}</span></br>

    <h1>{{ $item->company_name }} {{ $item->shop_name }}</h1></span>
    
    <div class="item_show_top">
      <div class="item_body_main_image">
        @if($item->image !== '')
        <img src="{{ asset('storage/' . $item->image) }}">
        @else
        <img src="{{ asset('storage/images/no_image.png') }}">
        @endif
      </div>
      <h2>{{ $item->title }}</h2>
    </div>

    <div class="item_buttons">
    <div class="order_button">
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
    </div>
<!--▲adminユーザーは応募確認画面を表示しない-->

    <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★ 保存済み' : '☆ 保存する' }}</a>
    <form method="post" action="{{ route('items.toggle_like', $item) }}">
      @csrf
      @method('patch')
    </form>
    </div>
    
    <div class="item_show_info">
      <h2>求人情報</h2>
      <dl>
      <dt class="item_show_info_title">勤務地</dt>
      <dd class="item_show_info_text">{{ $item->area->name }}</dd>
      <dt class="item_show_info_title">アクセス</dt>
      <dd class="item_show_info_text">{{ $item->access }}</dd>
      <dt class="item_show_info_title">雇用形態</dt>
      <dd class="item_show_info_text">{{ Item::EMPLOYMENT[$item->employment] }}</dd>
      <dt class="item_show_info_title">業種</dt>
      <dd class="item_show_info_text">{{ Item::TYPE[$item->type] }}</dd>
      <dt class="item_show_info_title">給与</dt>
      <dd class="item_show_indo_text">{{ $item->payment_min }} 円 ~ {{ $item->payment_max }} 円</dd>
      <dt class="item_show_info_title">休日</dt>
      <dd class="item_show_info_text">{{ $item->holiday }} 日</dd>
      <dt class="item_show_info_title">福利厚生</dt>
      <dd class="item_show_info_text">{{ $item->welfare }}</dd>
      <dt>求人内容</dt>
      <dd>{!! nl2br(e($item->description)) !!}</dd>
      </dl>
    </div>

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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  /* global $ */
  $('.like_button').on('click', (event) => {
      $(event.currentTarget).next().submit();
  })
</script>
</div>
@endsection
