<?php

namespace App\Filament\Resources\StudentInternships\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentInternshipInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Information')
                    ->schema([
                        TextEntry::make('student.student_id')->label('Student ID'),
                        TextEntry::make('intern_year')->label('Intern Year'),
                    ])->columns(2),

                Section::make('Company')
                    ->schema([
                        TextEntry::make('company')->label('Company Name'),
                        TextEntry::make('comp_addr')->label('Company Address'),
                        TextEntry::make('comp_admin')->label('Company Admin'),
                        TextEntry::make('comp_title')->label('Admin Title'),
                        TextEntry::make('comp_tel')->label('Company Tel'),
                        TextEntry::make('flag_comp_status')->label('Company Status')->badge()
                            ->color(fn ($state) => match ($state) {
                                'accept' => 'success',
                                'reject' => 'danger',
                                default => 'warning',
                            }),
                        TextEntry::make('date_comp_regist')->label('Registered Date')->dateTime(),
                        TextEntry::make('date_comp_accept')->label('Accept Date')->dateTime(),
                    ])->columns(2),

                Section::make('Practice Details')
                    ->schema([
                        TextEntry::make('location_name')->label('Practice Place'),
                        TextEntry::make('location_address')->label('Practice Address'),
                        Grid::make(4)->schema([
                            TextEntry::make('prac_lon')->label('Longitude'),
                            TextEntry::make('prac_lat')->label('Latitude'),
                            TextEntry::make('prac_loc1')->label('Location 1'),
                            TextEntry::make('prac_loc2')->label('Location 2'),
                        ]),
                        TextEntry::make('sup_name')->label('Supervisor'),
                        TextEntry::make('sup_position')->label('Supervisor Title'),
                        TextEntry::make('sup_phone')->label('Supervisor Tel'),
                        TextEntry::make('job_description')->label('Job Description')->columnSpanFull(),
                        TextEntry::make('start_date')->date(),
                        TextEntry::make('end_date')->date(),
                    ])->columns(2),

                Section::make('Status & Score')
                    ->schema([
                        TextEntry::make('status')->badge()
                            ->color(fn ($state) => match ($state) {
                                'finish' => 'success',
                                'cancel' => 'danger',
                                default => 'warning',
                            }),
                        TextEntry::make('process_step')->label('Process Step'),
                        TextEntry::make('prac_score')->label('Practice Score'),
                        TextEntry::make('grade'),
                        TextEntry::make('blacklist')->label('Blacklisted')->badge()
                            ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No')
                            ->color(fn ($state) => $state ? 'danger' : 'success'),
                    ])->columns(3),

                Section::make('Progress Reports')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('report1_date')->label('Report 1')->dateTime(),
                            TextEntry::make('report1_score')->label('Score'),
                            TextEntry::make('report1_score_p')->label('By'),
                        ]),
                        Grid::make(3)->schema([
                            TextEntry::make('report2_date')->label('Report 2')->dateTime(),
                            TextEntry::make('report2_score')->label('Score'),
                            TextEntry::make('report2_score_p')->label('By'),
                        ]),
                        Grid::make(3)->schema([
                            TextEntry::make('report3_date')->label('Report 3')->dateTime(),
                            TextEntry::make('report3_score')->label('Score'),
                            TextEntry::make('report3_score_p')->label('By'),
                        ]),
                        Grid::make(3)->schema([
                            TextEntry::make('report4_date')->label('Report 4')->dateTime(),
                            TextEntry::make('report4_score')->label('Score'),
                            TextEntry::make('report4_score_p')->label('By'),
                        ]),
                        Grid::make(3)->schema([
                            TextEntry::make('report5_date')->label('Report 5')->dateTime(),
                            TextEntry::make('report5_score')->label('Score'),
                            TextEntry::make('report5_score_p')->label('By'),
                        ]),
                        Grid::make(4)->schema([
                            TextEntry::make('reportf_date')->label('Final Report')->dateTime(),
                            TextEntry::make('reportf_score')->label('Score'),
                            TextEntry::make('reportf_score_p')->label('By'),
                            TextEntry::make('reportf_score_p_date')->label('Score Date')->dateTime(),
                        ]),
                    ]),

                Section::make('Assessment')
                    ->schema([
                        TextEntry::make('allowance')->label('Allowance')->money('THB'),
                        TextEntry::make('assess_comp')->label('Assessment Company'),
                        TextEntry::make('assess_by')->label('Assessed By'),
                        TextEntry::make('assess_type')->label('Type'),
                        TextEntry::make('assess_date')->label('Assessment Date')->dateTime(),
                        TextEntry::make('assess_score')->label('Score'),
                    ])->columns(3),

                Section::make('Files')
                    ->schema([
                        ImageEntry::make('address_pic')->label('Address Picture'),
                    ]),
            ]);
    }
}
