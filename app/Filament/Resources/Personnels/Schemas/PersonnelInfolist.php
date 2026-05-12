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
                            ->columnSpanFull()
                            ->withSyncMeta(),
                        TextEntry::make('rank_title')
                            ->label('ยศ')
                            ->withSyncMeta(),
                        TextEntry::make('doctoral_title')
                            ->label('คำนำหน้า ดร.')
                            ->withSyncMeta(),
                        TextEntry::make('acad_title_1')
                            ->label('ตำแหน่งวิชาการ 1')
                            ->withSyncMeta(),
                        TextEntry::make('acad_title_2')
                            ->label('ตำแหน่งวิชาการ 2')
                            ->withSyncMeta(),
                        TextEntry::make('title_by_the_king')
                            ->label('ยศ/ฉายาที่ได้รับพระราชทาน')
                            ->withSyncMeta(),
                        TextEntry::make('title_th')
                            ->label('คำนำหน้า')
                            ->withSyncMeta(),
                        TextEntry::make('first_name_th')
                            ->label('ชื่อ')
                            ->withSyncMeta(),
                        TextEntry::make('last_name_th')
                            ->label('นามสกุล')
                            ->withSyncMeta(),
                        TextEntry::make('first_name_en')
                            ->label('ชื่อ (อังกฤษ)')
                            ->withSyncMeta(),
                        TextEntry::make('last_name_en')
                            ->label('นามสกุล (อังกฤษ)')
                            ->withSyncMeta(),
                        TextEntry::make('citizen_id')
                            ->label('เลขบัตรประชาชน')
                            ->withSyncMeta(),
                        TextEntry::make('passport_no')
                            ->label('เลข Passport')
                            ->withSyncMeta(),
                        TextEntry::make('birth_date')
                            ->label('วันเกิด')
                            ->date()
                            ->withSyncMeta(),
                        TextEntry::make('marital_status')
                            ->label('สถานภาพสมรส')
                            ->withSyncMeta(),
                    ])->columns(2),

                Section::make('Personnel Information')
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('personnel_type')
                            ->label('ประเภทบุคลากร')
                            ->withSyncMeta(),
                        TextEntry::make('personnel_status')
                            ->label('สถานภาพบุคลากร')
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                '0' => 'ออกจากบริษัท',
                                '1' => 'ไม่ใช้งาน',
                                '2' => 'พนักงานเกษียณอายุ',
                                '3' => 'พนักงานปกติ',
                                default => $state,
                            })
                            ->withSyncMeta(),
                        TextEntry::make('personnel_type')
                            ->label('สายงาน')
                            ->withSyncMeta(),
                        TextEntry::make('personnel_subgroup')
                            ->label('ระดับตำแหน่ง')
                            ->withSyncMeta(),
                        TextEntry::make('position_name')
                            ->label('ตำแหน่งตามสายงาน')
                            ->withSyncMeta(),
                        TextEntry::make('position_number')
                            ->label('อัตราเลขที่')
                            ->withSyncMeta(),
                        TextEntry::make('start_date')
                            ->label('วันที่เริ่มปฏิบัติงาน')
                            ->date()
                            ->withSyncMeta(),
                        TextEntry::make('structure_level1_name')
                            ->label('หน่วยงานระดับ 1')
                            ->withSyncMeta(),
                        TextEntry::make('structure_level2_name')
                            ->label('หน่วยงานระดับ 2')
                            ->withSyncMeta(),
                        TextEntry::make('structure_level3_name')
                            ->label('หน่วยงานระดับ 3')
                            ->withSyncMeta(),
                        TextEntry::make('structure_level4_name')
                            ->label('หน่วยงานระดับ 4')
                            ->withSyncMeta(),
                    ])->columns(2),

                Section::make('Contact Information')
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('public_email')
                            ->label('อีเมล')
                            ->withSyncMeta(),
                        TextEntry::make('phone_no')
                            ->label('เบอร์ติดต่อ')
                            ->withSyncMeta(),
                        TextEntry::make('room')
                            ->label('ห้องทำงาน')
                            ->withSyncMeta(),
                        TextEntry::make('floor')
                            ->label('ชั้น')
                            ->withSyncMeta(),
                        TextEntry::make('building')
                            ->label('อาคาร')
                            ->withSyncMeta(),
                    ])->columns(2),
            ]);
    }
}
