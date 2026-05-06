<?php

namespace App\Filament\Resources\StudentAdvisors;

use App\Filament\Resources\StudentAdvisors\Pages\CreateStudentAdvisor;
use App\Filament\Resources\StudentAdvisors\Pages\EditStudentAdvisor;
use App\Filament\Resources\StudentAdvisors\Pages\ListStudentAdvisors;
use App\Models\Resources\StudentAdvisor;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentAdvisorResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $model = StudentAdvisor::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Student Affair';

    protected static ?string $navigationLabel = 'Student Advisors';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('student_id')
                            ->label('Student ID')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('staff_id')
                            ->label('Staff ID (Advisor)')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_id')
                    ->label('Student ID')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('staff_id')
                    ->label('Staff ID (Advisor)')
                    ->searchable()
                    ->sortable(),
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

    public static function getPages(): array
    {
        return [
            'index' => ListStudentAdvisors::route('/'),
            'create' => CreateStudentAdvisor::route('/create'),
            'edit' => EditStudentAdvisor::route('/{record}/edit'),
        ];
    }
}
