<?php

namespace App\Http\Requests;

use App\Enums\StatusForm;
use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use BenSampo\Enum\Rules\EnumValue;

class ChangeStatusFormRequest extends FormRequest
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
            'status' => [
                'required',
                new EnumValue(StatusForm::class, false),
            ],
        ];
    }
}
