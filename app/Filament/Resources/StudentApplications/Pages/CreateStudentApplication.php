<?php

namespace App\Filament\Resources\StudentApplications\Pages;

use App\Filament\Resources\StudentApplications\StudentApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStudentApplication extends CreateRecord
{
    protected static string $resource = StudentApplicationResource::class;
}
