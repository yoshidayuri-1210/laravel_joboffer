<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    @yield('header')
        <!--エラーメッセージの表示-->
        @foreach($errors->all() as $error)
            <p class="error">{{ $error }}</p>
        @endforeach
        
        <!--成功メッセージの表示-->
        @if (session()->has('success'))
            <div class="success">
                {{ session()->get('success') }}
            </div>
        @endif

    @yield('content')

</body>
</html>