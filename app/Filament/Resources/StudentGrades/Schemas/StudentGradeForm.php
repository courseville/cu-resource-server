<?php

namespace App\Filament\Resources\StudentGrades\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StudentGradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('student_code'),
                TextInput::make('year'),
                TextInput::make('semester'),
                TextInput::make('course_code'),
                TextInput::make('total_credit'),
                TextInput::make('grade'),
                TextInput::make('last_update'),
                TextInput::make('faccode'),
                TextInput::make('depcode'),
                TextInput::make('majorcode'),
            ]);
    }
}
