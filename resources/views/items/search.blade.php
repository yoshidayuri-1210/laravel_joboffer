<?php
use App\Item;
?>

@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')

<h1>検索求人一覧</h1>
  @forelse($items as $item) 
  <h3><a href="{{ route('items.show', $item) }}">{{ $item->title }}</a></h3>
    <ul>
    <li>法人名：{{ $item->company_name }}　店舗名：{{ $item->shop_name }}</br></li>
    <li>ポイント　{{ $item->category->name }}</li>
    <li>給与：{{ $item->payment_min }}円 ~ {{ $item->payment_max }}円</li>
    <li>雇用形態：{{ Item::EMPLOYMENT[$item->employment] }}</li>
    </ul>
  @empty 求人がありません
  @endforelse
    
@endsection