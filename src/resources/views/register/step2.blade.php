@extends( 'layouts.guest')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/register/step2.css') }}">

    <div class="register-step2">
        <div class="register-header">
            <h1 class="logo">PiGLy</h1>
            <h2 class="register-title">新規会員登録</h2>
        </div>
        <h3 class="step-title">STEP2：体重データの入力</h3>

        <form method="POST" action="{{ route('register.step2.store') }}" class="register-form">
            @csrf

            <div class="form-group">
                <label for="weight" class="form-label">現在の体重</label>
                <div class="input-row">
                    <div class="input-box">
                        <input type="text" name="weight" id="weight" value="{{ old('weight', $currentWeight ?? '') }}" class="input-field" placeholder="現在の体重を入力">
                    </div>
                    <span class="unit">kg</span>
                </div>
                @error('weight')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="target_weight" class="form-label">目標の体重</label>
                <div class="input-row">
                    <div class="input-box">
<input type="text" name="target_weight" id="target_weight" value="{{ old('target_weight', $goalWeight ?? '') }}" class="input-field" placeholder="目標の体重を入力">
                    </div>
                    <span class="unit">kg</span>
                </div>
                @error('target_weight')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="main-button">アカウント作成</button>
        </form>
    </div>
@endsection