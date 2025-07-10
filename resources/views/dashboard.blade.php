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
                    <h3 class="text-lg font-medium text-gray-900">Quiz History</h3>
                    <table class="mt-4 w-full min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Quiz Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Score
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Attempted At
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
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $item->score }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ Carbon\Carbon::parse($item->started_at)->format('d M Y H:i') }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                        <a href="{{ route('quiz.result', $item->id) }}">
                                            <svg class="rounded-xl text-blue-500 hover:bg-blue-50 hover:text-blue-700" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                                                <path fill="currentColor" fill-opacity="0.25"
                                                    d="M20.188 10.934c.388.472.582.707.582 1.066s-.194.594-.582 1.066C18.768 14.79 15.636 18 12 18s-6.768-3.21-8.188-4.934c-.388-.472-.582-.707-.582-1.066s.194-.594.582-1.066C5.232 9.21 8.364 6 12 6s6.768 3.21 8.188 4.934" />
                                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
