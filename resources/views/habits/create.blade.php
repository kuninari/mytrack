<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">習慣の新規登録</h2>
    </x-slot>

    <div class="py-6 px-4">
        <form action="{{ route('habits.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-white">習慣名</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full px-4 py-2 border rounded">
                @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex sm:flex-row gap-4 mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold border px-6 py-2 rounded shadow">
                    登録
                </button>
                <a href="{{ route('habits.index') }}" class="text-gray-600 hover:text-gray-800 underline">
                    戻る
                </a>
            </div>

        </form>
    </div>
</x-app-layout>