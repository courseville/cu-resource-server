<?php

namespace App\Filament\Resources\Scholarships;

use App\Filament\Exports\Resources\ScholarshipExporter;
use App\Filament\Resources\Scholarships\Pages\CreateScholarship;
use App\Filament\Resources\Scholarships\Pages\EditScholarship;
use App\Filament\Resources\Scholarships\Pages\ListScholarships;
use App\Models\Resources\Scholarship;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ScholarshipResource extends Resource
{
    protected static ?string $model = Scholarship::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Student Affair';

    protected static ?string $navigationLabel = 'Scholarships';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Scholarships';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Scholarship Details')
                    ->schema([
                        TextInput::make('job_code')
                            ->label('Job Code')
                            ->maxLength(255),
                        TextInput::make('fcode')
                            ->label('Faculty Code')
                            ->maxLength(255),
                        TextInput::make('scholarship_name')
                            ->label('ชื่อทุน (ภาษาไทย)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('name_en')
                            ->label('ชื่อทุน (ภาษาอังกฤษ)')
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('รายละเอียด')
                            ->nullable()
                            ->rows(5)
                            ->columnSpanFull(),
                        // FileUpload::make('file')
                        //     ->nullable()
                        //     ->disk('public')
                        //     ->directory('scholarship-files'),
                        Textarea::make('file_description')
                            ->label('เอกสารที่ต้องใช้')
                            ->nullable()
                            ->rows(3),
                        TextInput::make('academic_year')
                            ->label('ปีการศึกษา')
                            ->nullable()
                            ->numeric(),
                        // TextInput::make('update_by')
                        //     ->label('อัปเดตโดย')
                        //     ->maxLength(255),
                    ])->columns(2),
                Section::make('Settings')
                    ->schema([
                        \Filament\Forms\Components\Toggle::make('isactive')->label('Active'),
                        \Filament\Forms\Components\Toggle::make('require_doc')->label('Required Documents'),
                        \Filament\Forms\Components\Toggle::make('require_app1')->label('Require App 1'),
                        \Filament\Forms\Components\Toggle::make('require_app2')->label('Require App 2'),
                        \Filament\Forms\Components\Toggle::make('can_assign')->label('Can Assign'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('job_code')->label('Job Code')->searchable()->sortable(),
                TextColumn::make('scholarship_name')->label('ชื่อทุน')->searchable()->sortable(),
                // TextColumn::make('name_en')->label('Name (EN)')->searchable(),
                // TextColumn::make('academic_year')->label('ปีการศึกษา')->sortable(),
                TextColumn::make('isactive')->label('Active')->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Active' : 'Inactive')
                    ->color(fn ($state) => $state ? 'success' : 'gray'),
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
