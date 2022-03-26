<?php
use App\Item;
?>
@extends('layouts.logged_in')
@section('title', $title)
@section('content')
    <h1>保存した求人一覧</h1>
    <div class="container">
    @forelse($like_items as $like_item)
    <div class="item_content">
        <span class="item_content_title"><h2><a href="{{ route('items.show', $like_item) }}">{{ $like_item->title }}</a></h2></span>
        <h3>{{ $like_item->company_name }} {{ $like_item->shop_name }}</h3>
        <span class="item_content_employment">{{ Item::EMPLOYMENT[$like_item->employment] }}</span>
        <span class="item_content_type">{{ Item::TYPE[$like_item->type] }}</span>
        <span class="item_content_category">{{ $like_item->category->name }}</span></br>
		<div class="item_content_location">
			<dl class="item_content_area_id">
				<dt>勤務地</dt>
				<dd>{{ $like_item->area->name }}</dd>
			</dl>
			<dl class="item_content_access">
				<dt>アクセス</dt>
				<dd>{{ $like_item->access }}</dd>
			</dl>
		</div>
        <div class="item_content_img">
            @if($like_item->image !== '')
              <img src="{{ asset('storage/' . $like_item->image) }}">
            @else
              <img src="{{ asset('images/no_image.png') }}">
            @endif
            <div class="item_content_img_table">
            <table>
                <tbody>
                    <tr>
                        <th>給与</th>
                        <td>{{ $like_item->payment_min }}円〜{{ $like_item->payment_max }}円</td>
                    </tr>
                    <tr>
                        <th>年間休日</th>
                        <td>{{ $like_item->holiday }}日</td>
                    </tr>
                    <tr>
                        <th>福利厚生</th>
                        <td>{{ $like_item->welfare }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <div class="item_content_description">
            {!! nl2br(e($like_item->description)) !!}
        </div>
        <div class="show_button">
        <button type="button" onclick="location.href='{{ route('items.show', $like_item) }}'">この求人の詳細を見る</button>
        </div>
    </div>
    @empty
        <p>保存した求人はありません</p>
@endforelse
    </div>
@endsection