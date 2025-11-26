<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContractPersonnelResource\Pages;
use App\Models\Resources\ContractPersonnel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContractPersonnelResource extends Resource
{
    protected static ?string $model = ContractPersonnel::class;

    protected static ?string $navigationGroup = 'Personnel';

    protected static ?string $navigationLabel = 'Contract';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Contract';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contract Personnel Details')
                    ->schema([
                        Forms\Components\Select::make('personnel_id')
                            ->relationship('personnel', 'personnel_id')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Forms\Components\TextInput::make('contract_id')
                            ->maxLength(255)
                            ->nullable(),
                        Forms\Components\DateTimePicker::make('start_date')
                            ->nullable(),
                        Forms\Components\DateTimePicker::make('end_date')
                            ->nullable(),
                        Forms\Components\Textarea::make('detail')
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
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListContractPersonnels::route('/'),
            'create' => Pages\CreateContractPersonnel::route('/create'),
            'edit' => Pages\EditContractPersonnel::route('/{record}/edit'),
        ];
    }
}
