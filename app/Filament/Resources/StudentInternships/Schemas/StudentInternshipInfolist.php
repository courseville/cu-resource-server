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
                        TextEntry::make('student.student_id')->label('Student ID')->withSyncMeta(),
                        TextEntry::make('intern_year')->label('Intern Year')->withSyncMeta(),
                    ])->columns(2),

                Section::make('Company')
                    ->schema([
                        TextEntry::make('company')->label('Company Name')->withSyncMeta(),
                        TextEntry::make('comp_addr')->label('Company Address')->withSyncMeta(),
                        TextEntry::make('comp_admin')->label('Company Admin')->withSyncMeta(),
                        TextEntry::make('comp_title')->label('Admin Title')->withSyncMeta(),
                        TextEntry::make('comp_tel')->label('Company Tel')->withSyncMeta(),
                        TextEntry::make('flag_comp_status')->label('Company Status')->badge()
                            ->color(fn ($state) => match ($state) {
                                'accept' => 'success',
                                'reject' => 'danger',
                                default => 'warning',
                            })
                            ->withSyncMeta(),
                        TextEntry::make('date_comp_regist')->label('Registered Date')->dateTime()->withSyncMeta(),
                        TextEntry::make('date_comp_accept')->label('Accept Date')->dateTime()->withSyncMeta(),
                    ])->columns(2),

                Section::make('Practice Details')
                    ->schema([
                        TextEntry::make('location_name')->label('Practice Place')->withSyncMeta(),
                        TextEntry::make('location_address')->label('Practice Address')->withSyncMeta(),
                        Grid::make(4)->schema([
                            TextEntry::make('prac_lon')->label('Longitude')->withSyncMeta(),
                            TextEntry::make('prac_lat')->label('Latitude')->withSyncMeta(),
                            TextEntry::make('prac_loc1')->label('Location 1')->withSyncMeta(),
                            TextEntry::make('prac_loc2')->label('Location 2')->withSyncMeta(),
                        ]),
                        TextEntry::make('sup_name')->label('Supervisor')->withSyncMeta(),
                        TextEntry::make('sup_position')->label('Supervisor Title')->withSyncMeta(),
                        TextEntry::make('sup_phone')->label('Supervisor Tel')->withSyncMeta(),
                        TextEntry::make('job_description')->label('Job Description')->columnSpanFull()->withSyncMeta(),
                        TextEntry::make('start_date')->date()->withSyncMeta(),
                        TextEntry::make('end_date')->date()->withSyncMeta(),
                    ])->columns(2),

                Section::make('Status & Score')
                    ->schema([
                        TextEntry::make('status')->badge()
                            ->color(fn ($state) => match ($state) {
                                'finish' => 'success',
                                'cancel' => 'danger',
                                default => 'warning',
                            })
                            ->withSyncMeta(),
                        TextEntry::make('process_step')->label('Process Step')->withSyncMeta(),
                        TextEntry::make('prac_score')->label('Practice Score')->withSyncMeta(),
                        TextEntry::make('grade')->withSyncMeta(),
                        TextEntry::make('blacklist')->label('Blacklisted')->badge()
                            ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No')
                            ->color(fn ($state) => $state ? 'danger' : 'success')
                            ->withSyncMeta(),
                    ])->columns(3),

                Section::make('Progress Reports')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('report1_date')->label('Report 1')->dateTime()->withSyncMeta(),
                            TextEntry::make('report1_score')->label('Score')->withSyncMeta(),
                            TextEntry::make('report1_score_p')->label('By')->withSyncMeta(),
                        ]),
                        Grid::make(3)->schema([
                            TextEntry::make('report2_date')->label('Report 2')->dateTime()->withSyncMeta(),
                            TextEntry::make('report2_score')->label('Score')->withSyncMeta(),
                            TextEntry::make('report2_score_p')->label('By')->withSyncMeta(),
                        ]),
                        Grid::make(3)->schema([
                            TextEntry::make('report3_date')->label('Report 3')->dateTime()->withSyncMeta(),
                            TextEntry::make('report3_score')->label('Score')->withSyncMeta(),
                            TextEntry::make('report3_score_p')->label('By')->withSyncMeta(),
                        ]),
                        Grid::make(3)->schema([
                            TextEntry::make('report4_date')->label('Report 4')->dateTime()->withSyncMeta(),
                            TextEntry::make('report4_score')->label('Score')->withSyncMeta(),
                            TextEntry::make('report4_score_p')->label('By')->withSyncMeta(),
                        ]),
                        Grid::make(3)->schema([
                            TextEntry::make('report5_date')->label('Report 5')->dateTime()->withSyncMeta(),
                            TextEntry::make('report5_score')->label('Score')->withSyncMeta(),
                            TextEntry::make('report5_score_p')->label('By')->withSyncMeta(),
                        ]),
                        Grid::make(4)->schema([
                            TextEntry::make('reportf_date')->label('Final Report')->dateTime()->withSyncMeta(),
                            TextEntry::make('reportf_score')->label('Score')->withSyncMeta(),
                            TextEntry::make('reportf_score_p')->label('By')->withSyncMeta(),
                            TextEntry::make('reportf_score_p_date')->label('Score Date')->dateTime()->withSyncMeta(),
                        ]),
                    ]),

                Section::make('Assessment')
                    ->schema([
                        TextEntry::make('allowance')->label('Allowance')->money('THB')->withSyncMeta(),
                        TextEntry::make('assess_comp')->label('Assessment Company')->withSyncMeta(),
                        TextEntry::make('assess_by')->label('Assessed By')->withSyncMeta(),
                        TextEntry::make('assess_type')->label('Type')->withSyncMeta(),
                        TextEntry::make('assess_date')->label('Assessment Date')->dateTime()->withSyncMeta(),
                        TextEntry::make('assess_score')->label('Score')->withSyncMeta(),
                    ])->columns(3),

                Section::make('Files')
                    ->schema([
                        ImageEntry::make('address_pic')->label('Address Picture')->withSyncMeta(),
                    ]),
            ]);
    }
}
