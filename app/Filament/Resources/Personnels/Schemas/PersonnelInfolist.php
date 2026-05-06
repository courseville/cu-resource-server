<?php

namespace App\Filament\Resources\Personnels\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PersonnelInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profile')
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('personnel_id')
                            ->label('Personnel ID')
                            ->columnSpanFull(),
                        TextEntry::make('rank_title')
                            ->label('ยศ'),
                        TextEntry::make('doctoral_title')
                            ->label('คำนำหน้า ดร.'),
                        TextEntry::make('acad_title_1')
                            ->label('ตำแหน่งวิชาการ 1'),
                        TextEntry::make('acad_title_2')
                            ->label('ตำแหน่งวิชาการ 2'),
                        TextEntry::make('title_by_the_king')
                            ->label('ยศ/ฉายาที่ได้รับพระราชทาน'),
                        TextEntry::make('title_th')
                            ->label('คำนำหน้า'),
                        TextEntry::make('first_name_th')
                            ->label('ชื่อ'),
                        TextEntry::make('last_name_th')
                            ->label('นามสกุล'),
                        TextEntry::make('first_name_en')
                            ->label('ชื่อ (อังกฤษ)'),
                        TextEntry::make('last_name_en')
                            ->label('นามสกุล (อังกฤษ)'),
                        TextEntry::make('citizen_id')
                            ->label('เลขบัตรประชาชน'),
                        TextEntry::make('passport_no')
                            ->label('เลข Passport'),
                        TextEntry::make('birth_date')
                            ->label('วันเกิด')
                            ->date(),
                        TextEntry::make('marital_status')
                            ->label('สถานภาพสมรส'),
                    ])->columns(2),

                Section::make('Personnel Information')
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('personnel_type')
                            ->label('ประเภทบุคลากร'),
                        TextEntry::make('personnel_status')
                            ->label('สถานภาพบุคลากร')
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                '0' => 'ออกจากบริษัท',
                                '1' => 'ไม่ใช้งาน',
                                '2' => 'พนักงานเกษียณอายุ',
                                '3' => 'พนักงานปกติ',
                                default => $state,
                            }),
                        TextEntry::make('personnel_type')
                            ->label('สายงาน'),
                        TextEntry::make('personnel_subgroup')
                            ->label('ระดับตำแหน่ง'),
                        TextEntry::make('position_name')
                            ->label('ตำแหน่งตามสายงาน'),
                        TextEntry::make('position_number')
                            ->label('อัตราเลขที่'),
                        TextEntry::make('start_date')
                            ->label('วันที่เริ่มปฏิบัติงาน')
                            ->date(),
                        TextEntry::make('structure_level1_name')
                            ->label('หน่วยงานระดับ 1'),
                        TextEntry::make('structure_level2_name')
                            ->label('หน่วยงานระดับ 2'),
                        TextEntry::make('structure_level3_name')
                            ->label('หน่วยงานระดับ 3'),
                        TextEntry::make('structure_level4_name')
                            ->label('หน่วยงานระดับ 4'),
                    ])->columns(2),

                Section::make('Contact Information')
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('public_email')
                            ->label('อีเมล'),
                        TextEntry::make('phone_no')
                            ->label('เบอร์ติดต่อ'),
                        TextEntry::make('room')
                            ->label('ห้องทำงาน'),
                        TextEntry::make('floor')
                            ->label('ชั้น'),
                        TextEntry::make('building')
                            ->label('อาคาร'),
                    ])->columns(2),
            ]);
    }
}
