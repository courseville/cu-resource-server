<?php

namespace App\Filament\Resources\Scholarships;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Exports\Resources\ScholarshipExporter;
use App\Filament\Resources\Scholarships\Pages\CreateScholarship;
use App\Filament\Resources\Scholarships\Pages\EditScholarship;
use App\Filament\Resources\Scholarships\Pages\ListScholarships;
use App\Filament\Resources\ScholarshipResource\Pages;
use App\Filament\Resources\ScholarshipResource\RelationManagers;
use App\Models\Resources\Scholarship;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ScholarshipResource extends Resource
{
    protected static ?string $model = Scholarship::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Student Affair';

    protected static ?string $navigationLabel = 'Scholarships';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Scholarships';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Scholarship Details')
                    ->schema([
                        TextInput::make('scholarship_name')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->nullable()
                            ->rows(5),
                        FileUpload::make('file')
                            ->nullable()
                            ->disk('public') // Or your preferred disk
                            ->directory('scholarship-files'),
                        Textarea::make('file_description')
                            ->nullable()
                            ->rows(3),
                        TextInput::make('academic_year')
                            ->required()
                            ->numeric(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scholarship_name'),
                TextColumn::make('academic_year'),
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
                        ->exporter(ScholarshipExporter::class),
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
            'index' => ListScholarships::route('/'),
            'create' => CreateScholarship::route('/create'),
            'edit' => EditScholarship::route('/{record}/edit'),
        ];
    }
}
