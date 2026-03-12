<?php

namespace App\Filament\Resources\Interviewers;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Exports\Resources\InterviewerExporter;
use App\Filament\Resources\Interviewers\Pages\CreateInterviewer;
use App\Filament\Resources\Interviewers\Pages\EditInterviewer;
use App\Filament\Resources\Interviewers\Pages\ListInterviewers;
use App\Filament\Resources\InterviewerResource\Pages;
use App\Models\Resources\Interviewer;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportBulkAction;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InterviewerResource extends Resource
{
    protected static ?string $model = Interviewer::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Academic';

    protected static ?string $navigationLabel = 'Interviewer';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Interviewers';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('position_number')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('title')
                    ->maxLength(255),
                TextInput::make('first_name')
                    ->maxLength(255),
                TextInput::make('last_name')
                    ->maxLength(255),
                Textarea::make('signature'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('position_number')
                    ->searchable(),
                TextColumn::make('title'),
                TextColumn::make('first_name'),
                TextColumn::make('last_name'),
                TextColumn::make('signature'),
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
                    ExportBulkAction::make()
                        ->exporter(InterviewerExporter::class),
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
            'index' => ListInterviewers::route('/'),
            'create' => CreateInterviewer::route('/create'),
            'edit' => EditInterviewer::route('/{record}/edit'),
        ];
    }
}
