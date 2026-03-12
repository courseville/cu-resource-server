<?php

namespace App\Filament\Resources\StudentAdmissions;

use App\Filament\Resources\StudentAdmissions\Pages\CreateStudentAdmission;
use App\Filament\Resources\StudentAdmissions\Pages\EditStudentAdmission;
use App\Filament\Resources\StudentAdmissions\Pages\ListStudentAdmissions;
use App\Filament\Resources\StudentAdmissions\Pages\ViewStudentAdmission;
use App\Filament\Resources\StudentAdmissions\Schemas\StudentAdmissionForm;
use App\Filament\Resources\StudentAdmissions\Schemas\StudentAdmissionInfolist;
use App\Filament\Resources\StudentAdmissions\Tables\StudentAdmissionsTable;
use App\Models\Resources\StudentAdmission;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StudentAdmissionResource extends Resource
{
    protected static ?string $model = StudentAdmission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Student Affair';

    public static function form(Schema $schema): Schema
    {
        return StudentAdmissionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StudentAdmissionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudentAdmissionsTable::configure($table);
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
            'index' => ListStudentAdmissions::route('/'),
            'create' => CreateStudentAdmission::route('/create'),
            'view' => ViewStudentAdmission::route('/{record}'),
            'edit' => EditStudentAdmission::route('/{record}/edit'),
        ];
    }
}
