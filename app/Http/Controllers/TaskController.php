<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // タスク一覧表示
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    // 作成フォーム表示
    public function create()
    {
        return view('tasks.create');
    }

    // 新規登録処理
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        auth()->user()->tasks()->create([
            'title' => $request->title,
        ]);

        return redirect()->route('tasks.index')->with('success', 'タスクを追加しました！');
    }

    // 編集フォーム表示
    public function edit(Task $task)
    {
        $this->authorizeTask($task);

        return view('tasks.edit', compact('task'));
    }

    // 更新処理
    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->update([
            'title' => $request->title,
        ]);

        return redirect()->route('tasks.index')->with('success', 'タスクを更新しました！');
    }

    // 削除処理
    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'タスクを削除しました！');
    }

    // ログインユーザーのタスクかどうか確認
    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403); // 権限なし
        }
    }
}
