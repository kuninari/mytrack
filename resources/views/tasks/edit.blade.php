<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">タスクの編集</h2>
    </x-slot>

    <div class="py-6 px-4">
        {{-- ここにメッセージ表示 --}}
        @include('components.flash-message')
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">タスク名</label>
                <input type="text" name="title" value="{{ old('title', $task->title) }}"
                    class="w-full px-4 py-2 border rounded">
                @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                更新
            </button>
            <a href="{{ route('tasks.index') }}" class="ml-4 text-gray-600 underline">戻る</a>
        </form>
    </div>
</x-app-layout>