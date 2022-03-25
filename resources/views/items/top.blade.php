<?php
use App\Item;
?>

@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <!-- slick CSS CDN -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

<div class="top_search">
  <!--▼フリーワード検索ボックス-->
      <div class="top_icon_searchbox">
      <img src="{{ asset('/storage/images/search_icon.png') }}">
      <div class="top_icon_searchbox_right">
  　　<p>かんたん求人検索！/</p>
      <form method="get" action="{{ route('items.search') }}" class="search">
        <input type="text" name="keyword">
        <input type="submit" value="検索">
      </form>
      </div>
      </div>
  <!--▲フリーワード検索ボックス-->
</div>

<div class="container">
<!--▼こだわり条件の最新求人3つ-->
<div class="user_category_title">
<h2>
@if(!empty(\Auth::user()->category))  
  {{ \Auth::user()->category->name }}
@endif
おすすめ新着求人
</h2>
</div>

<div class="top_recommend">
<div class="carousel">
  @forelse($recommend_category_items as $recommend_category_item)
  <a href="{{ route('items.show', $recommend_category_item) }}">
  <span class="item_content_employment">{{ Item::EMPLOYMENT[$recommend_category_item->employment] }}</span>
  <span class="item_content_type">{{ Item::TYPE[$recommend_category_item->type] }}</span>
  <div class="top_img">
    @if($recommend_category_item->image !== '')
      <img src="{{ asset('storage/' . $recommend_category_item->image) }}">
    @else
      <img src="{{ asset('storage/images/no_image.png') }}">
    @endif
  </div>  

  <div class="top_text">
  <h3>{{ $recommend_category_item->company_name }} {{ $recommend_category_item->shop_name }}</h3>
  <p><span class="top_text_title">{{ $recommend_category_item->title }}</p>
  </div>
  @empty こだわり条件の求人はありません
  @endforelse
  </a>
</div>
</div>
<!--▲こだわり条件の最新求人3つ-->

<!--▼希望エリアの最新求人3つ-->
<div class="user_area_items">
@if(!empty(\Auth::user()->area_id))
<h2>{{ \Auth::user()->area->name }} おすすめ新着求人</h2>
@else <h2>おすすめ新着求人</h2>
@endif
</div>

<div class="top_recommend">
<div class="carousel">
  @forelse($recommend_area_items as $recommend_area_item)
<a href="{{ route('items.show', $recommend_area_item) }}">
  <span class="item_content_employment">{{ Item::EMPLOYMENT[$recommend_area_item->employment] }}</span>
  <span class="item_content_type">{{ Item::TYPE[$recommend_area_item->type] }}</span></br>
  <div class="item_content_category_area">{{ $recommend_area_item->category->name }}</div>
  <div class="top_img">
    @if($recommend_area_item->image !== '')
      <img src="{{ asset('storage/' . $recommend_area_item->image) }}">
    @else
      <img src="{{ asset('storage/images/no_image.png') }}">
    @endif
  </div>  
  <div class="top_text">
  <h3>{{ $recommend_area_item->company_name }} {{ $recommend_area_item->shop_name }}</h3>
  <ul>
  <li><span class="top_text_title">{{ $recommend_area_item->title }}</span></li>
  </ul>
  </div>
  @empty 希望エリア条件の求人はありません
  @endforelse
</a>
</div>
</div>
<!--▲希望エリアの最新求人3つ-->

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<!-- slick js CDN -->
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" integrity="sha256-DHF4zGyjT7GOMPBwpeehwoey18z8uiz98G4PRu2lV0A=" crossorigin="anonymous"></script>
<script type="text/javascript">
    // カルーセルにするセレクタを指定する
      $('.carousel').slick({
          dots: true,
          autoplay: true,
          autoplaySpeed: 2000,
          slidesToShow: 3,
        });
</script>


<div class="area_search">
<div class="area_search_title">
  <h2>都道府県から探す</h2>
</div>
<div class="area_search_content">
  @foreach($area_ids as $area_id)
  <ul>
  <li><a href="{{ route('items.index', $area_id->id) }}">{{ $area_id->name }}</a></li>
  </ul>
  @endforeach
</div>
</div>

<div class="category_search">
<div class="category_search_title">
  <h2>こだわり条件から探す</h2>
</div>
<div class="category_search_content">
  @foreach($categories as $category)
  <ul>
    <li><a href="{{ route('items.category', $category) }}">{{ $category->name }}</a></li>
  </ul>
  @endforeach
</div>
</div>

<div class="type_search">
<div class="type_search_title">
  <h2>業種から探す</h2>
</div>
<div class="type_search_content">  
  @foreach($types as $type)
  <ul>
    <li><a href="{{ route('items.type', array_keys($types, $type)) }}">{{ $type }}</a></li>
  </ul>
  @endforeach
</div>
</div>

<div class="employment_search">
<div class="employment_search_title">
  <h2>雇用形態から探す</h2>
</div>
<div class="employment_search_content">
   @foreach($employments as $employment)
  <ul>
    <li><a href="{{ route('items.employment', array_keys($employments, $employment)) }}">{{ $employment }}</a></li>
  </ul>
  @endforeach
</div>
</div>
</div>
@endsection