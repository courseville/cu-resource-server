<?php

namespace App\Http\Requests\Api\Structure;

use App\Http\Requests\Api\BaseResourceRequest;

class IndexStructureRequest extends BaseResourceRequest
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
             * Filter by structure ID.
             * @example STR001
             */
            'structure_id' => 'string|nullable',
        ]);
    }
}
