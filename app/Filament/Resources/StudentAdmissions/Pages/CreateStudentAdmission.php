<?php

namespace App\Filament\Resources\StudentAdmissions\Pages;

use App\Filament\Resources\StudentAdmissions\StudentAdmissionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStudentAdmission extends CreateRecord
{
    protected static string $resource = StudentAdmissionResource::class;
}
