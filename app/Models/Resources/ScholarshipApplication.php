<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ScholarshipApplication extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'scholarship_application';

    protected $fillable = [
        'student_id',
        'gpa',
        'gpax',
        'phone_brand_model',
        'phone_monthly_cost',
        'reason_for_scholarship',
        'financial_self_support_plan',
        'bank_account_number',
        'account_book_pdf',
        'application_document_pdf',
        'total_family_debt',
        'debt_details',
        'house_description',
        'house_and_surroundings_image',
        'house_interior_image',
        'number_of_cars',
        'car_description',
        'sibling_order',
        'family_member_count',
        'number_of_employed_siblings',
        'guardian_dependent_count',
        'mother_occupation',
        'mother_monthly_income',
        'father_occupation',
        'father_monthly_income',
        'guardian_occupation',
        'guardian_monthly_income',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
