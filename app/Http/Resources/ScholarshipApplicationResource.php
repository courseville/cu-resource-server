<?php

namespace App\Http\Resources;

use App\Models\Resources\ScholarshipApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScholarshipApplicationResource extends JsonResource
{
    /** @property ScholarshipApplication $resource */
    public function toArray(Request $request): array
    {
        return [
            'job_code' => $this->job_code,
            'student_id' => $this->student_id,
            'gpa' => $this->gpa,
            'gpax' => $this->gpax,
            'phone_brand_model' => $this->phone_brand_model,
            'phone_monthly_cost' => $this->phone_monthly_cost,
            'reason_for_scholarship' => $this->reason_for_scholarship,
            'financial_self_support_plan' => $this->financial_self_support_plan,
            'bank_account_number' => $this->bank_account_number,
            'confirm' => $this->confirm,
            'status' => $this->status,
            'money_a' => $this->money_a,
            'money_b' => $this->money_b,
            'money_b_m' => $this->money_b_m,
            'money_c' => $this->money_c,
            'account_book_pdf' => $this->account_book_pdf,
            'application_document_pdf' => $this->application_document_pdf,
            'total_family_debt' => $this->total_family_debt,
            'debt_details' => $this->debt_details,
            'house_description' => $this->house_description,
            'has_house' => $this->has_house,
            'house_and_surroundings_image' => $this->house_and_surroundings_image,
            'house_interior_image' => $this->house_interior_image,
            'number_of_cars' => $this->number_of_cars,
            'car_description' => $this->car_description,
            'sibling_order' => $this->sibling_order,
            'family_member_count' => $this->family_member_count,
            'number_of_employed_siblings' => $this->number_of_employed_siblings,
            'guardian_dependent_count' => $this->guardian_dependent_count,
            'mother_occupation' => $this->mother_occupation,
            'mother_monthly_income' => $this->mother_monthly_income,
            'father_occupation' => $this->father_occupation,
            'father_monthly_income' => $this->father_monthly_income,
            'guardian_occupation' => $this->guardian_occupation,
            'guardian_monthly_income' => $this->guardian_monthly_income,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
        ];
    }
}
