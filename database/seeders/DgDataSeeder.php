<?php

namespace Database\Seeders;

use App\Models\DataSource;
use App\Models\TransformerMapping;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DgDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dgMappings = [
            'DG0201' => [
                'model' => \App\Models\Resources\Student::class,
                'fields' => [
                    'student_id' => 'STUDENTCODE',
                    'course_code_no' => 'COURSECODENO',
                    'faccode' => 'FACCODE',
                    'faculty_group' => 'FACULTYGROUP',
                    'depcode' => 'DEPCODE',
                    'major_code' => 'MAJORCODE',
                    'program_code' => 'PROGRAM',
                    'study_program_system' => 'STUDYPROGRAMSYSTEM',
                    'project_code' => 'PROJECT',
                    'start_acad_year' => 'STARTACADYEAR',
                    'start_semester' => 'STARTSEMESTER',
                    'max_period' => 'MAXPERIOD',
                    'min_period' => 'MINPERIOD',
                    'credit_tot' => 'CREDITTOT',
                    'fac_name' => 'FACNAME',
                    'dep_name' => 'DEPNAME',
                    'major_name' => 'MAJORNAME',
                    'fac_name_eng' => 'FACNAMEENG',
                    'dep_name_eng' => 'DEPNAMEENG',
                    'major_name_eng' => 'MAJORNAMEENG',
                ],
            ],
            'DG0202' => [
                [
                    'model' => \App\Models\Resources\StudentStatusHistory::class,
                    'fields' => [
                        'student_code' => 'STUDENTCODE',
                        'name_thai' => 'NAME_THAI',
                        'name_english' => 'NAME_ENGLISH',
                        'status' => 'STATUS',
                        'effect_date' => 'EFFECTDATE',
                        'from_acad_year' => 'FROMACADYEAR',
                        'from_semester' => 'FROMSEMESTER',
                        'to_acad_year' => 'TOACADYEAR',
                        'to_semester' => 'TOSEMESTER',
                        'instruction_no' => 'INSTRUCTIONNO',
                        'announcement' => 'ANNOUNCEMENT',
                        'faccode' => 'FACCODE',
                        'depcode' => 'DEPCODE',
                        'majorcode' => 'MAJORCODE',
                    ],
                ],
                [
                    'model' => \App\Models\Resources\Student::class,
                    'fields' => [
                        'student_id' => 'STUDENTCODE',
                        'full_name_th' => 'NAME_THAI',
                        'full_name_en' => 'NAME_ENGLISH',
                    ],
                ],
            ],
            'DG0203' => [
                'model' => \App\Models\Resources\StudentCurriculum::class,
                'fields' => [
                    'year' => 'YEAR',
                    'semester' => 'SEMESTER',
                    'student_code' => 'STUDENTCODE',
                    'name_thai' => 'NAME_THAI',
                    'name_english' => 'NAME_ENGLISH',
                    'course_code' => 'COURSECODE',
                    'course_name' => 'COURSE_NAME',
                    'section' => 'SECTION',
                    'grade' => 'GRADE',
                    'credit_tot' => 'CREDIT_TOT',
                    'faccode' => 'FACCODE',
                    'depcode' => 'DEPCODE',
                    'majorcode' => 'MAJORCODE',
                ],
                'pks' => 'year,semester,student_code,course_code,section',
            ],
            'DG0205' => [
                'model' => \App\Models\Resources\StudentGraduation::class,
                'fields' => [
                    'student_code' => 'STUDENTCODE',
                    'acad_year' => 'ACADYEAR',
                    'semester' => 'SEMESTER',
                    'name_thai' => 'NAME_THAI',
                    'name_english' => 'NAME_ENGLISH',
                    'major_thai' => 'MAJOR_THAI',
                    'major_english' => 'MAJOR_ENGLISH',
                    'degree_thai' => 'DEGREE_THAI',
                    'degree_english' => 'DEGREE_ENGLISH',
                    'graduate_date' => 'GRADUATEDATE',
                    'concil_date' => 'CONCILDATE',
                    'distinction' => 'DISTINCTION',
                    'faccode' => 'FACCODE',
                    'depcode' => 'DEPCODE',
                    'majorcode' => 'MAJORCODE',
                ],
            ],
            'DG0206' => [
                'model' => \App\Models\Resources\CourseSchedule::class,
                'fields' => [
                    'year' => 'YEAR',
                    'semester' => 'SEMESTER',
                    'course_code' => 'COURSECODE',
                    'course_name' => 'COURSENAME',
                    'section' => 'SECTION',
                    'row_seq' => 'ROWSEQ',
                    'teach_type' => 'TEACHTYPE',
                    'day1' => 'DAY1',
                    'day2' => 'DAY2',
                    'day3' => 'DAY3',
                    'day4' => 'DAY4',
                    'day5' => 'DAY5',
                    'day6' => 'DAY6',
                    'day7' => 'DAY7',
                    'start_time' => 'STARTTIME',
                    'end_time' => 'ENDTIME',
                    'building' => 'BUILDING',
                    'room' => 'ROOM',
                    'study_program_system' => 'STUDYPROGRAMSYSTEM',
                    'gen_ed_status' => 'GENEDSTATUS',
                    'general_subject' => 'GENERALSUBJECT',
                    'lecture_credit' => 'LECTURECREDIT',
                    'non_lecture_credit' => 'NONLECTURECREDIT',
                    'total_credit' => 'TOTALCREDIT',
                    'real_reg' => 'REALREG',
                    'total_reg' => 'TOTALREG',
                    'remark1' => 'REMARK1',
                    'remark2' => 'REMARK2',
                    'remark3' => 'REMARK3',
                    'faccode' => 'FACCODE',
                ],
                'pks' => 'year,semester,course_code,section,row_seq',
            ],
            'DG0207' => [
                'model' => \App\Models\Resources\Curriculum::class,
                'fields' => [
                    'course_code_no' => 'COURSECODENO',
                    'major_code' => 'MAJORCODE',
                    'degree' => 'DEGREE',
                    'major' => 'MAJOR',
                    'no_year_study' => 'NOYEARSTUDY',
                    'plan1' => 'PLAN1',
                    'language1' => 'LANGUAGE1',
                    'program_system' => 'PROGRAMSYSTEM',
                    'calendar' => 'CALENDAR',
                    'begin_year' => 'BEGINYEAR',
                    'begin_semester' => 'BEGINSEMESTER',
                    'faccode' => 'FACCODE',
                    'depcode' => 'DEPCODE',
                ],
            ],
            'DG0216' => [
                'model' => \App\Models\Resources\CourseInstructor::class,
                'fields' => [
                    'acad_year' => 'ACAD_YEAR',
                    'semester' => 'SEMESTER',
                    'course_code' => 'COURSE_CODE',
                    'row_seq' => 'ROW_SEQ',
                    'section' => 'SECTION',
                    'instructor_no' => 'INSTRUCTOR_NO',
                    'prename_code' => 'PRENAME_CODE',
                    'prename_describe' => 'PRENAME_DESCRIBE',
                    'title_code' => 'TITLE_CODE',
                    'title_describe' => 'TITLE_DESCRIBE',
                    'position' => 'POSITION',
                    'name_thai' => 'NAME_THAI',
                    'surname_thai' => 'SURNAME_THAI',
                    'name_english' => 'NAME_ENGLISH',
                    'surname_english' => 'SURNAME_ENGLISH',
                    'name_abbr' => 'NAME_ABBR',
                    'sex' => 'SEX',
                    'faccode' => 'FACCODE',
                    'depcode' => 'DEPCODE',
                ],
                'pks' => 'acad_year,semester,course_code,section,instructor_no',
            ],
            'DG0204' => [
                'model' => \App\Models\Resources\StudentGrade::class,
                'fields' => [
                    'student_code' => 'STUDENTCODE',
                    'year' => 'YEAR',
                    'semester' => 'SEMESTER',
                    'course_code' => 'COURSECODE',
                    'total_credit' => 'TOTALCREDIT',
                    'grade' => 'GRADE',
                    'last_update' => 'LASTUPDATE',
                    'faccode' => 'FACCODE',
                    'depcode' => 'DEPCODE',
                    'majorcode' => 'MAJORCODE',
                ],
                'pks' => 'student_code,year,semester,course_code',
            ],
            'DG0301' => [
                'model' => \App\Models\Resources\PersonnelAction::class,
                'fields' => [
                    'personnel_id' => 'PERSONNEL_ID',
                    'begin_date' => 'BEGIN_DATE',
                    'end_date' => 'END_DATE',
                    'status_id' => 'STATUS_ID',
                    'status_name' => 'STATUS_NAME',
                    'action_id' => 'ACTION_ID',
                    'action_name' => 'ACTION_NAME',
                    'reason_id' => 'REASON_ID',
                    'reason_name' => 'REASON_NAME',
                    'modify_user' => 'MODIFY_USER',
                ],
                'pks' => 'personnel_id,action_id,begin_date',
            ],
            'DG0303' => [
                'model' => \App\Models\Resources\PersonnelProfile::class,
                'fields' => [
                    'personnel_id' => 'PERSONNEL_ID',
                    'begin_date' => 'BEGIN_DATE',
                    'end_date' => 'END_DATE',
                    'title_id' => 'TITLE_ID',
                    'title_th' => 'TITLE_TH',
                    'name_th' => 'NAME_TH',
                    'surname_th' => 'SURNAME_TH',
                    'gender' => 'GENDER',
                    'birth_date' => 'BIRTH_DATE',
                    'rank_title' => 'RANK_TITLE',
                    'doctoral_title' => 'DOCTORAL_TITLE',
                    'acad_title_1' => 'ACAD_TITLE_1',
                    'acad_title_2' => 'ACAD_TITLE_2',
                    'title_by_the_king' => 'TITLE_BY_THE_KING',
                    'nation' => 'NATION',
                    'marrital_status' => 'MARRITAL_STATUS',
                    'email' => 'EMAIL',
                    'title_en' => 'TITLE_EN',
                    'name_en' => 'NAME_EN',
                    'surname_en' => 'SURNAME_EN',
                    'citizen_id' => 'CITIZEN_ID',
                    'passport_number' => 'PASSPORT_NUMBER',
                    'office_phonenumber' => 'OFFICE_PHONENUMBER',
                    'full_title' => 'FULL_TITLE',
                ],
            ],
            'DG0305' => [
                'model' => \App\Models\Resources\PersonnelContractDetail::class,
                'fields' => [
                    'personnel_id' => 'PERSONNEL_ID',
                    'begin_date' => 'BEGIN_DATE',
                    'end_date' => 'END_DATE',
                    'contract_type_id' => 'CONTRACT_TYPE_ID',
                    'contract_type_name' => 'CONTRACT_TYPE_NAME',
                    'probation' => 'PROBATION',
                    'probation_unit' => 'PROBATION_UNIT',
                    'contract_end_date' => 'CONTRACT_END_DATE',
                    'disemploy_employer' => 'DISEMPLOY_EMPLOYER',
                    'disemploy_employee' => 'DISEMPLOY_EMPLOYEE',
                ],
            ],
            'DG0306' => [
                'model' => \App\Models\Resources\PersonnelEducation::class,
                'fields' => [
                    'personnel_id' => 'PERSONNEL_ID',
                    'begin_date' => 'BEGIN_DATE',
                    'end_date' => 'END_DATE',
                    'education_level_id' => 'EDUCATION_LEVEL_ID',
                    'education_level_name' => 'EDUCATION_LEVEL_NAME',
                    'institution_id' => 'INSTITUTION_ID',
                    'institution_name' => 'INSTITUTION_NAME',
                    'major_id' => 'MAJOR_ID',
                    'major_name' => 'MAJOR_NAME',
                    'degree_id' => 'DEGREE_ID',
                    'degree_name' => 'DEGREE_NAME',
                    'nation_id' => 'NATION_ID',
                    'nation_name_th' => 'NATION_NAME_TH',
                    'distinction_id' => 'DISTINCTION_ID',
                    'distinction_name' => 'DISTINCTION_NAME',
                    'highest_education' => 'HIGHEST_EDUCATION',
                    'highest_education_th' => 'HIGHEST_EDUCATION_TH',
                    'employ_education_id' => 'EMPLOY_EDUCATION_ID',
                    'employ_education_name' => 'EMPLOY_EDUCATION_NAME',
                    'graduate_date' => 'GRADUATE_DATE',
                ],
                'pks' => 'personnel_id,education_level_id,major_id',
            ],
            'DG0307' => [
                'model' => \App\Models\Resources\PersonnelImage::class,
                'fields' => [
                    'personnel_id' => 'PERSONNEL_ID',
                    'citizen_id' => 'CITIZEN_ID',
                    'passport_number' => 'PASSPORT_NUMBER',
                    'image_name' => 'IMAGE_NAME',
                    'begin_date' => 'BEGIN_DATE',
                ],
            ],
            'DG0311' => [
                'model' => \App\Models\Resources\PersonnelPosition::class,
                'fields' => [
                    'personnel_id' => 'PERSONNEL_ID',
                    'begin_date' => 'BEGIN_DATE',
                    'end_date' => 'END_DATE',
                    'positiontype_id' => 'POSITIONTYPE_ID',
                    'positiontype_name' => 'POSITIONTYPE_NAME',
                    'positiontype_text' => 'POSITIONTYPE_TEXT',
                    'fieldstudy' => 'FIELDSTUDY',
                    'subdiscipline_1' => 'SUBDISCIPLINE_1',
                    'subdiscipline_2' => 'SUBDISCIPLINE_2',
                    'subdiscipline_3' => 'SUBDISCIPLINE_3',
                    'subdiscipline_4' => 'SUBDISCIPLINE_4',
                    'subdiscipline_5' => 'SUBDISCIPLINE_5',
                ],
            ],
            'DG0314' => [
                'model' => \App\Models\Resources\PersonnelGeneral::class,
                'fields' => [
                    'personnel_id' => 'PERSONNEL_ID',
                    'begin_date' => 'BEGIN_DATE',
                    'end_date' => 'END_DATE',
                    'status_id' => 'STATUS_ID',
                    'title_th' => 'TITLE_TH',
                    'name_th' => 'NAME_TH',
                    'surname_th' => 'SURNAME_TH',
                    'title_en' => 'TITLE_EN',
                    'name_en' => 'NAME_EN',
                    'surname_en' => 'SURNAME_EN',
                    'email' => 'EMAIL',
                    'nation' => 'NATION',
                    'citizen_id' => 'CITIZEN_ID',
                    'passport_number' => 'PASSPORT_NUMBER',
                    'staff_group' => 'STAFF_GROUP',
                    'personnel_grp_id' => 'PERSONNEL_GRP_ID',
                    'personnel_grp_name' => 'PERSONNEL_GRP_NAME',
                    'personnel_subgrp_name' => 'PERSONNEL_SUBGRP_NAME',
                    'position_name' => 'POSITION_NAME',
                    'position_number' => 'POSITION_NUMBER',
                    'contract_type_id' => 'CONTRACT_TYPE_ID',
                    'contract_type_name' => 'CONTRACT_TYPE_NAME',
                    'contract_end_date' => 'CONTRACT_END_DATE',
                    'btrtl' => 'BTRTL',
                    'btrtl_text' => 'BTRTL_TEXT',
                    'stell' => 'STELL',
                    'stell_text' => 'STELL_TEXT',
                    'ansvh' => 'ANSVH',
                    'ansvh_text' => 'ANSVH_TEXT',
                    'organization_id' => 'ORGANIZATION_ID',
                    'organization_name' => 'ORGANIZATION_NAME',
                    'structure_level1_name' => 'STRUCTURE_LEVEL1_NAME',
                    'structure_level2_name' => 'STRUCTURE_LEVEL2_NAME',
                    'structure_level3_name' => 'STRUCTURE_LEVEL3_NAME',
                    'structure_level4_name' => 'STRUCTURE_LEVEL4_NAME',
                    'employee_name' => 'EMPLOYEE_NAME',
                ],
            ],
            'DG0315' => [
                'model' => \App\Models\Resources\PersonnelRetired::class,
                'fields' => [
                    'personnel_id' => 'PERSONNEL_ID',
                    'begin_date' => 'BEGIN_DATE',
                    'end_date' => 'END_DATE',
                    'status_id' => 'STATUS_ID',
                    'title_th' => 'TITLE_TH',
                    'name_th' => 'NAME_TH',
                    'surname_th' => 'SURNAME_TH',
                    'title_en' => 'TITLE_EN',
                    'name_en' => 'NAME_EN',
                    'surname_en' => 'SURNAME_EN',
                    'email' => 'EMAIL',
                    'nation' => 'NATION',
                    'citizen_id' => 'CITIZEN_ID',
                    'passport_number' => 'PASSPORT_NUMBER',
                    'staff_group' => 'STAFF_GROUP',
                    'personnel_grp_id' => 'PERSONNEL_GRP_ID',
                    'personnel_grp_name' => 'PERSONNEL_GRP_NAME',
                    'personnel_subgrp_name' => 'PERSONNEL_SUBGRP_NAME',
                    'position_name' => 'POSITION_NAME',
                    'position_number' => 'POSITION_NUMBER',
                    'btrtl' => 'BTRTL',
                    'btrtl_text' => 'BTRTL_TEXT',
                    'stell' => 'STELL',
                    'stell_text' => 'STELL_TEXT',
                    'ansvh' => 'ANSVH',
                    'ansvh_text' => 'ANSVH_TEXT',
                    'structure_level1_name' => 'STRUCTURE_LEVEL1_NAME',
                    'structure_level2_name' => 'STRUCTURE_LEVEL2_NAME',
                    'structure_level3_name' => 'STRUCTURE_LEVEL3_NAME',
                    'structure_level4_name' => 'STRUCTURE_LEVEL4_NAME',
                ],
            ],
            'DG0316' => [
                'model' => \App\Models\Resources\PersonnelContractInfo::class,
                'fields' => [
                    'personnel_id' => 'PERSONNEL_ID',
                    'begin_date' => 'BEGIN_DATE',
                    'end_date' => 'END_DATE',
                    'status_id' => 'STATUS_ID',
                    'title_th' => 'TITLE_TH',
                    'name_th' => 'NAME_TH',
                    'surname_th' => 'SURNAME_TH',
                    'title_en' => 'TITLE_EN',
                    'name_en' => 'NAME_EN',
                    'surname_en' => 'SURNAME_EN',
                    'email' => 'EMAIL',
                    'nation' => 'NATION',
                    'citizen_id' => 'CITIZEN_ID',
                    'passport_number' => 'PASSPORT_NUMBER',
                    'staff_group' => 'STAFF_GROUP',
                    'personnel_grp_id' => 'PERSONNEL_GRP_ID',
                    'personnel_grp_name' => 'PERSONNEL_GRP_NAME',
                    'position_name' => 'POSITION_NAME',
                    'position_number' => 'POSITION_NUMBER',
                    'contract_type_id' => 'CONTRACT_TYPE_ID',
                    'contract_type_name' => 'CONTRACT_TYPE_NAME',
                    'contract_end_date' => 'CONTRACT_END_DATE',
                    'btrtl' => 'BTRTL',
                    'btrtl_text' => 'BTRTL_TEXT',
                    'stell' => 'STELL',
                    'stell_text' => 'STELL_TEXT',
                    'organization_id' => 'ORGANIZATION_ID',
                    'organization_name' => 'ORGANIZATION_NAME',
                    'structure_level1_name' => 'STRUCTURE_LEVEL1_NAME',
                    'structure_level2_name' => 'STRUCTURE_LEVEL2_NAME',
                    'structure_level3_name' => 'STRUCTURE_LEVEL3_NAME',
                    'structure_level4_name' => 'STRUCTURE_LEVEL4_NAME',
                ],
            ],
'DG0401' => [
                'model' => \App\Models\Resources\AcademicProgram::class,
                'fields' => [
                    'oaa_program_id' => 'OAAPROGRAMID',
                    'ops_no' => 'OPS_NO',
                    'program_name_th' => 'PROGRAMNAME_TH',
                    'program_name_en' => 'PROGRAMNAME_EN',
                    'title_degree_th' => 'TITLEDEGREE_TH',
                    'title_degree_en' => 'TITLEDEGREE_EN',
                    'degree_name_th' => 'DEGREENAME_TH',
                    'degree_name_en' => 'DEGREENAME_EN',
                    'level_code' => 'LEVELCODE',
                    'faculty_code' => 'FACULTYCODE',
                ],
            ],
            'DG0402' => [
                'model' => \App\Models\Resources\ProgramCommittee::class,
                'fields' => [
                    'program_no' => 'PROGRAMNO',
                    'active_year' => 'ACTIVEYEAR',
                    'committee_tag' => 'COMMITTEETAG',
                    'effective_date' => 'EFFECTIVEDATE',
                    'personal_id' => 'PERSONALID',
                ],
                'pks' => 'program_no,active_year,personal_id',
            ],
            'DG0403' => [
                'model' => \App\Models\Resources\Course::class,
                'fields' => [
                    'course_id' => 'COURSEID',
                    'program_id' => 'PROGRAMID',
                    'type_code' => 'TYPECODE',
                    'program_group_id' => 'PROGRAMGROUPID',
                    'code' => 'COURSENO',
                    'course_no' => 'COURSENO',
                    'revision_year' => 'REVISIONYEAR',
                    'name' => 'COURSENAME_TH',
                    'name_th' => 'COURSENAME_TH',
                    'name_en' => 'COURSENAME_EN',
                    'name_abbr' => 'COURSENAME_ABBR',
                    'credits' => 'CREDITS',
                    'l_credit' => 'LCREDIT',
                    'nl_credit' => 'NLCREDIT',
                    'l_hour' => 'LHOUR',
                    'nl_hour' => 'NLHOUR',
                    's_hour' => 'SHOUR',
                    'description_th' => 'COURSEDESCRIPTION_TH',
                    'description_en' => 'COURSEDESCRIPTION_EN',
                ],
            ],
        ];

        DB::transaction(function () use ($dgMappings) {
            foreach ($dgMappings as $dgCode => $configs) {
                // 1. Create or update the DataSource
                $dataSource = DataSource::updateOrCreate(
                    ['name' => $dgCode],
                    ['url' => "storage:local:dg/{$dgCode}.csv"]
                );

                // Determine if it's a single configuration or multiple
                $configList = (isset($configs['model'])) ? [$configs] : $configs;

                foreach ($configList as $config) {
                    // 2. Update PkModel for this resource
                    // Use explicit 'pks' if defined, otherwise fallback to the first field
                    $pkField = $config['pks'] ?? array_key_first($config['fields']);
                    \App\Models\PkModel::updateOrCreate(
                        ['model' => $config['model']],
                        ['primary_key' => $pkField]
                    );

                    // 3. Update Transformer Mappings
                    $sourceId = $dataSource->id;
                    $modelClass = $config['model'];
                    $currentFields = array_keys($config['fields']);

                    // Delete any existing mappings for this model/source NOT in the seeder
                    TransformerMapping::where('data_source_id', $sourceId)
                        ->where('model', $modelClass)
                        ->whereNotIn('field', $currentFields)
                        ->delete();

                    // Update or create mappings from the seeder
                    foreach ($config['fields'] as $fillableField => $csvHeader) {
                        TransformerMapping::updateOrCreate(
                            [
                                'data_source_id' => $sourceId,
                                'model' => $modelClass,
                                'field' => $fillableField,
                            ],
                            [
                                'mapping' => $csvHeader,
                                'formatting' => json_encode([]),
                                'updated_at' => Carbon::now(),
                            ]
                        );
                    }

                    $this->command->info("Updated mappings for DataSource: {$dgCode} (Model: {$modelClass})");
                }
            }
        });

        // // 4. Finally, trigger the background sync
        // $this->command->info('Mappings and data sources have been successfully seeded. Starting app:sync-data...');

        // $exitCode = Artisan::call('app:sync-data');

        // if ($exitCode === 0) {
        //     $this->command->info('app:sync-data executed successfully!');
        //     $this->command->line(Artisan::output());
        // } else {
        //     $this->command->error('app:sync-data encountered an error. Exit Code: '.$exitCode);
        //     $this->command->line(Artisan::output());
        // }
    }
}
