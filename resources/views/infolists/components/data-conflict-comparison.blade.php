@php
    $record = $getRecord();
    $currentData = $record->current_data ?? [];
    $incomingData = $record->incoming_data ?? [];

    $mappings = \App\Transformers\DataTransformer::getMappings($record->data_source_id);
    $modelMappings = $mappings[$record->model_class] ?? [];
    $mappedFields = array_keys($modelMappings);

    // Merge and sort all fields
    $allKeys = array_unique(array_merge(array_keys($currentData), array_keys($incomingData)));
    sort($allKeys);
@endphp

<div class="space-y-6">
    <div
        class="fi-ta-content-ctn border border-gray-200 dark:border-white/5 rounded-xl overflow-hidden shadow-sm bg-white dark:bg-gray-900">
        <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 text-left dark:divide-white/5">
            <thead>
                <tr class="bg-gray-50 dark:bg-white/5 border-b border-gray-200 dark:border-white/5">
                    <th
                        class="fi-ta-header-cell px-6 py-3.5 text-sm font-semibold text-gray-950 dark:text-white w-1/4">
                        Field</th>
                    <th
                        class="fi-ta-header-cell px-6 py-3.5 text-sm font-semibold text-gray-950 dark:text-white w-px whitespace-nowrap">
                        Status</th>
                    <th
                        class="fi-ta-header-cell px-6 py-3.5 text-sm font-semibold text-gray-950 dark:text-white w-1/3">
                        Current Value (Database)</th>
                    <th
                        class="fi-ta-header-cell px-6 py-3.5 text-sm font-semibold text-gray-950 dark:text-white w-1/3">
                        Incoming Value (Sync)</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                @foreach ($allKeys as $key)
                    @php
                        if ($key === 'sync_meta' || $key === 'id' || $key === 'created_at' || $key === 'updated_at') {
                            continue;
                        }

                        $currentVal = $currentData[$key] ?? null;
                        $incomingVal = $incomingData[$key] ?? null;
                        $isMapped = in_array($key, $mappedFields);
                        $isDifferent = $currentVal != $incomingVal;
                    @endphp

                    <tr
                        class="fi-ta-row transition-colors {{ $isDifferent && $isMapped ? 'bg-danger-500/5 dark:bg-danger-500/10' : 'hover:bg-gray-50 dark:hover:bg-white/5' }}">
                        <!-- Field Name -->
                        <td class="fi-ta-cell px-6 py-4 whitespace-nowrap text-sm">
                            <span class="font-medium text-gray-950 dark:text-white">
                                {{ $key }}
                            </span>
                            @if (!$isMapped)
                                <x-filament::badge color="gray" size="sm" class="ml-2 inline-flex">
                                    Unmapped
                                </x-filament::badge>
                            @endif
                        </td>

                        <!-- Status Badge -->
                        <td class="fi-ta-cell px-6 py-4 whitespace-nowrap w-px">
                            <div class="inline-flex items-center whitespace-nowrap min-w-max shrink-0">
                                @if ($isDifferent)
                                    @if ($isMapped)
                                        <x-filament::badge color="danger" icon="heroicon-m-exclamation-triangle">
                                            Conflict
                                        </x-filament::badge>
                                    @else
                                        <x-filament::badge color="warning" icon="heroicon-m-arrow-path">
                                            Changed
                                        </x-filament::badge>
                                    @endif
                                @else
                                    <x-filament::badge color="gray" icon="heroicon-m-check-circle">
                                        Identical
                                    </x-filament::badge>
                                @endif
                            </div>
                        </td>

                        <!-- Current Value -->
                        <td
                            class="fi-ta-cell px-6 py-4 text-sm {{ $isDifferent && $isMapped ? 'text-danger-600 dark:text-danger-400 font-semibold' : 'text-gray-600 dark:text-gray-400' }}">
                            @if (is_null($currentVal))
                                <span class="text-gray-400 dark:text-gray-500 italic">null</span>
                            @elseif ($currentVal === '')
                                <span class="text-gray-400 dark:text-gray-500 italic">[empty string]</span>
                            @else
                                <span
                                    class="font-mono text-xs break-all whitespace-normal">{{ is_array($currentVal) ? json_encode($currentVal, JSON_UNESCAPED_UNICODE) : $currentVal }}</span>
                            @endif
                        </td>

                        <!-- Incoming Value -->
                        <td
                            class="fi-ta-cell px-6 py-4 text-sm {{ $isDifferent && $isMapped ? 'text-success-600 dark:text-success-400 font-semibold' : 'text-gray-600 dark:text-gray-400' }}">
                            @if (is_null($incomingVal))
                                <span class="text-gray-400 dark:text-gray-500 italic">null</span>
                            @elseif ($incomingVal === '')
                                <span class="text-gray-400 dark:text-gray-500 italic">[empty string]</span>
                            @else
                                <span
                                    class="font-mono text-xs break-all whitespace-normal">{{ is_array($incomingVal) ? json_encode($incomingVal, JSON_UNESCAPED_UNICODE) : $incomingVal }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Collapsible Raw Payload view -->
    {{-- <div class="border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden bg-white dark:bg-gray-900">
        <details class="group">
            <summary
                class="flex items-center justify-between px-6 py-4 cursor-pointer select-none font-medium text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-800/30">
                <span>Raw JSON Payloads</span>
                <span class="transition group-open:rotate-180">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
            </summary>
            <div
                class="p-6 border-t border-gray-200 dark:border-gray-800 grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50/50 dark:bg-gray-950/20">
                <div>
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Current Data
                        (Database)</h4>
                    <pre
                        class="p-4 bg-gray-100 dark:bg-gray-950 rounded-lg overflow-x-auto text-xs font-mono text-gray-800 dark:text-gray-300 border border-gray-200 dark:border-gray-800">{{ json_encode($currentData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </div>
                <div>
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Incoming Data (Sync
                        Payload)</h4>
                    <pre
                        class="p-4 bg-gray-100 dark:bg-gray-950 rounded-lg overflow-x-auto text-xs font-mono text-gray-800 dark:text-gray-300 border border-gray-200 dark:border-gray-800">{{ json_encode($incomingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </div>
            </div>
        </details>
    </div> --}}
</div>