@extends('layouts.guest')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/register/step1.css') }}">

    <div class="frame-452 register-card">
        <!-- カード内ヘッダー（中央揃え） -->
        <div class="frame-454">
            <h1 class="pigly-logo">PiGLy</h1>
            <h2 class="new-member-register">新規会員登録</h2>
        </div>

        <p class="step1-text">STEP1 アカウント情報の登録</p>

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <div class="name-group">
                <label for="name" class="name-label">お名前</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="input-field"
                    value="{{ old('name') }}"
                    placeholder="名前を入力"
                >
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="email-group">
                <label for="email" class="email-label">メールアドレス</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="input-field"
                    value="{{ old('email') }}"
                    placeholder="メールアドレスを入力"
                >
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="password-group">
                <label for="password" class="password-label">パスワード</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="input-field"
                    placeholder="パスワードを入力"
                >
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="main-button">
                <span class="button-text">次に進む</span>
            </button>
        </form>

        <a href="{{ route('login') }}" class="login-link-container">
            <span class="login-link-text">ログインはこちら</span>
        </a>
    </div>
@endsection