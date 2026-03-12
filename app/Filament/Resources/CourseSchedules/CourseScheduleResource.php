<?php

namespace App\Filament\Resources\CourseSchedules;

use App\Filament\Resources\CourseSchedules\Pages\CreateCourseSchedule;
use App\Filament\Resources\CourseSchedules\Pages\EditCourseSchedule;
use App\Filament\Resources\CourseSchedules\Pages\ListCourseSchedules;
use App\Filament\Resources\CourseSchedules\Pages\ViewCourseSchedule;
use App\Filament\Resources\CourseSchedules\Schemas\CourseScheduleForm;
use App\Filament\Resources\CourseSchedules\Schemas\CourseScheduleInfolist;
use App\Filament\Resources\CourseSchedules\Tables\CourseSchedulesTable;
use App\Models\Resources\CourseSchedule;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CourseScheduleResource extends Resource
{
    protected static ?string $model = CourseSchedule::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Resources';

    public static function form(Schema $schema): Schema
    {
        return CourseScheduleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CourseScheduleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CourseSchedulesTable::configure($table);
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
            'index' => ListCourseSchedules::route('/'),
            'create' => CreateCourseSchedule::route('/create'),
            'view' => ViewCourseSchedule::route('/{record}'),
            'edit' => EditCourseSchedule::route('/{record}/edit'),
        ];
    }
}
