<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HabitController extends Controller
{
    // 一覧表示
    public function index()
    {
        $habits = auth()->user()->habits()->with('records')->latest()->get();

        $dates = collect();
        $today = Carbon::today();

        for ($i = 6; $i >= 0; $i--) {
            $dates->push($today->copy()->subDays($i)->toDateString());
        }

        // 各日付ごとの達成数を集計（例：3習慣のうち2つ達成なら2）
        $stats = $dates->map(function ($date) use ($habits) {
            return $habits->reduce(function ($count, $habit) use ($date) {
                return $count + ($habit->records->where('recorded_date', $date)->isNotEmpty() ? 1 : 0);
            }, 0);
        });

        return view('habits.index', [
            'habits' => $habits,
            'dates' => $dates,
            'stats' => $stats,
        ]);
    }

    // 作成フォーム表示
    public function create()
    {
        return view('habits.create');
    }

    // 新規登録処理
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        auth()->user()->habits()->create([
            'title' => $request->title,
        ]);

        return redirect()->route('habits.index')->with('success', '習慣を追加しました！');
    }

    // 他の機能（編集・削除）は後ほど追加します
}
