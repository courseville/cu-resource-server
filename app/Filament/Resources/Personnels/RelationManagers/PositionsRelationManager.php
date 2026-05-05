<?php

namespace App\Filament\Resources\Personnels\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PositionsRelationManager extends RelationManager
{
    protected static string $relationship = 'positions';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('positiontype_id')
                    ->label('รหัสประเภทตำแหน่ง'),
                TextInput::make('positiontype_name')
                    ->label('ประเภทตำแหน่ง'),
                TextInput::make('positiontype_text')
                    ->label('ชื่อตำแหน่ง'),
                TextInput::make('fieldstudy')
                    ->label('สาขาวิชา'),
                DatePicker::make('begin_date')
                    ->label('วันที่เริ่ม'),
                DatePicker::make('end_date')
                    ->label('วันที่สิ้นสุด'),
                TextInput::make('subdiscipline_1')
                    ->label('สาขาวิชาย่อย 1'),
                TextInput::make('subdiscipline_2')
                    ->label('สาขาวิชาย่อย 2'),
                TextInput::make('subdiscipline_3')
                    ->label('สาขาวิชาย่อย 3'),
                TextInput::make('subdiscipline_4')
                    ->label('สาขาวิชาย่อย 4'),
                TextInput::make('subdiscipline_5')
                    ->label('สาขาวิชาย่อย 5'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('positiontype_name')
            ->defaultSort('begin_date', 'asc')
            ->columns([
                TextColumn::make('positiontype_name')
                    ->label('ประเภทตำแหน่ง')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('positiontype_text')
                    ->label('ชื่อตำแหน่ง')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('fieldstudy')
                    ->label('สาขาวิชา')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('begin_date')
                    ->label('วันที่เริ่ม')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('วันที่สิ้นสุด')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
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
