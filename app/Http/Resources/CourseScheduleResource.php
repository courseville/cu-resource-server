<?php

namespace App\Http\Resources;

use App\Models\Resources\CourseSchedule;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseScheduleResource extends JsonResource
{
    /** @property CourseSchedule $resource */
    public function toArray(Request $request): array
    {
        return [
            'year' => $this->year,
            'semester' => $this->semester,
            'course_code' => $this->course_code,
            'course_name' => $this->course_name,
            'section' => $this->section,
            'row_seq' => $this->row_seq,
            'teach_type' => $this->teach_type,
            'day1' => $this->day1,
            'day2' => $this->day2,
            'day3' => $this->day3,
            'day4' => $this->day4,
            'day5' => $this->day5,
            'day6' => $this->day6,
            'day7' => $this->day7,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'building' => $this->building,
            'room' => $this->room,
            'study_program_system' => $this->study_program_system,
            'gen_ed_status' => $this->gen_ed_status,
            'general_subject' => $this->general_subject,
            'lecture_credit' => $this->lecture_credit,
            'non_lecture_credit' => $this->non_lecture_credit,
            'total_credit' => $this->total_credit,
            'real_reg' => $this->real_reg,
            'total_reg' => $this->total_reg,
            'remark1' => $this->remark1,
            'remark2' => $this->remark2,
            'remark3' => $this->remark3,
            'faccode' => $this->faccode,
        ];
    }
}
