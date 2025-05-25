@extends('layouts.guest')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    <div class="login-container">
        <h2>ログイン</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div>
                <label>メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label>パスワード</label>
                <input type="password" name="password">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">ログイン</button>
        </form>

        <a href="{{ route('register.step1') }}">アカウント作成はこちら</a>
    </div>
@endsection