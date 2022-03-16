<?php
use App\Item;
?>

@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  


<!--▼こだわり条件の最新求人3つ-->

<h2>
@if(!empty(\Auth::user()->category))  
  {{ \Auth::user()->category->name }}
@endif
おすすめ新着求人
</h2>

  @forelse($recommend_category_items as $recommend_category_item)
  <ul>
  <li>法人名：{{ $recommend_category_item->company_name }}　店舗名：{{ $recommend_category_item->shop_name }}</li>
  <li>{{ $recommend_category_item->title }}</li>
  <li><span>雇用形態：{{ Item::EMPLOYMENT[$recommend_category_item->employment] }}</span></li>
  <li><span>業種：{{ Item::TYPE[$recommend_category_item->type] }}</span></li>
  <li><span>{{ $recommend_category_item->category->name }}</span></li>
  <button type="button" onclick="location.href='{{ route('items.show', $recommend_category_item) }}'">この求人の詳細を見る</button>
  </ul>
  @empty こだわり条件の求人はありません
  @endforelse
<!--▲こだわり条件の最新求人3つ-->

<!--▼希望エリアの最新求人3つ-->
@if(!empty(\Auth::user()->area_id))
<h2>{{ \Auth::user()->area->name }} おすすめ新着求人</h2>
@else <h2>おすすめ新着求人</h2>
@endif

  @forelse($recommend_area_items as $recommend_area_item)
  <ul>
  <li>法人名：{{ $recommend_area_item->company_name }}　店舗名：{{ $recommend_area_item->shop_name }}</li>
  <li>{{ $recommend_area_item->title }}</li>
  <li><span>雇用形態：{{ Item::EMPLOYMENT[$recommend_area_item->employment] }}</span></li>
  <li><span>業種：{{ Item::TYPE[$recommend_area_item->type] }}</span></li>
  <li><span>{{ $recommend_area_item->category->name }}</span></li>
  <button type="button" onclick="location.href='{{ route('items.show', $recommend_area_item) }}'">この求人の詳細を見る</button>
  </ul>
  @empty 希望エリア条件の求人はありません
  @endforelse
<!--▲希望エリアの最新求人3つ-->

  <h2>都道府県から探す</h2>
  @foreach($area_ids as $area_id)
  <ul>
  <li><a href="{{ route('items.index', $area_id->id) }}">{{ $area_id->name }}</a></li>
  </ul>
  @endforeach

  <h2>こだわり条件から探す</h2>
  @foreach($categories as $category)
  <ul>
    <li><a href="{{ route('items.category', $category) }}">{{ $category->name }}</a></li>
  </ul>
  @endforeach
  
  <h2>業種から探す</h2>
  @foreach($types as $type)
  <ul>
    <li><a href="{{ route('items.type', array_keys($types, $type)) }}">{{ $type }}</a></li>
  </ul>
  @endforeach

  <h2>雇用形態から探す</h2>
   @foreach($employments as $employment)
  <ul>
    <li><a href="{{ route('items.employment', array_keys($employments, $employment)) }}">{{ $employment }}</a></li>
  </ul>
  @endforeach

 

@endsection