<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">タスクの新規作成</h2>
    </x-slot>

    <div class="py-6 px-4">
        {{-- ここにメッセージ表示 --}}
        @include('components.flash-message')
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">タスク名</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full px-4 py-2 border rounded">
                @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                登録
            </button>
            <a href="{{ route('