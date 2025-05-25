@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/weight/goal_setting.css') }}">

    <div class="goal-setting-container">
        <h2 class="goal-setting-title">目標体重設定</h2>

        <form method="POST" action="{{ route('goal_setting.update') }}" class="goal-setting-form">
            @csrf
            @method('PUT')

            <div class="goal-setting-input-group">
                <div class="goal-setting-input-wrapper">
                    <input type="text" name="target_weight" value="{{ old('target_weight', $goalWeight) }}"
                        class="goal-setting-input" required>
                    <span class="goal-setting-unit">kg</span>
                </div>

                @error('target_weight')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="goal-setting-buttons">
                <button type="submit" class="main-button">保存</button>
            </div>
        </form>
    </div>
@endsection