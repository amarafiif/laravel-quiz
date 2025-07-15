<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900">Riwayat Kuis</h3>
                    <div class="overflow-x-auto">
                        <table class="mt-4 w-full min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Nama Kuis
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Skor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Waktu
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($attempts as $item)
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $item->quiz->name }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-900">{{ $item->score }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-900">{{ Carbon\Carbon::parse($item->started_at)->format('d M Y H:i') }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                            @if ($item->submitted_at)
                                                <a href="{{ route('quiz.result', $item->uuid) }}">
                                                    <svg class="rounded-xl text-sky-500 hover:bg-sky-50 hover:text-sky-700" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                                                        <path fill="currentColor" fill-opacity="0.25"
                                                            d="M20.188 10.934c.388.472.582.707.582 1.066s-.194.594-.582 1.066C18.768 14.79 15.636 18 12 18s-6.768-3.21-8.188-4.934c-.388-.472-.582-.707-.582-1.066s.194-.594.582-1.066C5.232 9.21 8.364 6 12 6s6.768 3.21 8.188 4.934" />
                                                        <circle cx="12" cy="12" r="3" fill="currentColor" />
                                                    </svg>
                                                </a>
                                            @else
                                                <a href="{{ route('quiz.attempt', $item->uuid) }}" class="text-sky-500 hover:text-sky-700">
                                                    Lanjutkan Kuis
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
