# Pigly-test

##　環境構築
# ER図
erDiagram
    USERS ||--o{ WEIGHT_LOGS : has
    USERS ||--o{ WEIGHT_TARGETS : has

    USERS {
        bigint id PK
        string name
        string email
        string password
        timestamp created_at
        timestamp updated_at
    }

    WEIGHT_LOGS {
        bigint id PK
        bigint user_id FK
        date date
        decimal weight
        int calories
        time exercise_time
        text exercise_content
        timestamp created_at
        timestamp updated_at
    }

    WEIGHT_TARGETS {
        bigint id PK
        bigint user_id FK
        decimal target_weight
        timestamp created_at
        timestamp updated_at
    }
# リポジトリをクローン
git clone https://github.com/your-username/pigly.git
cd pigly

# 依存パッケージのインストール
composer install
npm install && npm run dev

# .env の作成とキー生成
cp .env.example .env
php artisan key:generate

# DB接続情報を .env に設定
- DB_CONNECTION=mysql
- DB_HOST=mysql
- DB_PORT=3306
- DB_DATABASE=laravel_db
- DB_USERNAME=laravel_user
- DB_PASSWORD=laravel_pass

# 各コントローラー
コントローラー概要
	•	Auth/LoginController
ユーザーログイン処理を担当
	•	Auth/RegisteredUserController
ユーザー新規登録処理を担当
	•	GoalSetting/GoalSettingController
目標体重の表示・更新処理を担当
	•	WeightLog/WeightLogController
体重ログの登録、一覧表示、編集、削除、検索、目標体重の一部管理を担当
# コントローラー
- php artisan make:controller Auth/LoginController
- php artisan make:controller Auth/RegisteredUserController
- php artisan make:controller GoalSetting/GoalSettingController
- php artisan make:controller WeightLog/WeightLogController
# リクエスト
- php artisan make:requestGoalSettingRequest
- php artisan make:request LoginRequest
- php artisan make:request RegisterRequest
- php artisan make:request UpdateWeightLogRequest
- php artisan make:request WeightLogRequest
# テーブル
- php artisan make:migration create_users_table
- php artisan make:migration create_password_resets_table
- php artisan make:migration create_failed_jobs_table
- php artisan make:migration create_personal_access_tokens_table
- php artisan make:migration create_goal_settings_table
- php artisan make:migration create_weight_logs_table
- php artisan make:migration create_weight_targets_table
# seeder
- php artisan make:seeder DatabaseSeeder
- php artisan make:seeder InitialDummyDataSeeder
- php artisan migrate --seed
## 詳細
# 新規会員登録step1
-http://localhost/register/step1
# 新規会員登録step2
- http://localhost/register/step2
# 目標体重設定
- http://localhost/goal/edit
# ログイン
- http://localhost/login
# 管理画面
- http://localhost/weight_logs
-
-
-
-
