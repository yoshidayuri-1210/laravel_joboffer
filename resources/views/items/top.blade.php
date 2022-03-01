@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <p>自分のこだわり条件にあったレコメンド求人一覧</p>
  <p>希望エリア最新情報が表示</p>
  <h2>都道府県から探す</h2>
  <p>北海道</p>
  <p>青森県</p>

  <h2>仕事内容から探す</h2>
  <h2>雇用形態から探す</h2>
  <h2>こだわり条件から探す</h2>

@endsection