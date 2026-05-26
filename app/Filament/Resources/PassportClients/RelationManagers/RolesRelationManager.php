<?php

namespace App\Filament\Resources\PassportClients\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RolesRelationManager extends RelationManager
{
    protected static string $relationship = 'roles';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->disabled()
                    ->maxLength(255),
                Select::make('domain')
                    ->label('Domain (Faculty Code)')
                    ->options([
                        '21' => 'Engineering (21)',
                        '22' => 'Arts (22)',
                        '23' => 'Science (23)',
                        '24' => 'Political Science (24)',
                        '25' => 'Architecture (25)',
                        '26' => 'Commerce and Accountancy (26)',
                        '27' => 'Education (27)',
                        '28' => 'Communication Arts (28)',
                        '29' => 'Economics (29)',
                        '30' => 'Medicine (30)',
                        '31' => 'Veterinary Science (31)',
                        '32' => 'Dentistry (32)',
                        '33' => 'Pharmaceutical Sciences (33)',
                        '34' => 'Law (34)',
                        '35' => 'Allied Health Sciences (35)',
                        '36' => 'Nursing (36)',
                        '37' => 'Fine and Applied Arts (37)',
                        '38' => 'Sports Science (38)',
                        '39' => 'Psychology (39)',
                        '40' => 'School of Agricultural Resources (40)',
                        '51' => 'Graduate School (51)',
                        '53' => 'Sasin (53)',
                    ])
                    ->searchable()
                    ->placeholder('Full Access (Global)')
                    ->helperText('Empty domain means full access to all data.'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('domain')
                    ->label('Domain')
                    ->placeholder('Full Access')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Select::make('domain')
                            ->label('Domain (Faculty Code)')
                            ->options([
                                '21' => 'Engineering (21)',
                                '22' => 'Arts (22)',
                                '23' => 'Science (23)',
                                '24' => 'Political Science (24)',
                                '25' => 'Architecture (25)',
                                '26' => 'Commerce and Accountancy (26)',
                                '27' => 'Education (27)',
                                '28' => 'Communication Arts (28)',
                                '29' => 'Economics (29)',
                                '30' => 'Medicine (30)',
                                '31' => 'Veterinary Science (31)',
                                '32' => 'Dentistry (32)',
                                '33' => 'Pharmaceutical Sciences (33)',
                                '34' => 'Law (34)',
                                '35' => 'Allied Health Sciences (35)',
                                '36' => 'Nursing (36)',
                                '37' => 'Fine and Applied Arts (37)',
                                '38' => 'Sports Science (38)',
                                '39' => 'Psychology (39)',
                                '40' => 'School of Agricultural Resources (40)',
                                '51' => 'Graduate School (51)',
                                '53' => 'Sasin (53)',
                            ])
                            ->searchable()
                            ->placeholder('Full Access (Global)')
                            ->helperText('Empty domain means full access to all data.'),
                    ])
                    // JSON column break select
                    ->recordSelectOptionsQuery(fn (Builder $query) => $query->select('roles.id', 'roles.name')),
                // Tables\Actions\CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
