<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\ScholarshipApplication;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class ScholarshipApplicationImporter extends Importer
{
    protected static ?string $model = ScholarshipApplication::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('student_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('scholarship_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('gpa')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('gpax')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('phone_brand_model')
                ->rules(['max:255']),
            ImportColumn::make('phone_monthly_cost')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('reason_for_scholarship'),
            ImportColumn::make('financial_self_support_plan'),
            ImportColumn::make('bank_account_number')
                ->rules(['max:255']),
            ImportColumn::make('account_book_pdf'),
            ImportColumn::make('application_document_pdf'),
            ImportColumn::make('total_family_debt')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('debt_details'),
            ImportColumn::make('house_description'),
            ImportColumn::make('house_and_surroundings_image'),
            ImportColumn::make('house_interior_image'),
            ImportColumn::make('number_of_cars')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('car_description'),
            ImportColumn::make('sibling_order')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('family_member_count')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('number_of_employed_siblings')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('guardian_dependent_count')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('mother_occupation')
                ->rules(['max:255']),
            ImportColumn::make('mother_monthly_income')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('father_occupation')
                ->rules(['max:255']),
            ImportColumn::make('father_monthly_income')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('guardian_occupation')
                ->rules(['max:255']),
            ImportColumn::make('guardian_monthly_income')
                ->numeric()
                ->rules(['integer']),
        ];
    }

    public function resolveRecord(): ScholarshipApplication
    {
        return new ScholarshipApplication;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your scholarship application import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
