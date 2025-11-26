<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonnelResource\Pages;
use App\Models\Resources\Personnel;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PersonnelResource extends Resource
{
    protected static ?string $model = Personnel::class;

    protected static ?string $navigationGroup = 'Personnel';

    protected static ?string $navigationLabel = 'Personnel';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Personal Information')
                    ->schema([
                        TextInput::make('personnel_id')
                            ->label('Personnel ID')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('title_th')
                            ->label('Title (TH)')
                            ->maxLength(255),
                        TextInput::make('first_name_th')
                            ->label('First Name (TH)')
                            ->maxLength(255),
                        TextInput::make('last_name_th')
                            ->label('Last Name (TH)')
                            ->maxLength(255),
                        TextInput::make('title_en')
                            ->label('Title (EN)')
                            ->maxLength(255),
                        TextInput::make('first_name_en')
                            ->label('First Name (EN)')
                            ->maxLength(255),
                        TextInput::make('last_name_en')
                            ->label('Last Name (EN)')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Additional Personal Information')
                    ->schema([
                        TextInput::make('passport_no')
                            ->label('Passport Number')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Contact Information')
                    ->schema([
                        TextInput::make('public_email')
                            ->label('Public Email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('private_email')
                            ->label('Private Email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone_no')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('telephone_no')
                            ->label('Telephone Number')
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('building')
                            ->label('Building')
                            ->maxLength(255),
                        TextInput::make('floor')
                            ->label('Floor')
                            ->maxLength(255),
                        TextInput::make('room')
                            ->label('Room')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Registered Address')
                    ->schema([
                        Textarea::make('registered_address')
                            ->label('Address')
                            ->maxLength(65535),
                        TextInput::make('registered_sub_district')
                            ->label('Sub-district')
                            ->maxLength(255),
                        TextInput::make('registered_district')
                            ->label('District')
                            ->maxLength(255),
                        TextInput::make('registered_province')
                            ->label('Province')
                            ->maxLength(255),
                        TextInput::make('registered_postal_code')
                            ->label('Postal Code')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Current Address')
                    ->schema([
                        Textarea::make('current_address')
                            ->label('Address')
                            ->maxLength(65535),
                        TextInput::make('current_sub_district')
                            ->label('Sub-district')
                            ->maxLength(255),
                        TextInput::make('current_district')
                            ->label('District')
                            ->maxLength(255),
                        TextInput::make('current_province')
                            ->label('Province')
                            ->maxLength(255),
                        TextInput::make('current_postal_code')
                            ->label('Postal Code')
                            ->maxLength(255),
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
                TextColumn::make('title_th')
                    ->label('Title (TH)'),
                TextColumn::make('first_name_th')
                    ->label('First Name (TH)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('last_name_th')
                    ->label('Last Name (TH)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title_en')
                    ->label('Title (EN)'),
                TextColumn::make('first_name_en')
                    ->label('First Name (EN)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('last_name_en')
                    ->label('Last Name (EN)')
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
            PersonnelResource\RelationManagers\StructureProfilesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPersonnels::route('/'),
            'create' => Pages\CreatePersonnel::route('/create'),
            'edit' => Pages\EditPersonnel::route('/{record}/edit'),
        ];
    }
}
