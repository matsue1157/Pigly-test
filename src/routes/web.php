<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\WeightLog\WeightLogController;
use App\Http\Controllers\GoalSetting\GoalSettingController;

// トップページ
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// 会員登録ステップ1（フォーム表示・登録処理）
Route::get('/register/step1', [RegisteredUserController::class, 'create'])->name('register.step1');
Route::post('/register/step1', [RegisteredUserController::class, 'store'])->name('register.store');

// 会員登録 STEP2 (体重・目標体重登録) → ミドルウェアなし
Route::middleware('auth')->group(function () {
    // 会員登録 STEP2 (体重・目標体重登録)
    Route::get('/register/step2', [WeightLogController::class, 'registerStep2Form'])->name('register.step2');
    Route::post('/register/step2', [WeightLogController::class, 'registerStep2Store'])->name('register.step2.store');

    // 他の認証済み専用ルート...
});

// 体重管理画面（目標体重編集など）
Route::middleware('auth')->group(function () {
    Route::get('/goal-setting', [GoalSettingController::class, 'showGoal'])->name('goal_setting.show');
    Route::put('/goal-setting', [GoalSettingController::class, 'updateGoal'])->name('goal_setting.update');
});

// ログイン・ログアウト
Route::get('/login', [LoginController::class, 'create'])->name('login.form');
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

// 認証済みユーザー専用機能
Route::middleware('auth')->group(function () {

    // 体重ログ（一覧・登録・編集・削除）
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');
    Route::get('/weight_logs/{id}/edit', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
    Route::put('/weight_logs/{id}', [WeightLogController::class, 'update'])->name('weight_logs.update');
    Route::delete('/weight_logs/{id}', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');

    // 目標体重の編集・更新
    Route::get('/goal_setting', [GoalSettingController::class, 'edit'])->name('goal_setting.edit');
    Route::put('/goal_setting', [GoalSettingController::class, 'updateGoal'])->name('goal_setting.update');

    // 別ルートでの目標体重設定（おそらくUI用）
    Route::get('/goal/edit', [WeightLogController::class, 'editGoal'])->name('weight_logs.editGoal');

});