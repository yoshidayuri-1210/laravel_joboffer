@extends('layouts.logged_in')
 
@section('title', $title)

@section('content')
  <div class="container">
  <div class="profile">

  <div class="profile_title"><h1>{{ $title }}</h1></div>

  <div class="profile_table">
            <table>
                <tbody>
                    <tr>
                        <th>名前</th>
                        <td>{{ $user->name }} さん</td>
                    </tr>
                    <tr>
                        <th>生年月日</th>
                        <td>{{ $user->birthdate }}</td>
                    </tr>
                    
                    <tr>
                        <th>希望勤務地</th>
                        <td>@if(!empty($user->area->name)){{ $user->area->name }}@else希望勤務地設定はありません@endif</td>
                    </tr>
                    <tr>
                        <th>こだわり条件</th>
                        <td>@if(!empty($user->category->name)){{ $user->category->name }}@elseこだわり条件の設定はありません@endif</td>
                    </tr>
                    <tr>
                      <th>プロフィール</th>
                      <td>@if(!empty($user->profile)){!! nl2br(e($user->profile)) !!}@elseプロフィールの設定がありません@endif</td>
                    </tr>
                </tbody>
            </table>
            </div>
  
  
  <div class="profile_edit_buttun"><a href="{{ route('profile.edit') }}">編集</a></div>

  <div class="profile_order_title"><h1>応募履歴</h1></div>
  @forelse($order_items as $order_item)
  <ul>
    <div class="ordering_list">
      <li><a href="{{ route('items.show', $order_item) }}">法人名：{{ $order_item->company_name }} 店舗名：{{ $order_item->shop_name }}</a>
      (応募日:{{ $order_item->pivot->created_at }})</li>
    </div>
  </ul>
  @empty
    <p>応募企業はありません</p>
  @endforelse
  </div>
  </div>
@endsection