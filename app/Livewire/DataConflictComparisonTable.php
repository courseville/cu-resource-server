<?php

namespace App\Livewire;

use App\Models\DataConflict;
use App\Transformers\DataTransformer;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class DataConflictComparisonTable extends Component implements HasForms, HasTable
{
    use InteractsWithActions;
    use InteractsWithForms;
    use InteractsWithTable;

    public DataConflict $record;

    public function table(Table $table): Table
    {
        $currentData = $this->record->current_data ?? [];
        $incomingData = $this->record->incoming_data ?? [];

        $mappings = DataTransformer::getMappings($this->record->data_source_id);
        $modelMappings = $mappings[$this->record->model_class] ?? [];
        $mappedFields = array_keys($modelMappings);

        $allKeys = array_unique(array_merge(array_keys($currentData), array_keys($incomingData)));
        sort($allKeys);

        $records = [];
        foreach ($allKeys as $key) {
            if (in_array($key, ['sync_meta', 'id', 'created_at', 'updated_at'])) {
                continue;
            }

            $currentVal = $currentData[$key] ?? null;
            $incomingVal = $incomingData[$key] ?? null;
            $isMapped = in_array($key, $mappedFields);
            $isDifferent = $currentVal != $incomingVal;

            $status = 'identical';
            if ($isDifferent) {
                $status = $isMapped ? 'conflict' : 'changed';
            }

            $records[$key] = [
                'id' => $key,
                'field' => $key,
                'is_mapped' => $isMapped,
                'status' => $status,
                'current_value' => $currentVal,
                'incoming_value' => $incomingVal,
            ];
        }

        return $table
            ->records(fn () => $records)
            ->columns([
                TextColumn::make('field')
                    ->label('Field')
                    ->weight('medium')
                    ->description(fn ($record) => ! $record['is_mapped'] ? 'Unmapped' : null),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'conflict' => 'danger',
                        'changed' => 'warning',
                        'identical' => 'gray',
                        default => 'gray',
                    })
                    ->icon(fn ($state) => match ($state) {
                        'conflict' => 'heroicon-m-exclamation-triangle',
                        'changed' => 'heroicon-m-arrow-path',
                        'identical' => 'heroicon-m-check-circle',
                        default => null,
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state)),
                TextColumn::make('current_value')
                    ->label('Current Value (Database)')
                    ->fontFamily('mono')
                    ->size('xs')
                    ->wrap()
                    ->formatStateUsing(function ($state) {
                        if (is_null($state)) {
                            return 'null';
                        }
                        if ($state === '') {
                            return '[empty string]';
                        }

                        return is_array($state) ? json_encode($state, JSON_UNESCAPED_UNICODE) : $state;
                    })
                    ->color(fn ($record) => $record['status'] === 'conflict' ? 'danger' : 'gray'),
                TextColumn::make('incoming_value')
                    ->label('Incoming Value (Sync)')
                    ->fontFamily('mono')
                    ->size('xs')
                    ->wrap()
                    ->formatStateUsing(function ($state) {
                        if (is_null($state)) {
                            return 'null';
                        }
                        if ($state === '') {
                            return '[empty string]';
                        }

                        return is_array($state) ? json_encode($state, JSON_UNESCAPED_UNICODE) : $state;
                    })
                    ->color(fn ($record) => $record['status'] === 'conflict' ? 'success' : 'gray'),
            ]);
    }

    public function render()
    {
        return <<<'HTML'
        <div>
            {{ $this->table }}
        </div>
        HTML;
    }
}
