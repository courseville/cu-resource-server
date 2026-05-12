<?php

namespace App\Filament\Resources\Personnels\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PersonnelEducationRelationManager extends RelationManager
{
    protected static string $relationship = 'educations';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('graduate_date')
                    ->label('วันที่สำเร็จการศึกษา'),
                TextInput::make('education_level_name')
                    ->label('ระดับการศึกษา'),
                TextInput::make('degree_name')
                    ->label('วุฒิการศึกษา'),
                TextInput::make('major_name')
                    ->label('สาขาวิชา'),
                TextInput::make('institution_name')
                    ->label('สถาบันการศึกษา'),
                TextInput::make('nation_name_th')
                    ->label('ประเทศ'),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('graduate_date')
                    ->label('วันที่สำเร็จการศึกษา')
                    ->date()
                    ->withSyncMeta(),
                TextEntry::make('education_level_name')
                    ->label('ระดับการศึกษา')
                    ->withSyncMeta(),
                TextEntry::make('degree_name')
                    ->label('วุฒิการศึกษา')
                    ->withSyncMeta(),
                TextEntry::make('major_name')
                    ->label('สาขาวิชา')
                    ->withSyncMeta(),
                TextEntry::make('institution_name')
                    ->label('สถาบันการศึกษา')
                    ->withSyncMeta(),
                TextEntry::make('nation_name_th')
                    ->label('ประเทศ')
                    ->withSyncMeta(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('degree_name')
            ->defaultSort('graduate_date', 'asc')
            ->columns([
                TextColumn::make('graduate_date')
                    ->label('วันที่สำเร็จการศึกษา')
                    ->date()
                    ->sortable(),
                TextColumn::make('education_level_name')
                    ->label('ระดับการศึกษา')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('degree_name')
                    ->label('วุฒิการศึกษา')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('major_name')
                    ->label('สาขาวิชา')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('institution_name')
                    ->label('สถาบันการศึกษา')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nation_name_th')
                    ->label('ประเทศ')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
