<?php

namespace App\Filament\Resources\ContractPersonnels;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\ContractPersonnels\Pages\ListContractPersonnels;
use App\Filament\Resources\ContractPersonnels\Pages\CreateContractPersonnel;
use App\Filament\Resources\ContractPersonnels\Pages\EditContractPersonnel;
use App\Filament\Resources\ContractPersonnelResource\Pages;
use App\Models\Resources\ContractPersonnel;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContractPersonnelResource extends Resource
{
    protected static ?string $model = ContractPersonnel::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Personnel';

    protected static ?string $navigationLabel = 'Contract';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Contract';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contract Personnel Details')
                    ->schema([
                        Select::make('personnel_id')
                            ->relationship('personnel', 'personnel_id')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('contract_id')
                            ->maxLength(255)
                            ->nullable(),
                        DateTimePicker::make('start_date')
                            ->nullable(),
                        DateTimePicker::make('end_date')
                            ->nullable(),
                        Textarea::make('detail')
                            ->columnSpanFull()
                            ->nullable(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('personnel_id')
                    ->label('Personnel ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('contract_id')
                    ->label('Contract ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('end_date')
                    ->label('End Date')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('detail')
                    ->label('Detail')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContractPersonnels::route('/'),
            'create' => CreateContractPersonnel::route('/create'),
            'edit' => EditContractPersonnel::route('/{record}/edit'),
        ];
    }
}
