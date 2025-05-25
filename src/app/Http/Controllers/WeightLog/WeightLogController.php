<?php

namespace App\Http\Controllers\WeightLog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WeightLogRequest;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;

class WeightLogController extends Controller
{
    // 登録ステップ2画面表示（不要なら削除可）
    public function registerStep2Form()
    {
        return view('register.step2');
    }

    // 登録ステップ2保存（不要なら削除可）
    public function registerStep2Store(WeightLogRequest $request)
    {
        WeightLog::create([
            'user_id' => auth()->id(),
            'date' => $request->date,  // ここはフォームからの日付を使う
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_detail' => $request->exercise_detail,
        ]);

        WeightTarget::updateOrCreate(
            ['user_id' => auth()->id()],
            ['target_weight' => $request->target_weight]
        );

        return redirect()->route('weight_logs.index')->with('success', '体重と目標体重を保存しました。');
    }

    // 体重ログ一覧＆検索
    public function index(Request $request)
    {
        $userId = auth()->id();

        $weightLogsQuery = WeightLog::where('user_id', $userId);

        if ($request->filled('from')) {
            $weightLogsQuery->where('date', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $weightLogsQuery->where('date', '<=', $request->to);
        }

        $weightLogs = $weightLogsQuery->orderBy('date', 'desc')->paginate(10)->appends($request->all());

        $goalWeightRecord = WeightTarget::where('user_id', $userId)->first();
        $goalWeight = $goalWeightRecord ? $goalWeightRecord->target_weight : null;

        $latestLog = WeightLog::where('user_id', $userId)->orderBy('date', 'desc')->first();
        $currentWeight = $latestLog ? $latestLog->weight : null;

        return view('weight_logs.index', [
            'logs' => $weightLogs,
            'goalWeight' => $goalWeight,
            'currentWeight' => $currentWeight,
        ]);
    }

    // 新規登録処理
    public function store(WeightLogRequest $request)
    {
        WeightLog::create([
            'user_id' => auth()->id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_detail' => $request->exercise_detail,
        ]);

        return redirect()->route('weight_logs.index')->with('success', '体重を記録しました。');
    }

    // 編集画面表示
    public function edit($id)
    {
        $log = WeightLog::where('user_id', auth()->id())->findOrFail($id);
        return view('weight_logs.edit', compact('log'));
    }

    // 更新処理
    public function update(WeightLogRequest $request, $id)
    {
        $log = WeightLog::where('user_id', auth()->id())->findOrFail($id);
        $log->update([
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_detail' => $request->exercise_detail,
        ]);

        return redirect()->route('weight_logs.index')->with('success', '記録を更新しました。');
    }

    // 削除処理
    public function destroy($id)
    {
        $log = WeightLog::where('user_id', auth()->id())->findOrFail($id);
        $log->delete();

        return redirect()->route('weight_logs.index')->with('success', '記録を削除しました。');
    }

    // 目標体重編集画面表示
    public function editGoal()
    {
        $userId = auth()->id();

        $goalSetting = WeightTarget::firstOrNew(['user_id' => $userId]);
        $goalWeight = $goalSetting->target_weight;

        return view('weight_logs.goal_setting', compact('goalSetting', 'goalWeight'));
    }

    // 目標体重更新処理
    public function updateGoal(Request $request)
    {
        $request->validate([
            'goal_weight' => ['required', 'numeric', 'max:999.9', 'regex:/^\d{1,4}(\.\d)?$/'],
        ], [
            'goal_weight.required' => '目標の体重を入力してください',
            'goal_weight.numeric' => '数値で入力してください',
            'goal_weight.max' => '4桁までの数字で入力してください',
            'goal_weight.regex' => '小数点は1桁で入力してください',
        ]);

        WeightTarget::updateOrCreate(
            ['user_id' => auth()->id()],
            ['target_weight' => $request->goal_weight]
        );

        return redirect()->route('weight_logs.index')->with('success', '目標体重を更新しました。');
    }
}