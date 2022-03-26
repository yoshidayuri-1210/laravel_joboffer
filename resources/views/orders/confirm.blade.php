<?php
use App\Item;
?>
@extends('layouts.logged_in')
@section('title', $title)
@section('content')
  @if(!empty($item))
    <h1>応募する求人</h1>
<div class="confirm_show_container">
  <div class="confirm">
    <div class="confirm_img">
      @if($item->image !== '')
      <img src="{{ asset('storage/' . $item->image) }}">
      @else
      <img src="{{ asset('images/no_image.png') }}">
      @endif
    </div>      
    <div class="confirm_img_text">
    <h2>{{ $item->company_name }} {{ $item->shop_name }}</h2></span>
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
    <div class="confirm_img_table">
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
  </div>
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
<form method="post" class="order" action="{{ route('orders.store', $item) }}">
　@csrf
　@method('patch')
　<input type="submit" value="内容を確認し応募する">
</form>
@endsection