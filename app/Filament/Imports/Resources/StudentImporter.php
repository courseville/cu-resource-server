<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\Student;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class StudentImporter extends Importer
{
    protected static ?string $model = Student::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('student_id')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('title_th')
                ->rules(['max:255']),
            ImportColumn::make('first_name_th')
                ->rules(['max:255']),
            ImportColumn::make('last_name_th')
                ->rules(['max:255']),
            ImportColumn::make('title_en')
                ->rules(['max:255']),
            ImportColumn::make('first_name_en')
                ->rules(['max:255']),
            ImportColumn::make('last_name_en')
                ->rules(['max:255']),
            ImportColumn::make('national_id')
                ->rules(['required', 'min:13', 'max:13']),
            ImportColumn::make('birth'),
            ImportColumn::make('image'),
            ImportColumn::make('nationality')
                ->rules(['max:255']),
            ImportColumn::make('religion')
                ->rules(['max:255']),
            ImportColumn::make('blood')
                ->rules(['max:255']),
            ImportColumn::make('phone')
                ->rules(['max:255']),
            ImportColumn::make('email')
                ->rules(['email', 'max:255']),
            ImportColumn::make('current_address'),
            ImportColumn::make('current_district')
                ->rules(['max:255']),
            ImportColumn::make('current_province')
                ->rules(['max:255']),
            ImportColumn::make('current_zip_code')
                ->rules(['max:255']),
            ImportColumn::make('current_latitude')
                ->numeric(),
            ImportColumn::make('current_longitude')
                ->numeric(),
            ImportColumn::make('hometown_address'),
            ImportColumn::make('hometown_district')
                ->rules(['max:255']),
            ImportColumn::make('hometown_province')
                ->rules(['max:255']),
            ImportColumn::make('hometown_zip_code')
                ->rules(['max:255']),
            ImportColumn::make('hometown_latitude')
                ->numeric(),
            ImportColumn::make('hometown_longitude')
                ->numeric(),
            ImportColumn::make('father_first_name')
                ->rules(['max:255']),
            ImportColumn::make('father_last_name')
                ->rules(['max:255']),
            ImportColumn::make('father_birth_year')
                ->numeric(),
            ImportColumn::make('father_status')
                ->rules(['max:255']),
            ImportColumn::make('mother_first_name')
                ->rules(['max:255']),
            ImportColumn::make('mother_last_name')
                ->rules(['max:255']),
            ImportColumn::make('mother_birth_year')
                ->numeric(),
            ImportColumn::make('mother_status')
                ->rules(['max:255']),
            ImportColumn::make('parent_relationship')
                ->rules(['max:255']),
            ImportColumn::make('parent_phone')
                ->rules(['max:255']),
            ImportColumn::make('sibling_total')
                ->numeric(),
            ImportColumn::make('sibling_order')
                ->numeric(),
            ImportColumn::make('parent_address'),
            ImportColumn::make('parent_district')
                ->rules(['max:255']),
            ImportColumn::make('parent_province')
                ->rules(['max:255']),
            ImportColumn::make('parent_zip_code')
                ->rules(['max:255']),
            ImportColumn::make('parent_latitude')
                ->numeric(),
            ImportColumn::make('parent_longitude')
                ->numeric(),
            ImportColumn::make('faccode')
                ->rules(['max:255']),
            ImportColumn::make('depcode')
                ->rules(['max:255']),
            ImportColumn::make('course_code_no')
                ->rules(['max:255']),
            ImportColumn::make('faculty_group')
                ->rules(['max:255']),
            ImportColumn::make('major_code')
                ->rules(['max:255']),
            ImportColumn::make('program_code')
                ->rules(['max:255']),
            ImportColumn::make('study_program_system')
                ->rules(['max:255']),
            ImportColumn::make('project_code')
                ->rules(['max:255']),
            ImportColumn::make('start_acad_year')
                ->rules(['max:255']),
            ImportColumn::make('start_semester')
                ->rules(['max:255']),
            ImportColumn::make('max_period')
                ->numeric(),
            ImportColumn::make('min_period')
                ->numeric(),
            ImportColumn::make('credit_tot')
                ->numeric(),
            ImportColumn::make('fac_name')
                ->rules(['max:255']),
            ImportColumn::make('dep_name')
                ->rules(['max:255']),
            ImportColumn::make('major_name')
                ->rules(['max:255']),
            ImportColumn::make('fac_name_eng')
                ->rules(['max:255']),
            ImportColumn::make('dep_name_eng')
                ->rules(['max:255']),
            ImportColumn::make('major_name_eng')
                ->rules(['max:255']),
            ImportColumn::make('full_name_th')
                ->rules(['max:255']),
            ImportColumn::make('full_name_en')
                ->rules(['max:255']),
            ImportColumn::make('data_id'),
        ];
    }

    public function resolveRecord(): Student
    {
        return Student::firstOrNew([
            'student_id' => $this->data['student_id'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your student import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
