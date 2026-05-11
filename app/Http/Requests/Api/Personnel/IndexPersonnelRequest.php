<?php

namespace App\Http\Requests\Api\Personnel;

use App\Http\Requests\Api\BaseResourceRequest;

class IndexPersonnelRequest extends BaseResourceRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            /**
             * Filter personnel by structure ID.
             *
             * @example STR001
             */
            'structure_id' => 'string|nullable',
        ]);
    }
}
