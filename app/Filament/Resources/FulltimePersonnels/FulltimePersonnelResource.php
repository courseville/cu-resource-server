<?php

namespace App\Filament\Resources\FulltimePersonnels;

use App\Filament\Resources\FulltimePersonnels\Pages\CreateFulltimePersonnel;
use App\Filament\Resources\FulltimePersonnels\Pages\EditFulltimePersonnel;
use App\Filament\Resources\FulltimePersonnels\Pages\ListFulltimePersonnels;
use App\Models\Resources\FulltimePersonnel;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FulltimePersonnelResource extends Resource
{
    protected static ?string $model = FulltimePersonnel::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Personnel';

    protected static ?string $navigationLabel = 'Fulltime';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Fulltime';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->schema([
                        Select::make('personnel_id')
                            ->relationship('personnel', 'personnel_id')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('full_time_id')
                            ->maxLength(255)
                            ->nullable(),
                        Select::make('job_type')
                            ->options([
                                'Full-time' => 'Full-time',
                                'Part-time' => 'Part-time',
                                'Contract' => 'Contract',
                            ])
                            ->nullable(),
                    ])->columns(3),

                Section::make('Education Details')
                    ->schema([
                        TextInput::make('university')
                            ->maxLength(255)
                            ->nullable(),
                        TextInput::make('degree')
                            ->maxLength(255)
                            ->nullable(),
                        Select::make('education_level')
                            ->options([
                                'Bachelors' => 'Bachelors',
                                'Masters' => 'Masters',
                                'PhD' => 'PhD',
                                'Diploma' => 'Diploma',
                            ])
                            ->nullable(),
                    ])->columns(3),

                Section::make('Appointment and Promotion Dates')
                    ->schema([
                        DatePicker::make('date_of_appointment')
                            ->nullable(),
                        DatePicker::make('asst_prof_date')
                            ->label('Assistant Professor Date')
                            ->nullable(),
                        DatePicker::make('prof_date')
                            ->label('Professor Date')
                            ->nullable(),
                        DatePicker::make('assoc_prof_date')
                            ->label('Associate Professor Date')
                            ->nullable(),
                        DatePicker::make('teacher_date')
                            ->nullable(),
                    ])->columns(3),

                Section::make('Personal and Salary Details')
                    ->schema([
                        DatePicker::make('birth_date')
                            ->nullable(),
                        TextInput::make('age')
                            ->numeric()
                            ->nullable(),
                        DatePicker::make('personnel_status_changing_date')
                            ->nullable(),
                        TextInput::make('salary_band')
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
            'index' => ListFulltimePersonnels::route('/'),
            'create' => CreateFulltimePersonnel::route('/create'),
            'edit' => EditFulltimePersonnel::route('/{record}/edit'),
        ];
    }
}
