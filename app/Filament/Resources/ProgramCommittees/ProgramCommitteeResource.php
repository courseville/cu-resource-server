<?php

namespace App\Filament\Resources\ProgramCommittees;

use App\Filament\Resources\ProgramCommittees\Pages\CreateProgramCommittee;
use App\Filament\Resources\ProgramCommittees\Pages\EditProgramCommittee;
use App\Filament\Resources\ProgramCommittees\Pages\ListProgramCommittees;
use App\Filament\Resources\ProgramCommittees\Pages\ViewProgramCommittee;
use App\Filament\Resources\ProgramCommittees\Schemas\ProgramCommitteeForm;
use App\Filament\Resources\ProgramCommittees\Schemas\ProgramCommitteeInfolist;
use App\Filament\Resources\ProgramCommittees\Tables\ProgramCommitteesTable;
use App\Models\Resources\ProgramCommittee;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProgramCommitteeResource extends Resource
{
    protected static ?string $model = ProgramCommittee::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Resources';

    public static function form(Schema $schema): Schema
    {
        return ProgramCommitteeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProgramCommitteeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProgramCommitteesTable::configure($table);
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
            'index' => ListProgramCommittees::route('/'),
            'create' => CreateProgramCommittee::route('/create'),
            'view' => ViewProgramCommittee::route('/{record}'),
            'edit' => EditProgramCommittee::route('/{record}/edit'),
        ];
    }
}
