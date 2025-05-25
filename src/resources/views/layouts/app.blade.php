<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header class="header">
        <h1 class="logo">PiGLy</h1>

        <div class="frame-507">
            <div class="frame-509">
    <a href="{{ route('weight_logs.editGoal') }}" class="target-weight-link">
    <img src="{{ asset('images/setting.png') }}" alt="設定" class="icon-gear" />
    <span class="target-weight-label">目標体重設定</span>
</a>
</div>

<div class="frame-508">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-button">
            <img src="{{ asset('images/logout.png') }}" alt="ログアウト" class="icon-logout" />
            <span class="logout-label">ログアウト</span>
        </button>
    </form>
</div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>