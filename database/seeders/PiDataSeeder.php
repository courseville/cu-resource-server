<?php

namespace Database\Seeders;

use App\Models\DataSource;
use App\Models\TransformerMapping;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class PiDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * NOTE: This seeder requires a database connection named 'pi' to be configured
         * in your config/database.php file. This connection is used as the remote
         * source for the MySQL data sync process.
         */
        $dgMappings = [
            'PI regcode' => [
                'url' => 'pi:mx_student_regcode:student_id',
                'model' => \App\Models\Resources\Student::class,
                'fields' => [
                    'student_id' => 'student_id',
                    'regcode' => 'reg_code',
                ],
            ],
            'PI ujob_scholarship' => [
                'url' => 'pi:ujob_scholarship:job_code',
                'model' => \App\Models\Resources\Scholarship::class,
                'pks' => 'job_code',
                'fields' => [
                    'job_code' => 'job_code',
                    'fcode' => 'fcode',
                    'scholarship_name' => 'name_th',
                    'name_en' => 'name_en',
                    'description' => 'remark',
                    'file' => 'link_details',
                    'file_description' => 'upload_details',
                    'isactive' => 'isactive',
                    'date_update' => 'date_update',
                    'update_by' => 'update_by',
                    'require_doc' => 'require_doc',
                    'require_app1' => 'require_app1',
                    'require_app2' => 'require_app2',
                    'can_assign' => 'can_assign',
                ],
            ],
            'PI scholarship' => [
                'url' => 'pi:scholarship:student_id',
                'model' => \App\Models\Resources\ScholarshipApplication::class,
                'pks' => 'student_id,job_code',
                'fields' => [
                    'student_id' => 'student_id',
                    'job_code' => 'job_code',
                    'gpa' => 'grade_gpa',
                    'gpax' => 'grade_gpax',
                    'father_occupation' => 'f_work_career',
                    'father_monthly_income' => 'f_work_m_rate',
                    'mother_occupation' => 'm_work_career',
                    'mother_monthly_income' => 'm_work_m_rate',
                    'guardian_occupation' => 'o_work_career',
                    'guardian_monthly_income' => 'o_work_m_rate',
                    'total_family_debt' => 'fam_debt',
                    'debt_details' => 'fam_debt_detail',
                    'has_house' => 'fam_hashouse',
                    'house_description' => 'fam_housedetail',
                    'number_of_cars' => 'fam_ncar',
                    'car_description' => 'fam_cardetail',
                    'family_member_count' => 'fam_members_num',
                    'number_of_employed_siblings' => 'fam_hasjob_num',
                    'guardian_dependent_count' => 'fam_aids_num',
                    'phone_brand_model' => 'st_mobile_type',
                    'phone_monthly_cost' => 'st_mobile_m_rate',
                    'reason_for_scholarship' => 'reason',
                    'financial_self_support_plan' => 'self_support',
                    'bank_account_number' => 'bankbook',
                    'confirm' => 'confirm',
                    'status' => 'status',
                    'money_a' => 'money_a',
                    'money_b' => 'money_b',
                    'money_b_m' => 'money_b_m',
                    'money_c' => 'money_c',
                ],
            ],
            'PI mx_student_advisor' => [
                'url' => 'pi:mx_student_advisor:student_id',
                'model' => \App\Models\Resources\StudentAdvisor::class,
                'pks' => 'student_id,staff_id',
                'fields' => [
                    'student_id' => 'student_id',
                    'staff_id' => 'staff_id',
                ],
            ],
            'PI intern_student' => [
                'url' => 'pi:intern_student:student_id',
                'model' => \App\Models\Resources\StudentInternship::class,
                'pks' => 'student_id,intern_year',
                'fields' => [
                    'student_id' => 'student_id',
                    'intern_year' => 'internyear',
                    'process_step' => 'process',
                    'company' => 'company',
                    'comp_addr' => 'comp_addr',
                    'comp_admin' => 'comp_admin',
                    'comp_title' => 'comp_title',
                    'comp_tel' => 'comp_tel',
                    'flag_comp_status' => 'flag_comp_status',
                    'flag_req_change' => 'flag_req_change',
                    'date_comp_regist' => 'date_comp_regist',
                    'date_comp_book' => 'date_comp_book',
                    'date_comp_book_rec' => 'date_comp_book_rec',
                    'date_comp_accept' => 'date_comp_accept',
                    'location_name' => 'prac_place',
                    'location_address' => 'prac_address',
                    'prac_lon' => 'prac_lon',
                    'prac_lat' => 'prac_lat',
                    'sup_name' => 'prac_mentor',
                    'sup_position' => 'prac_mentor_title',
                    'sup_phone' => 'prac_mentor_tel',
                    'job_description' => 'prac_detail',
                    'start_date' => 'date_prac_start',
                    'end_date' => 'date_prac_end',
                    'date_prac_create' => 'date_prac_create',
                    'date_prac_update' => 'date_prac_update',
                    'prac_loc1' => 'prac_loc1',
                    'prac_loc2' => 'prac_loc2',
                    'prac_datechange_status' => 'prac_datechange_status',
                    'prac_score' => 'prac_score',
                    'prac_score_p' => 'prac_score_p',
                    'report1_date' => 'report1_date',
                    'report1_score' => 'report1_score',
                    'report1_score_p' => 'report1_score_p',
                    'report2_date' => 'report2_date',
                    'report2_score' => 'report2_score',
                    'report2_score_p' => 'report2_score_p',
                    'report3_date' => 'report3_date',
                    'report3_score' => 'report3_score',
                    'report3_score_p' => 'report3_score_p',
                    'report4_date' => 'report4_date',
                    'report4_score' => 'report4_score',
                    'report4_score_p' => 'report4_score_p',
                    'report5_date' => 'report5_date',
                    'report5_score' => 'report5_score',
                    'report5_score_p' => 'report5_score_p',
                    'reportf_date' => 'reportf_date',
                    'reportf_score' => 'reportf_score',
                    'reportf_score_p' => 'reportf_score_p',
                    'reportf_score_p_date' => 'reportf_score_p_date',
                    'allowance' => 'allowance',
                    'assess_comp' => 'assess_comp',
                    'assess_receive_date' => 'assess_receive_date',
                    'assess_by' => 'assess_by',
                    'assess_type' => 'assess_type',
                    'assess_date' => 'assess_date',
                    'assess_score' => 'assess_score',
                    'flag_last_reportw' => 'flag_last_reportw',
                    'blacklist' => 'blacklist',
                    'grade' => 'grade',
                ],
            ],
        ];

        DB::transaction(function () use ($dgMappings) {
            foreach ($dgMappings as $name => $configs) {
                // 1. Create or update the DataSource
                $dataSource = DataSource::updateOrCreate(
                    ['name' => $name],
                    ['url' => $configs['url'], 'type' => 'mysql', 'order' => 10]
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

                    $this->command->info("Updated mappings for DataSource: {$name} (Model: {$modelClass})");
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
