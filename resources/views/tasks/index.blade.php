<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">My Tasks</h2>
    </x-slot>

    <div class="py-6 px-4">
        {{-- ここにメッセージ表示 --}}
        @include('components.flash-message')
        <!-- タスク新規作成ボタン -->
        <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">＋ 新規作成</a>

        <!-- タスクリスト表示 -->
        <ul class="mt-4">
            @foreach ($tasks as $task)
            <li class="flex justify-between py-2 border-b">
                <span>{{ $task->title }}</span>
                <div>
                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 mr-2">編集</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>