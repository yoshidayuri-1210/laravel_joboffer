@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  @if(!empty($item))
    <h1>{{ $title }}</h1>
    <h1>{{ $item->title }}</h1>
      <p>{{ $item->company_name }} {{ $item->shop_name }}</p>
      <span>雇用形態{{ $item->employment }}</span>
      <span>業種{{ $item->type }}</span>
      <span>{{ $item->category->name }}</span>
     <h2>求人情報</h2>
      <p>給与：{{ $item->payment_min }}円 ~ {{ $item->payment_max }}円</p>
      <p>{{ $item->area->name }}</p>
      <p>アクセス：{{ $item->access }}</p>
      <p>求人内容：{{ $item->description }}</p>
      <p>雇用形態：{{ $item->employment }}</p>
      <p>福利厚生：{{ $item->welfare }}</p>

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

<form method="post" action="{{ route('orders.store', $item) }}">
　@csrf
　@method('patch')
　<input type="submit" value="内容を確認し応募する">
</form>

@endsection