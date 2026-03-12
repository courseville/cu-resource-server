<?php

namespace App\Filament\Resources\StudentStatusHistories;

use App\Filament\Resources\StudentStatusHistories\Pages\CreateStudentStatusHistory;
use App\Filament\Resources\StudentStatusHistories\Pages\EditStudentStatusHistory;
use App\Filament\Resources\StudentStatusHistories\Pages\ListStudentStatusHistories;
use App\Filament\Resources\StudentStatusHistories\Pages\ViewStudentStatusHistory;
use App\Filament\Resources\StudentStatusHistories\Schemas\StudentStatusHistoryForm;
use App\Filament\Resources\StudentStatusHistories\Schemas\StudentStatusHistoryInfolist;
use App\Filament\Resources\StudentStatusHistories\Tables\StudentStatusHistoriesTable;
use App\Models\Resources\StudentStatusHistory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StudentStatusHistoryResource extends Resource
{
    protected static ?string $model = StudentStatusHistory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Resources';

    public static function form(Schema $schema): Schema
    {
        return StudentStatusHistoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StudentStatusHistoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudentStatusHistoriesTable::configure($table);
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
            'index' => ListStudentStatusHistories::route('/'),
            'create' => CreateStudentStatusHistory::route('/create'),
            'view' => ViewStudentStatusHistory::route('/{record}'),
            'edit' => EditStudentStatusHistory::route('/{record}/edit'),
        ];
    }
}
