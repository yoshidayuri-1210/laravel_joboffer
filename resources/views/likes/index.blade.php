<?php
use App\Item;
?>

@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
    <h1>{{ $title }}</h1>
        @forelse($like_items as $like_item)
            <p>{{ $like_item->company_name }} {{ $like_item->shop_name }}</p>
            <p><a href="{{ route('items.show', $like_item) }}">{{ $like_item->title }}</p></a>
            <span>雇用形態：{{ Item::EMPLOYMENT[$like_item->employment] }}</span>
            <span>業種：{{ Item::TYPE[$like_item->type] }}</span>
            <span>{{ $like_item->category->name }}</span></br>
            <button type="button" onclick="location.href='{{ route('items.show', $like_item) }}'">この求人の詳細を見る</button>
        @empty
            <p>保存した求人はありません</p>
        @endforelse

@endsection