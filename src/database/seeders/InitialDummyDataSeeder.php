<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\GoalSetting;

class InitialDummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // ① ユーザー1人作成
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // ログイン用
        ]);

        // ② 体重ログ35件作成（user_idを紐づけ）
        WeightLog::factory()->count(35)->create([
            'user_id' => $user->id,
        ]);

        // ③ 目標体重1件作成
        GoalSetting::factory()->create([
            'user_id' => $user->id,
        ]);
    }
}
