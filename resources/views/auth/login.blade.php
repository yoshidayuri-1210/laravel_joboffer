@extends('layouts.not_logged_in')
@section('content')
<h1>ログイン</h1>
<form method="POST" action="{{ route('login') }}" class="login_form">
    @csrf
    <div class="login_email"><label>メールアドレス：<input type="email" name="email"></label></div>
    <div class="login_password"><label>パスワード：<input type="password" name="password"></label></div>
    <input type="submit" value="ログイン">
</form>
@endsection