@extends('layouts.not_logged_in')
@section('content')
<h1>サインアップ</h1>
<form method="POST" action="{{ route('register') }}" class="login_form">
    @csrf
    <div class="login_email"><label>ユーザー名：<input type="text" name="name"></label></div>
    <div class="login_email"><label>メールアドレス：<input type="email" name="email"></label></div>
    <div class="login_email"><label>パスワード：<input type="password" name="password"></label></div>
    <div class="login_password"><label>パスワード（確認用）:<input type="password" name="password_confirmation"></label></div>
    <div><input type="submit" value="登録"></div>
</form>
@endsection