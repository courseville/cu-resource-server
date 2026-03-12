<?php

namespace App\Filament\Exports\Resources;

use App\Models\Resources\ScholarshipApplication;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ScholarshipApplicationExporter extends Exporter
{
    protected static ?string $model = ScholarshipApplication::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('student_id'),
            ExportColumn::make('scholarship_id'),
            ExportColumn::make('gpa'),
            ExportColumn::make('gpax'),
            ExportColumn::make('phone_brand_model'),
            ExportColumn::make('phone_monthly_cost'),
            ExportColumn::make('reason_for_scholarship'),
            ExportColumn::make('financial_self_support_plan'),
            ExportColumn::make('bank_account_number'),
            ExportColumn::make('account_book_pdf'),
            ExportColumn::make('application_document_pdf'),
            ExportColumn::make('total_family_debt'),
            ExportColumn::make('debt_details'),
            ExportColumn::make('house_description'),
            ExportColumn::make('house_and_surroundings_image'),
            ExportColumn::make('house_interior_image'),
            ExportColumn::make('number_of_cars'),
            ExportColumn::make('car_description'),
            ExportColumn::make('sibling_order'),
            ExportColumn::make('family_member_count'),
            ExportColumn::make('number_of_employed_siblings'),
            ExportColumn::make('guardian_dependent_count'),
            ExportColumn::make('mother_occupation'),
            ExportColumn::make('mother_monthly_income'),
            ExportColumn::make('father_occupation'),
            ExportColumn::make('father_monthly_income'),
            ExportColumn::make('guardian_occupation'),
            ExportColumn::make('guardian_monthly_income'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your scholarship application export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
