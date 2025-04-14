<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">習慣トラッカー</h2>
    </x-slot>

    <div class="py-6 px-4">
        @include('components.flash-message')

        <a href="{{ route('habits.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            ＋ 新しい習慣を追加
        </a>

        <ul class="mt-4">
            @forelse ($habits as $habit)
            @php
            $today = \Illuminate\Support\Carbon::today()->toDateString();
            $checked = $habit->records->where('recorded_date', $today)->first();
            @endphp
            <li class="py-2 border-b flex justify-between items-center">
                <span>{{ $habit->title }}</span>

                <form action="{{ route('habits.toggle', $habit) }}" method="POST">
                    @csrf
                    <button class="text-xl">
                        {{ $checked ? '✅' : '☐' }}
                    </button>
                </form>
            </li>
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-2">今週の達成状況</h3>
                <canvas id="habitChart" height="100"></canvas>
            </div>

            @empty
            <li class="text-gray-600 mt-4">まだ習慣が登録されていません。</li>
            @endforelse
        </ul>

    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('habitChart').getContext('2d');
    const habitChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($dates),
            datasets: [{
                label: '達成した習慣の数',
                data: @json($stats),
                backgroundColor: 'rgba(59, 130, 246, 0.7)', // blue-500相当
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        color: '#1e3a8a', // blue-800
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#1e3a8a'
                    },
                    grid: {
                        color: 'rgba(200,200,200,0.2)'
                    }
                },
                x: {
                    ticks: {
                        color: '#1e3a8a'
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>