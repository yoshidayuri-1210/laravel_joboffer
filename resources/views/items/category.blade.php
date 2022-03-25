<?php
use App\Item;
?>

@extends('layouts.logged_in')
@section('title', $title)
@section('content')

<h1>{{ $category->name }}の求人一覧</h1>
<div class="container">
  @forelse($items as $item) 
  <div class="item_content">
  <span class="item_content_title"><h2><a href="{{ route('items.show', $item) }}">{{ $item->title }}</a></h2></span>
    <h3>{{ $item->company_name }} {{ $item->shop_name }}</h3>
    <span class="item_content_employment">{{ Item::EMPLOYMENT[$item->employment] }}</span>
    <span class="item_content_type">{{ Item::TYPE[$item->type] }}</span>
    <span class="item_content_category">{{ $item->category->name }}</span></br>
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
            <div class="item_content_img_table">
            <table>
                <tbody>
                    <tr>
                        <th>給与</th>
                        <td>{{ $item->payment_min }}円〜{{ $item->payment_max }}円</td>
                    </tr>
                    <tr>
                        <th>休日</th>
                        <td>{{ $item->holiday }}日</td>
                    </tr>
                    <tr>
                        <th>福利厚生</th>
                        <td>{{ $item->welfare }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <div class="item_content_description">
            {!! nl2br(e($item->description)) !!}
        </div>
        <div class="show_button">
        <button type="button" onclick="location.href='{{ route('items.show', $item) }}'">この求人の詳細を見る</button>
        </div>

  </div>
  @empty 求人がありません
  @endforelse

</div>    
@endsection