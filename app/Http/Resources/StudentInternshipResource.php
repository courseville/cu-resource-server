<?php

namespace App\Http\Resources;

use App\Models\Resources\StudentInternship;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentInternshipResource extends JsonResource
{
    /** @property StudentInternship $resource */
    public function toArray(Request $request): array
    {
        return [
            'student_id' => $this->student_id,
            'intern_year' => $this->intern_year,
            'process_step' => $this->process_step,
            'status' => $this->status,
            'company' => $this->company,
            'comp_addr' => $this->comp_addr,
            'comp_admin' => $this->comp_admin,
            'comp_title' => $this->comp_title,
            'comp_tel' => $this->comp_tel,
            'flag_comp_status' => $this->flag_comp_status,
            'flag_req_change' => $this->flag_req_change,
            'date_comp_regist' => $this->date_comp_regist,
            'date_comp_book' => $this->date_comp_book,
            'date_comp_book_rec' => $this->date_comp_book_rec,
            'date_comp_accept' => $this->date_comp_accept,
            'location_name' => $this->location_name,
            'location_address' => $this->location_address,
            'location_city' => $this->location_city,
            'prac_lon' => $this->prac_lon,
            'prac_lat' => $this->prac_lat,
            'prac_loc1' => $this->prac_loc1,
            'prac_loc2' => $this->prac_loc2,
            'sup_name' => $this->sup_name,
            'sup_position' => $this->sup_position,
            'sup_phone' => $this->sup_phone,
            'job_description' => $this->job_description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'prac_datechange_status' => $this->prac_datechange_status,
            'prac_score' => $this->prac_score,
            'prac_score_p' => $this->prac_score_p,
            'report1_date' => $this->report1_date,
            'report1_score' => $this->report1_score,
            'report1_score_p' => $this->report1_score_p,
            'report2_date' => $this->report2_date,
            'report2_score' => $this->report2_score,
            'report2_score_p' => $this->report2_score_p,
            'report3_date' => $this->report3_date,
            'report3_score' => $this->report3_score,
            'report3_score_p' => $this->report3_score_p,
            'report4_date' => $this->report4_date,
            'report4_score' => $this->report4_score,
            'report4_score_p' => $this->report4_score_p,
            'report5_date' => $this->report5_date,
            'report5_score' => $this->report5_score,
            'report5_score_p' => $this->report5_score_p,
            'reportf_date' => $this->reportf_date,
            'reportf_score' => $this->reportf_score,
            'reportf_score_p' => $this->reportf_score_p,
            'reportf_score_p_date' => $this->reportf_score_p_date,
            'date_prac_create' => $this->date_prac_create,
            'date_prac_update' => $this->date_prac_update,
            'allowance' => $this->allowance,
            'assess_comp' => $this->assess_comp,
            'assess_receive_date' => $this->assess_receive_date,
            'assess_by' => $this->assess_by,
            'assess_type' => $this->assess_type,
            'assess_date' => $this->assess_date,
            'assess_score' => $this->assess_score,
            'flag_last_reportw' => $this->flag_last_reportw,
            'blacklist' => $this->blacklist,
            'grade' => $this->grade,
            'date_create' => $this->date_create,
            'grant' => $this->grant,
            'file' => $this->file,
            'address_pic' => $this->address_pic,
        ];
    }
}
