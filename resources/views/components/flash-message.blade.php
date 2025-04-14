@if (session('success'))
<div class="bg-green-100 border border-blue-400 text-blue-700 text-white px-4 py-2 rounded mb-4">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
    入力に問題があります。修正してください。
</div>
@endif