<?php

namespace App\Http\Requests;

use App\Rules\DateHasSpecificMinutes;
use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
{
    use FailedValidation;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_time' => ['required', 'date_format:Y/m/d H:i'],
            'end_time' => ['required', 'date_format:Y/m/d H:i', 'after:start_time'],
            'reason' => ['nullable', 'string'],
            'm_type_form_id' => ['required', 'numeric', 'exists:m_type_forms,id'],
        ];
    }
}
