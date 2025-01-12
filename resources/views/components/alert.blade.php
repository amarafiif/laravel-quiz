@props(['type' => 'info', 'message' => ''])

@if (session('success'))
    @php
        $type = 'success';
        $message = session('success');
    @endphp
@elseif (session('error'))
    @php
        $type = 'error';
        $message = session('error');
    @endphp
@elseif (session('warning'))
    @php
        $type = 'warning';
        $message = session('warning');
    @endphp
@elseif (session('info'))
    @php
        $type = 'info';
        $message = session('info');
    @endphp
@endif

@if ($message)
    @php
        $colors = [
            'success' => 'green',
            'error' => 'red',
            'warning' => 'yellow',
            'info' => 'blue',
        ];

        $color = $colors[$type] ?? 'blue';
    @endphp

    <div id="alert"
        class="flex items-center p-4 mb-4 text-{{ $color }}-600 rounded-lg bg-{{ $color }}-100 border border-{{ $color }}-300"
        role="alert">
        @if ($type === 'success')
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 48 48">
                <defs>
                    <mask id="ipTSuccess0">
                        <g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round">
                            <path fill="#555555"
                                d="m24 4l5.253 3.832l6.503-.012l1.997 6.188l5.268 3.812L41 24l2.021 6.18l-5.268 3.812l-1.997 6.188l-6.503-.012L24 44l-5.253-3.832l-6.503.012l-1.997-6.188l-5.268-3.812L7 24l-2.021-6.18l5.268-3.812l1.997-6.188l6.503.012z" />
                            <path d="m17 24l5 5l10-10" />
                        </g>
                    </mask>
                </defs>
                <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipTSuccess0)" />
            </svg>
        @elseif($type === 'error')
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
        @elseif($type === 'warning')
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24">
                <path fill="currentColor" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity="0.5" />
                <path fill="currentColor"
                    d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
            </svg>
        @else
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
        @endif

        <span class="sr-only">{{ ucfirst($type) }}</span>
        <div class="ms-3 text-sm font-medium">
            {{ $message }}
        </div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-{{ $color }}-100 text-{{ $color }}-600 rounded-lg focus:ring-2 focus:ring-{{ $color }}-300 focus:bg-{{ $color }}-200 p-1.5 hover:bg-{{ $color }}-200 inline-flex items-center justify-center h-8 w-8"
            data-dismiss-target="#alert-3" aria-label="Close" onclick="closeAlert()">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>

    <script>
        function closeAlert() {
            document.getElementById('alert').style.display = 'none';
        }

        setTimeout(function() {
            document.getElementById('alert').style.display = 'none';
        }, 5000);
    </script>
@endif
