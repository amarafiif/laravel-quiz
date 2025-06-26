@php
    use Filament\Notifications\Livewire\Notifications;
    use Filament\Support\Enums\Alignment;
    use Filament\Support\Enums\VerticalAlignment;
    use Illuminate\Support\Arr;

    $color = $getStatus();
    $isInline = $isInline();
    $status = $getStatus();
    $title = $getTitle();
    $hasTitle = filled($title);
    $date = $getDate();
    $hasDate = filled($date);
    $body = $getBody();
    $hasBody = filled($body);
@endphp

<x-filament-notifications::notification :color="$color" :notification="$notification" :x-transition:enter-start="
        Arr::toCssClasses([
            'opacity-0',
            ($this instanceof Notifications)
            ? match (static::$alignment) {
                Alignment::Start, Alignment::Left => '-translate-x-12',
                Alignment::End, Alignment::Right => 'translate-x-12',
                Alignment::Center => match (static::$verticalAlignment) {
                    VerticalAlignment::Start => '-translate-y-12',
                    VerticalAlignment::End => 'translate-y-12',
                    default => null,
                },
                default => null,
            }
            : null,
        ])
    " :x-transition:leave-end="
        Arr::toCssClasses([
            'opacity-0',
            'scale-95' => ! $isInline,
        ])
    " @class([
        'fi-no-notification w-full overflow-hidden transition duration-300',
        ...match ($isInline) {
            true => ['fi-inline'],
            false => [
                'max-w-sm rounded-xl shadow-lg',
                match ($color) {
                    'gray' => 'bg-gray-600 ring-gray-950/5',
                    default => 'fi-color-custom bg-custom-600',
                },
                is_string($color) ? 'fi-color-' . $color : null,
                'fi-status-' . $status => $status,
            ],
        },
    ]) @style([
        \Filament\Support\get_color_css_variables($color, shades: [600], alias: 'notifications::notification') => !$isInline,
    ])>
    <div @class([
        'flex w-full gap-3 p-4',
        'text-white', // Mengubah semua teks menjadi putih
    ])>
        @if ($icon = $getIcon())
            <div class="text-white">
                <x-filament-notifications::icon :icon="$icon" :size="$getIconSize()" class="text-white" />
            </div>
        @endif

        <div class="mt-0.5 grid flex-1">
            @if ($hasTitle)
                <x-filament-notifications::title class="tracking-tight font-semibold text-white">
                    {{ str($title)->sanitizeHtml()->toHtmlString() }}
                </x-filament-notifications::title>
            @endif

            @if ($hasDate)
                <x-filament-notifications::date @class(['mt-1' => $hasTitle, 'text-white'])>
                    {{ $date }}
                </x-filament-notifications::date>
            @endif

            @if ($hasBody)
                <x-filament-notifications::body>
                    {{ str($body)->sanitizeHtml()->toHtmlString() }}
                </x-filament-notifications::body>
            @endif

            @if ($actions = $getActions())
                <x-filament-notifications::actions :actions="$actions" @class(['mt-3' => $hasTitle || $hasDate || $hasBody, 'text-white']) />
            @endif
        </div>

        <!-- Modified close button to be white -->
        <button type="button" class="text-white opacity-70 hover:opacity-100 transition duration-75" x-on:click="close">
            <x-filament::icon alias="notifications::notification.close-button" icon="heroicon-m-x-mark" class="h-4 w-4" />
        </button>
    </div>
</x-filament-notifications::notification>
