@props(['meta'])

@php
    $sourceName = 'Manual';
    if (!empty($meta['source_id'])) {
        $sourceName = cache()->remember("data_source_name_{$meta['source_id']}", 60, function () use ($meta) {
            return \App\Models\DataSource::find($meta['source_id'])?->name ?? $meta['source_id'];
        });
    }

    $userName = '';
    if (!empty($meta['user_id'])) {
        $userName = cache()->remember("user_name_{$meta['user_id']}", 60, function () use ($meta) {
            return \App\Models\User::find($meta['user_id'])?->name ?? "User: {$meta['user_id']}";
        });
        $userName = "User: {$userName}";
    }

    $at = !empty($meta['at']) ? "At: {$meta['at']}" : '';
    $tooltipStr = implode(' | ', array_filter([$userName, $at]));

    $isSystem = !empty($meta['source_id']);
    $icon = $isSystem ? 'heroicon-m-arrow-path' : 'heroicon-m-user';
    $color = $isSystem ? 'success' : 'info';
@endphp

<x-filament::badge :color="$color" :icon="$icon" tooltip="{{ $tooltipStr }}">
    {{ $sourceName }}
</x-filament::badge>
