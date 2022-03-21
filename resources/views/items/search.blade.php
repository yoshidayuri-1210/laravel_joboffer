<?php
use App\Item;
?>

@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')

<h1>検索求人一覧</h1>
<div class="container">
  @forelse($items as $item) 
  <div class="item_content">
  <span class="item_content_title"><h2><a href="{{ route('items.show', $item) }}">{{ $item->title }}</a></h2></span>
   <h3>{{ $item->company_name }} {{ $item->shop_name }}</h3>
   <span class="item_content_employment">{{ Item::EMPLOYMENT[$item->employment] }}</span>
   <span class="item_content_type">{{ Item::TYPE[$item->type] }}</span>
		<div class="item_content_location">
			<dl class="item_content_area_id">
				<dt>勤務地</dt>
				<dd>{{ $item->area->name }}</dd>
			</dl>
			<dl class="item_content_access">
				<dt>アクセス</dt>
				<dd>{{ $item->access }}</dd>
			</dl>
		</div>
		
    <div class="item_content_img">
        @if($item->image !== '')
          <img src="{{ asset('storage/' . $item->image) }}">
        @else
          <img src="{{ asset('storage/images/no_image.png') }}">
        @endif
        <div class="item_content_img_text">
            {!! nl2br(e($item->description)) !!}
        </div>
    </div>

    <ul>
    
    <li>ポイント　{{ $item->category->name }}</li>
    <li>給与：{{ $item->payment_min }}円 ~ {{ $item->payment_max }}円</li>
    </ul>
  </div>
  @empty 求人がありません
  @endforelse
</div>    
@endsection