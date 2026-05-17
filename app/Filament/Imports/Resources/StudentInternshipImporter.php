<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\StudentInternship;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class StudentInternshipImporter extends Importer
{
    protected static ?string $model = StudentInternship::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('student_id')
                ->requiredMapping(),
            ImportColumn::make('intern_year')
                ->numeric(),
            ImportColumn::make('company')
                ->requiredMapping(),
            ImportColumn::make('comp_addr'),
            ImportColumn::make('comp_admin'),
            ImportColumn::make('comp_title'),
            ImportColumn::make('comp_tel'),
            ImportColumn::make('flag_comp_status'),
            ImportColumn::make('flag_req_change')
                ->boolean(),
            ImportColumn::make('date_comp_regist'),
            ImportColumn::make('date_comp_book'),
            ImportColumn::make('date_comp_book_rec'),
            ImportColumn::make('date_comp_accept'),
            ImportColumn::make('location_name'),
            ImportColumn::make('location_address'),
            ImportColumn::make('prac_lon')
                ->numeric(),
            ImportColumn::make('prac_lat')
                ->numeric(),
            ImportColumn::make('prac_loc1'),
            ImportColumn::make('prac_loc2'),
            ImportColumn::make('sup_name'),
            ImportColumn::make('sup_position'),
            ImportColumn::make('sup_phone'),
            ImportColumn::make('job_description'),
            ImportColumn::make('start_date'),
            ImportColumn::make('end_date'),
            ImportColumn::make('process_step')
                ->numeric(),
            ImportColumn::make('status'),
            ImportColumn::make('prac_score')
                ->numeric(),
            ImportColumn::make('prac_score_p'),
            ImportColumn::make('prac_datechange_status'),
            ImportColumn::make('blacklist')
                ->boolean(),
            ImportColumn::make('grade'),
            ImportColumn::make('flag_last_reportw'),
            ImportColumn::make('report1_date'),
            ImportColumn::make('report1_score')
                ->numeric(),
            ImportColumn::make('report1_score_p'),
            ImportColumn::make('report2_date'),
            ImportColumn::make('report2_score')
                ->numeric(),
            ImportColumn::make('report2_score_p'),
            ImportColumn::make('report3_date'),
            ImportColumn::make('report3_score')
                ->numeric(),
            ImportColumn::make('report3_score_p'),
            ImportColumn::make('report4_date'),
            ImportColumn::make('report4_score')
                ->numeric(),
            ImportColumn::make('report4_score_p'),
            ImportColumn::make('report5_date'),
            ImportColumn::make('report5_score')
                ->numeric(),
            ImportColumn::make('report5_score_p'),
            ImportColumn::make('reportf_date'),
            ImportColumn::make('reportf_score')
                ->numeric(),
            ImportColumn::make('reportf_score_p'),
            ImportColumn::make('reportf_score_p_date'),
            ImportColumn::make('allowance')
                ->numeric(),
            ImportColumn::make('assess_comp'),
            ImportColumn::make('assess_receive_date'),
            ImportColumn::make('assess_by'),
            ImportColumn::make('assess_type'),
            ImportColumn::make('assess_date'),
            ImportColumn::make('assess_score')
                ->numeric(),
        ];
    }

    public function resolveRecord(): ?StudentInternship
    {
        $companyName = $this->data['company'] ?? null;
        $companyId = null;

        if ($companyName) {
            $company = \App\Models\Resources\Company::firstOrCreate(
                ['name' => $companyName],
                [
                    'address' => $this->data['comp_addr'] ?? null,
                    'admin_name' => $this->data['comp_admin'] ?? null,
                    'admin_title' => $this->data['comp_title'] ?? null,
                    'tel' => $this->data['comp_tel'] ?? null,
                ]
            );
            $companyId = $company->id;
        }

        $internship = StudentInternship::firstOrNew([
            'student_id' => $this->data['student_id'],
            'company_id' => $companyId,
            'start_date' => $this->data['start_date'] ?? null,
        ]);

        return $internship;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your student internship import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
