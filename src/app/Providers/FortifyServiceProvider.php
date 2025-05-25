<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\CreateNewUser;
use Laravel\Fortify\Contracts\LoginViewResponse;
use App\Http\Responses\LoginViewResponse as CustomLoginViewResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // LoginViewResponse をサービスコンテナにバインド
        $this->app->singleton(
            LoginViewResponse::class,
            CustomLoginViewResponse::class
        );
    }

    public function boot(): void
    {
        // Fortifyが提供するルートを無効化
        //Fortify::ignoreRoutes();

        // Fortify のログインビューを指定
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // 登録処理
        Fortify::createUsersUsing(CreateNewUser::class);

        // ログイン時のレート制限
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(10)->by($request->email . $request->ip());
        });
    }
}