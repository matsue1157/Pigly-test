@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/weight/index.css') }}">

    <div class="container">
        {{-- 上部メニュー --}}
        <div class="header">
            <a href="{{ route('weight_logs.editGoal') }}" class="btn">目標体重設定</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
            </form>
        </div>

        {{-- 目標体重・現在体重・差分表示 --}}
        <div class="weight-summary">
            <p>目標体重：{{ number_format($goalWeight, 1) }} kg</p>
            <p>現在体重：{{ number_format($currentWeight, 1) }} kg</p>
            <p>目標まであと：{{ number_format($goalWeight - $currentWeight, 1) }} kg</p>
        </div>

        {{-- 検索フォーム --}}
        <form method="GET" action="{{ route('weight_logs.index') }}" class="search-form">
            <label>日付で検索：</label>
            <input type="date" name="from" value="{{ request('from') }}">
            <span>〜</span>
            <input type="date" name="to" value="{{ request('to') }}">
            <button type="submit" class="btn">検索</button>
            @if(request('from') || request('to'))
                <a href="{{ route('weight_logs.index') }}" class="btn reset-btn">リセット</a>
            @endif
        </form>

        {{-- 検索条件表示 --}}
        @if(request('from') || request('to'))
            <p class="search-result">
                「{{ request('from') }}〜{{ request('to') }}」の検索結果：{{ $logs->total() }}件
            </p>
        @endif

        {{-- 登録ボタン --}}
        <label for="modal-toggle" class="btn add-btn">データを追加</label>

        {{-- ログ一覧 --}}
        <div class="logs">
            @foreach ($logs as $log)
                <div class="log-item">
                    <p>日付：{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</p>
                    <p>体重：{{ number_format($log->weight, 1) }} kg</p>
                    <p>摂取カロリー：{{ number_format($log->calories) }} kcal</p>
                    @php
                        $parts = explode(':', $log->exercise_time);
                    @endphp
                    <p>運動時間：{{ $parts[0] }}時間{{ $parts[1] }}分</p>
                    <p>運動内容：{{ $log->exercise_detail }}</p>
                    <a href="{{ route('weight_logs.edit', $log->id) }}" class="edit-btn">
                        <img src="{{ asset('images/edit_icon.png') }}" alt="編集" class="edit-icon">
                    </a>
                </div>
            @endforeach
        </div>

        {{-- ページネーション --}}
        <div class="pagination">
            {{ $logs->appends(request()->query())->links() }}
        </div>
    </div>

    {{-- モーダル登録フォーム --}}
    <input type="checkbox" id="modal-toggle" class="modal-toggle" hidden>
    <div class="modal">
        <label for="modal-toggle" class="modal-overlay"></label>
        <div class="modal-content">
            <form method="POST" action="{{ route('weight_logs.store') }}">
                @csrf
                <h2>データ登録</h2>

                {{-- 日付 --}}
                <label>日付：</label>
                <input type="date" name="date" value="{{ old('date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                @error('date')
                    <p class="error">{{ $message }}</p>
                @enderror

                {{-- 体重 --}}
                <label>体重：</label>
                <input type="text" name="weight" step="0.1" value="{{ old('weight') }}" placeholder="例：55.5">
                @error('weight')
                    <p class="error">{{ $message }}</p>
                @enderror

                {{-- 摂取カロリー --}}
                <label>摂取カロリー：</label>
                <input type="number" name="calories" value="{{ old('calories') }}">
                @error('calories')
                    <p class="error">{{ $message }}</p>
                @enderror

                {{-- 運動時間 --}}
                <label>運動時間：</label>
                <input type="time" name="exercise_time" value="{{ old('exercise_time') }}">
                @error('exercise_time')
                    <p class="error">{{ $message }}</p>
                @enderror

                {{-- 運動内容 --}}
                <label>運動内容：</label>
                <textarea name="exercise_detail" maxlength="120">{{ old('exercise_detail') }}</textarea>
                @error('exercise_detail')
                    <p class="error">{{ $message }}</p>
                @enderror

                <div class="modal-buttons">
                    <button type="submit" class="btn">登録</button>
                    <label for="modal-toggle" class="btn cancel">戻る</label>
                </div>
            </form>
        </div>
    </div>
@endsection