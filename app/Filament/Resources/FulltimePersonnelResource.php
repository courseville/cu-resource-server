<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FulltimePersonnelResource\Pages;
use App\Models\Resources\FulltimePersonnel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FulltimePersonnelResource extends Resource
{
    protected static ?string $model = FulltimePersonnel::class;

    protected static ?string $navigationGroup = 'Personnel';

    protected static ?string $navigationLabel = 'Fulltime';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Fulltime';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General Information')
                    ->schema([
                        Forms\Components\Select::make('personnel_id')
                            ->relationship('personnel', 'personnel_id')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Forms\Components\TextInput::make('full_time_id')
                            ->maxLength(255)
                            ->nullable(),
                        Forms\Components\Select::make('job_type')
                            ->options([
                                'Full-time' => 'Full-time',
                                'Part-time' => 'Part-time',
                                'Contract' => 'Contract',
                            ])
                            ->nullable(),
                    ])->columns(3),

                Forms\Components\Section::make('Education Details')
                    ->schema([
                        Forms\Components\TextInput::make('university')
                            ->maxLength(255)
                            ->nullable(),
                        Forms\Components\TextInput::make('degree')
                            ->maxLength(255)
                            ->nullable(),
                        Forms\Components\Select::make('education_level')
                            ->options([
                                'Bachelors' => 'Bachelors',
                                'Masters' => 'Masters',
                                'PhD' => 'PhD',
                                'Diploma' => 'Diploma',
                            ])
                            ->nullable(),
                    ])->columns(3),

                Forms\Components\Section::make('Appointment and Promotion Dates')
                    ->schema([
                        Forms\Components\DatePicker::make('date_of_appointment')
                            ->nullable(),
                        Forms\Components\DatePicker::make('asst_prof_date')
                            ->label('Assistant Professor Date')
                            ->nullable(),
                        Forms\Components\DatePicker::make('prof_date')
                            ->label('Professor Date')
                            ->nullable(),
                        Forms\Components\DatePicker::make('assoc_prof_date')
                            ->label('Associate Professor Date')
                            ->nullable(),
                        Forms\Components\DatePicker::make('teacher_date')
                            ->nullable(),
                    ])->columns(3),

                Forms\Components\Section::make('Personal and Salary Details')
                    ->schema([
                        Forms\Components\DatePicker::make('birth_date')
                            ->nullable(),
                        Forms\Components\TextInput::make('age')
                            ->numeric()
                            ->nullable(),
                        Forms\Components\DatePicker::make('personnel_status_changing_date')
                            ->nullable(),
                        Forms\Components\TextInput::make('salary_band')
                            ->numeric()
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
                TextColumn::make('personnel.title_th')
                    ->label('Title (TH)'),
                TextColumn::make('personnel.first_name_th')
                    ->label('First Name (TH)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('personnel.last_name_th')
                    ->label('Last Name (TH)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('personnel.title_en')
                    ->label('Title (EN)'),
                TextColumn::make('personnel.first_name_en')
                    ->label('First Name (EN)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('personnel.last_name_en')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFulltimePersonnels::route('/'),
            'create' => Pages\CreateFulltimePersonnel::route('/create'),
            'edit' => Pages\EditFulltimePersonnel::route('/{record}/edit'),
        ];
    }
}
