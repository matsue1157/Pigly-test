<?php

namespace App\Http\Controllers\GoalSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\GoalSettingRequest;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Auth;

class GoalSettingController extends Controller
{
    public function edit()
    {
        $weightTarget = WeightTarget::firstOrNew(['user_id' => Auth::id()]);
        $goalWeight = $weightTarget->target_weight;
        $currentWeight = WeightLog::where('user_id', Auth::id())->latest('date')->value('weight');

        return view('weight_logs.goal_setting', compact('goalWeight', 'currentWeight'));
    }

    public function update(GoalSettingRequest $request)
    {
        $userId = Auth::id();
        // 保存：目標体重
        WeightTarget::updateOrCreate(
            ['user_id' => $userId],
            ['target_weight' => $request->target_weight]
        );

        // 保存：現在の体重
        WeightLog::create([
            'user_id' => $userId,
            'weight' => $request->weight,
            'date' => now()->format('Y-m-d'),
        ]);

        return redirect()->route('weight_logs.index')->with('success', '現在の体重と目標体重を保存しました。');
    }
}