<?php

namespace App\Filament\Resources\StudentInternships;

use App\Filament\Resources\StudentInternships\Pages\CreateStudentInternship;
use App\Filament\Resources\StudentInternships\Pages\EditStudentInternship;
use App\Filament\Resources\StudentInternships\Pages\ListStudentInternships;
use App\Filament\Resources\StudentInternships\Pages\ViewStudentInternship;
use App\Filament\Resources\StudentInternships\Schemas\StudentInternshipForm;
use App\Filament\Resources\StudentInternships\Schemas\StudentInternshipInfolist;
use App\Filament\Resources\StudentInternships\Tables\StudentInternshipsTable;
use App\Models\Resources\StudentInternship;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StudentInternshipResource extends Resource
{
    protected static ?string $model = StudentInternship::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Student Affair';

    public static function form(Schema $schema): Schema
    {
        return StudentInternshipForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StudentInternshipInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudentInternshipsTable::configure($table);
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
            'index' => ListStudentInternships::route('/'),
            'create' => CreateStudentInternship::route('/create'),
            'view' => ViewStudentInternship::route('/{record}'),
            'edit' => EditStudentInternship::route('/{record}/edit'),
        ];
    }
}
