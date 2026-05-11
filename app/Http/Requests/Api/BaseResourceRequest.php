<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BaseResourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            /**
             * The number of items to return per page.
             *
             * @example 10
             */
            'n' => 'integer|min:1|max:100|nullable',

            /**
             * The page number to retrieve.
             *
             * @example 1
             */
            'page' => 'integer|min:1|nullable',

            /**
             * The search query to filter results.
             *
             * @example John
             */
            'name' => 'string|nullable',

            /**
             * The export format (csv or xlsx).
             *
             * @example csv
             */
            'format' => 'string|in:csv,xlsx|nullable',
        ];
    }
}
