<?php

namespace App\Filament\Resources\Personnels\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PersonnelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profile')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('personnel_id')
                            ->label('Personnel ID')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('rank_title')
                            ->label('ยศ'),
                        TextInput::make('doctoral_title')
                            ->label('คำนำหน้า ดร.'),
                        TextInput::make('acad_title_1')
                            ->label('ตำแหน่งวิชาการ 1'),
                        TextInput::make('acad_title_2')
                            ->label('ตำแหน่งวิชาการ 2'),
                        TextInput::make('title_by_the_king')
                            ->label('ยศ/ฉายาที่ได้รับพระราชทาน'),
                        // TextInput::make('full_title')
                        //     ->label('ชื่อเต็มพร้อมคำนำหน้า'),
                        TextInput::make('title_th')
                            ->label('คำนำหน้า'),
                        TextInput::make('first_name_th')
                            ->label('ชื่อ')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('last_name_th')
                            ->label('นามสกุล')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('first_name_en')
                            ->label('ชื่อ (อังกฤษ)')
                            ->maxLength(255),
                        TextInput::make('last_name_en')
                            ->label('นามสกุล (อังกฤษ)')
                            ->maxLength(255),
                        TextInput::make('citizen_id')
                            ->label('เลขบัตรประชาชน')
                            ->maxLength(255),
                        TextInput::make('passport_no')
                            ->label('เลข Passport')
                            ->maxLength(255),
                        DatePicker::make('birth_date')
                            ->label('วันเกิด'),
                        Select::make('marital_status')
                            ->label('สถานภาพสมรส')
                            ->options([
                                'โสด' => 'โสด',
                                'สมรส' => 'สมรส',
                                'หม้าย' => 'หม้าย',
                                'หย่า' => 'หย่า',
                                'แยก' => 'แยก',
                                'ไม่ระบุ' => 'ไม่ระบุ',
                            ]),
                    ])->columns(2),

                Section::make('Personnel Information')
                    ->columnSpanFull()
                    ->schema([
                        // TextInput::make('department')
                        //     ->label('ภาควิชา/หน่วยงาน'),
                        Select::make('personnel_type')
                            ->label('ประเภทบุคลากร')
                            ->options([
                                'อาจารย์' => 'อาจารย์',
                                'นักวิจัย' => 'นักวิจัย',
                                'นักวิจัยพันธมิตร' => 'นักวิจัยพันธมิตร',
                                'นักวิจัยหลังปริญญาเอก' => 'นักวิจัยหลังปริญญาเอก',
                                'สายปฏิบัติการ' => 'สายปฏิบัติการ',
                            ]),
                        Select::make('personnel_status')
                            ->label('สถานภาพบุคลากร')
                            ->options([
                                '0' => 'ออกจากบริษัท',
                                '1' => 'ไม่ใช้งาน',
                                '2' => 'พนักงานเกษียณอายุ',
                                '3' => 'พนักงานปกติ',
                                // 'ทำงานปกติ' => 'ทำงานปกติ',
                                // 'ลาศึกษาต่อ' => 'ลาศึกษาต่อ',
                                // 'ลาฝึกอบรม' => 'ลาฝึกอบรม',
                                // 'ลาเพิ่มพูนความรู้ทางวิชาการ' => 'ลาเพิ่มพูนความรู้ทางวิชาการ',
                                // 'ย้ายหน่วยงานในจุฬาฯ' => 'ย้ายหน่วยงานในจุฬาฯ',
                                // 'ลาออก' => 'ลาออก',
                                // 'เกษียณอายุ' => 'เกษียณอายุ',
                                // 'เสียชีวิต' => 'เสียชีวิต',
                                // 'สิ้นสุดสัญญา' => 'สิ้นสุดสัญญา',
                                // 'อื่น ๆ' => 'อื่น ๆ',
                            ]),
                        // DatePicker::make('status_change_date')
                        //     ->label('วันที่เปลี่ยนสถานภาพ'),
                        TextInput::make('personnel_type')
                            ->label('สายงาน'),
                        TextInput::make('personnel_subgroup')
                            ->label('ระดับตำแหน่ง'),
                        TextInput::make('position_name')
                            ->label('ตำแหน่งตามสายงาน'),
                        TextInput::make('position_number')
                            ->label('อัตราเลขที่'),
                        // DatePicker::make('position_appointment_date')
                        //     ->label('วันที่ดำรงตำแหน่งตามสายงาน'),
                        DatePicker::make('start_date')
                            ->label('วันที่เริ่มปฏิบัติงาน'),
                        // DatePicker::make('transformation_date')
                        //     ->label('วันที่แปรสภาพเป็นพนักงานมหาวิทยาลัย'),
                        TextInput::make('structure_level1_name')
                            ->label('หน่วยงานระดับ 1'),
                        TextInput::make('structure_level2_name')
                            ->label('หน่วยงานระดับ 2'),
                        TextInput::make('structure_level3_name')
                            ->label('หน่วยงานระดับ 3'),
                        TextInput::make('structure_level4_name')
                            ->label('หน่วยงานระดับ 4'),
                    ])->columns(2),

                Section::make('Contact Information')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('public_email')
                            ->label('อีเมล')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone_no')
                            ->label('เบอร์ติดต่อ')
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('room')
                            ->label('ห้องทำงาน')
                            ->maxLength(255),
                        TextInput::make('floor')
                            ->label('ชั้น')
                            ->maxLength(255),
                        TextInput::make('building')
                            ->label('อาคาร')
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }
}
