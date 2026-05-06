<?php

namespace App\Filament\Exports;

use App\Models\Resources\StudentInternship;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class StudentInternshipExporter extends Exporter
{
    protected static ?string $model = StudentInternship::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('student_id'),
            ExportColumn::make('intern_year'),
            ExportColumn::make('company')->label('Company Name'),
            ExportColumn::make('comp_addr')->label('Company Address'),
            ExportColumn::make('comp_admin')->label('Company Admin'),
            ExportColumn::make('comp_title')->label('Admin Title'),
            ExportColumn::make('comp_tel')->label('Company Tel'),
            ExportColumn::make('flag_comp_status')->label('Company Status'),
            ExportColumn::make('flag_req_change')->label('Requested Change'),
            ExportColumn::make('date_comp_regist')->label('Company Registered Date'),
            ExportColumn::make('date_comp_book')->label('Booking Date'),
            ExportColumn::make('date_comp_book_rec')->label('Booking Received Date'),
            ExportColumn::make('date_comp_accept')->label('Company Accept Date'),
            ExportColumn::make('location_name')->label('Practice Place'),
            ExportColumn::make('location_address')->label('Practice Address'),
            ExportColumn::make('prac_lon')->label('Longitude'),
            ExportColumn::make('prac_lat')->label('Latitude'),
            ExportColumn::make('prac_loc1')->label('Location 1'),
            ExportColumn::make('prac_loc2')->label('Location 2'),
            ExportColumn::make('sup_name')->label('Supervisor Name'),
            ExportColumn::make('sup_position')->label('Supervisor Title'),
            ExportColumn::make('sup_phone')->label('Supervisor Tel'),
            ExportColumn::make('job_description')->label('Job Description'),
            ExportColumn::make('start_date'),
            ExportColumn::make('end_date'),
            ExportColumn::make('process_step'),
            ExportColumn::make('status'),
            ExportColumn::make('prac_score')->label('Practice Score'),
            ExportColumn::make('prac_score_p')->label('Score By'),
            ExportColumn::make('prac_datechange_status')->label('Date Change Status'),
            ExportColumn::make('blacklist')->label('Blacklisted'),
            ExportColumn::make('grade'),
            ExportColumn::make('flag_last_reportw')->label('Last Report Flag'),
            ExportColumn::make('report1_date')->label('Report 1 Date'),
            ExportColumn::make('report1_score')->label('Report 1 Score'),
            ExportColumn::make('report1_score_p')->label('Report 1 By'),
            ExportColumn::make('report2_date')->label('Report 2 Date'),
            ExportColumn::make('report2_score')->label('Report 2 Score'),
            ExportColumn::make('report2_score_p')->label('Report 2 By'),
            ExportColumn::make('report3_date')->label('Report 3 Date'),
            ExportColumn::make('report3_score')->label('Report 3 Score'),
            ExportColumn::make('report3_score_p')->label('Report 3 By'),
            ExportColumn::make('report4_date')->label('Report 4 Date'),
            ExportColumn::make('report4_score')->label('Report 4 Score'),
            ExportColumn::make('report4_score_p')->label('Report 4 By'),
            ExportColumn::make('report5_date')->label('Report 5 Date'),
            ExportColumn::make('report5_score')->label('Report 5 Score'),
            ExportColumn::make('report5_score_p')->label('Report 5 By'),
            ExportColumn::make('reportf_date')->label('Final Report Date'),
            ExportColumn::make('reportf_score')->label('Final Report Score'),
            ExportColumn::make('reportf_score_p')->label('Final Report By'),
            ExportColumn::make('reportf_score_p_date')->label('Final Report Score Date'),
            ExportColumn::make('allowance'),
            ExportColumn::make('assess_comp')->label('Assessment Company'),
            ExportColumn::make('assess_receive_date')->label('Assessment Received'),
            ExportColumn::make('assess_by')->label('Assessed By'),
            ExportColumn::make('assess_type')->label('Assessment Type'),
            ExportColumn::make('assess_date')->label('Assessment Date'),
            ExportColumn::make('assess_score')->label('Assessment Score'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your student internship export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
