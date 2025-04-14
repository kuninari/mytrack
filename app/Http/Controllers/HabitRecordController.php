<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\HabitRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HabitRecordController extends Controller
{
    public function toggle(Habit $habit)
    {
        // 自分の習慣だけ操作可能
        if ($habit->user_id !== auth()->id()) {
            abort(403);
        }

        $today = Carbon::today()->toDateString();

        // 今日の記録があるか確認
        $record = $habit->records()->where('recorded_date', $today)->first();

        if ($record) {
            // チェック済みなら削除（トグル）
            $record->delete();
        } else {
            // なければ新しく記録
            $habit->records()->create([
                'recorded_date' => $today,
                'is_done' => true,
            ]);
        }

        return redirect()->back()->with('success', 'チェックを更新しました！');
    }
}
