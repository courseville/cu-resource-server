<?php

namespace App\Filament\Resources\StudentInternships\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentInternshipForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Information')
                    ->columnSpanFull()
                    ->schema([
                        Select::make('student_id')
                            ->label('Student')
                            ->relationship('student', 'student_id')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('intern_year')
                            ->label('Intern Year')
                            ->numeric(),
                    ])->columns(2),

                Section::make('Company')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('company')
                            ->label('Company Name')
                            ->maxLength(255),
                        TextInput::make('comp_addr')
                            ->label('Company Address')
                            ->maxLength(255),
                        TextInput::make('comp_admin')
                            ->label('Company Admin')
                            ->maxLength(255),
                        TextInput::make('comp_title')
                            ->label('Admin Title')
                            ->maxLength(255),
                        TextInput::make('comp_tel')
                            ->label('Company Tel')
                            ->maxLength(255),
                        Select::make('flag_comp_status')
                            ->label('Company Status')
                            ->options([
                                'accept' => 'Accepted',
                                'pending' => 'Pending',
                                'reject' => 'Rejected',
                            ]),
                        Toggle::make('flag_req_change')
                            ->label('Requested Change'),
                        Grid::make(2)->schema([
                            DateTimePicker::make('date_comp_regist')->label('Company Registered Date'),
                            DateTimePicker::make('date_comp_book')->label('Booking Date'),
                            DateTimePicker::make('date_comp_book_rec')->label('Booking Received Date'),
                            DateTimePicker::make('date_comp_accept')->label('Company Accept Date'),
                        ]),
                    ])->columns(2),

                Section::make('Practice Details')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('location_name')
                            ->label('Practice Place')
                            ->maxLength(255),
                        TextInput::make('location_address')
                            ->label('Practice Address')
                            ->maxLength(255),
                        Grid::make(2)->schema([
                            TextInput::make('prac_lon')->label('Longitude')->numeric(),
                            TextInput::make('prac_lat')->label('Latitude')->numeric(),
                            TextInput::make('prac_loc1')->label('Location 1'),
                            TextInput::make('prac_loc2')->label('Location 2'),
                        ]),
                        TextInput::make('sup_name')
                            ->label('Supervisor Name')
                            ->maxLength(255),
                        TextInput::make('sup_position')
                            ->label('Supervisor Title')
                            ->maxLength(255),
                        TextInput::make('sup_phone')
                            ->label('Supervisor Tel')
                            ->tel()
                            ->maxLength(255),
                        Textarea::make('job_description')
                            ->rows(3)
                            ->columnSpanFull(),
                        Grid::make(2)->schema([
                            DatePicker::make('start_date'),
                            DatePicker::make('end_date'),
                        ]),
                    ])->columns(2),

                Section::make('Status & Score')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('process_step')->numeric(),
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'finish' => 'Finish',
                                'cancel' => 'Cancel',
                            ]),
                        TextInput::make('prac_score')->label('Practice Score')->numeric(),
                        TextInput::make('prac_score_p')->label('Score By'),
                        TextInput::make('prac_datechange_status')->label('Date Change Status'),
                        Toggle::make('blacklist')->label('Blacklisted'),
                        TextInput::make('grade')->label('Grade'),
                        TextInput::make('flag_last_reportw')->label('Last Report Flag'),
                    ])->columns(2),

                Section::make('Progress Reports')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(3)->schema([
                            DateTimePicker::make('report1_date')->label('Report 1 Date'),
                            TextInput::make('report1_score')->label('Score')->numeric(),
                            TextInput::make('report1_score_p')->label('By'),
                        ]),
                        Grid::make(3)->schema([
                            DateTimePicker::make('report2_date')->label('Report 2 Date'),
                            TextInput::make('report2_score')->label('Score')->numeric(),
                            TextInput::make('report2_score_p')->label('By'),
                        ]),
                        Grid::make(3)->schema([
                            DateTimePicker::make('report3_date')->label('Report 3 Date'),
                            TextInput::make('report3_score')->label('Score')->numeric(),
                            TextInput::make('report3_score_p')->label('By'),
                        ]),
                        Grid::make(3)->schema([
                            DateTimePicker::make('report4_date')->label('Report 4 Date'),
                            TextInput::make('report4_score')->label('Score')->numeric(),
                            TextInput::make('report4_score_p')->label('By'),
                        ]),
                        Grid::make(3)->schema([
                            DateTimePicker::make('report5_date')->label('Report 5 Date'),
                            TextInput::make('report5_score')->label('Score')->numeric(),
                            TextInput::make('report5_score_p')->label('By'),
                        ]),
                        Grid::make(4)->schema([
                            DateTimePicker::make('reportf_date')->label('Final Report Date'),
                            TextInput::make('reportf_score')->label('Score')->numeric(),
                            TextInput::make('reportf_score_p')->label('By'),
                            DateTimePicker::make('reportf_score_p_date')->label('Score Date'),
                        ]),
                    ]),

                Section::make('Assessment')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('allowance')->label('Allowance')->numeric()->prefix('฿'),
                        TextInput::make('assess_comp')->label('Assessment Company'),
                        DateTimePicker::make('assess_receive_date')->label('Assessment Received'),
                        TextInput::make('assess_by')->label('Assessed By'),
                        TextInput::make('assess_type')->label('Assessment Type'),
                        DateTimePicker::make('assess_date')->label('Assessment Date'),
                        TextInput::make('assess_score')->label('Assessment Score')->numeric(),
                    ])->columns(2),

                // Section::make('Files')
                //     ->columnSpanFull()
                //     ->schema([
                //         FileUpload::make('file')
                //             ->directory('internship-files'),
                //         FileUpload::make('address_pic')
                //             ->label('Address Picture')
                //             ->image()
                //             ->directory('internship-address-pics'),
                //     ])->columns(2),
            ]);
    }
}
