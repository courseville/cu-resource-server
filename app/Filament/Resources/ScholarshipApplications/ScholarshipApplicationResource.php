<?php

namespace App\Filament\Resources\ScholarshipApplications;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Exports\Resources\ScholarshipApplicationExporter;
use App\Filament\Resources\ScholarshipApplications\Pages\CreateScholarshipApplication;
use App\Filament\Resources\ScholarshipApplications\Pages\EditScholarshipApplication;
use App\Filament\Resources\ScholarshipApplications\Pages\ListScholarshipApplications;
use App\Filament\Resources\ScholarshipApplicationResource\Pages;
use App\Models\Resources\ScholarshipApplication;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ScholarshipApplicationResource extends Resource
{
    protected static ?string $model = ScholarshipApplication::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Student Affair';

    protected static ?string $navigationLabel = 'Scholarship Applications';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Scholarship Applications';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Information')
                    ->schema([
                        Select::make('student_id')
                            ->label('Student')
                            ->relationship('student', 'student_id')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull(),
                        Select::make('scholarship_id')
                            ->label('Scholarship')
                            ->relationship('scholarship', 'scholarship_name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull(),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('gpa')
                                    ->label('GPA')
                                    ->numeric()
                                    ->inputMode('decimal')
                                    ->step(0.01)
                                    ->minValue(0.00)
                                    ->maxValue(4.00)
                                    ->nullable(),
                                TextInput::make('gpax')
                                    ->label('GPAX')
                                    ->numeric()
                                    ->inputMode('decimal')
                                    ->step(0.01)
                                    ->minValue(0.00)
                                    ->maxValue(4.00)
                                    ->nullable(),
                                TextInput::make('phone_brand_model')
                                    ->label('Phone Brand and Model')
                                    ->nullable(),
                                TextInput::make('phone_monthly_cost')
                                    ->label('Phone Monthly Cost')
                                    ->numeric()
                                    ->inputMode('decimal')
                                    ->prefix('฿')
                                    ->nullable(),
                            ]),
                        Textarea::make('reason_for_scholarship')
                            ->label('Reason for Scholarship')
                            ->rows(5)
                            ->nullable()
                            ->columnSpanFull(),
                        Textarea::make('financial_self_support_plan')
                            ->label('Financial Self-Support Plan')
                            ->rows(5)
                            ->nullable()
                            ->columnSpanFull(),
                    ]),
                Section::make('Financial Details')
                    ->schema([
                        TextInput::make('bank_account_number')
                            ->label('Bank Account Number')
                            ->nullable(),
                        TextInput::make('total_family_debt')
                            ->label('Total Family Debt')
                            ->numeric()
                            ->inputMode('decimal')
                            ->prefix('฿')
                            ->nullable(),
                        Textarea::make('debt_details')
                            ->label('Debt Details')
                            ->rows(3)
                            ->nullable()
                            ->columnSpanFull(),
                    ]),
                Section::make('Family Composition')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('sibling_order')
                                    ->label('Sibling Order')
                                    ->nullable(),
                                TextInput::make('family_member_count')
                                    ->label('Total Family Members')
                                    ->nullable(),
                                TextInput::make('number_of_employed_siblings')
                                    ->label('Number of Employed Siblings')
                                    ->nullable(),
                                TextInput::make('guardian_dependent_count')
                                    ->label('Number of Dependents under Guardian')
                                    ->nullable(),
                            ]),
                    ]),
                Section::make('Family Income')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('mother_occupation')
                                    ->label('Mother\'s Occupation')
                                    ->nullable(),
                                TextInput::make('mother_monthly_income')
                                    ->label('Mother\'s Monthly Income')
                                    ->numeric()
                                    ->inputMode('decimal')
                                    ->prefix('฿')
                                    ->nullable(),
                                TextInput::make('father_occupation')
                                    ->label('Father\'s Occupation')
                                    ->nullable(),
                                TextInput::make('father_monthly_income')
                                    ->label('Father\'s Monthly Income')
                                    ->numeric()
                                    ->inputMode('decimal')
                                    ->prefix('฿')
                                    ->nullable(),
                                TextInput::make('guardian_occupation')
                                    ->label('Guardian\'s Occupation')
                                    ->nullable(),
                                TextInput::make('guardian_monthly_income')
                                    ->label('Guardian\'s Monthly Income')
                                    ->numeric()
                                    ->inputMode('decimal')
                                    ->prefix('฿')
                                    ->nullable(),
                            ]),
                    ]),
                Section::make('Housing and Assets')
                    ->schema([
                        Textarea::make('house_description')
                            ->label('House Description')
                            ->rows(3)
                            ->nullable()
                            ->columnSpanFull(),
                        Grid::make(2)
                            ->schema([
                                FileUpload::make('house_and_surroundings_image')
                                    ->label('House and Surroundings Image')
                                    ->image()
                                    ->directory('scholarship-applications/house-images')
                                    ->nullable(),
                                FileUpload::make('house_interior_image')
                                    ->label('House Interior Image')
                                    ->image()
                                    ->directory('scholarship-applications/house-images')
                                    ->nullable(),
                                FileUpload::make('application_document_pdf')
                                    ->label('Application Document (PDF)')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->directory('scholarship-applications/documents')
                                    ->nullable(),
                                FileUpload::make('account_book_pdf')
                                    ->label('Bank Account Book (PDF)')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->directory('scholarship-applications/documents')
                                    ->nullable(),
                            ]),
                        TextInput::make('number_of_cars')
                            ->label('Number of Cars')
                            ->nullable(),
                        Textarea::make('car_description')
                            ->label('Car Description')
                            ->rows(3)
                            ->nullable()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.student_id')
                    ->label('Student ID')
                    ->searchable(),
                TextColumn::make('scholarship.scholarship_name')
                    ->label('Scholarship Name')
                    ->searchable(),
                TextColumn::make('gpa'),
                TextColumn::make('gpax'),
                TextColumn::make('phone_brand_model'),
                TextColumn::make('phone_monthly_cost'),
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
                        ->exporter(ScholarshipApplicationExporter::class),
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
            'index' => ListScholarshipApplications::route('/'),
            'create' => CreateScholarshipApplication::route('/create'),
            'edit' => EditScholarshipApplication::route('/{record}/edit'),
        ];
    }
}
