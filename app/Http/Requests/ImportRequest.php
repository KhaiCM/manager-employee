<?php

namespace App\Http\Requests;

use App\Rules\CheckTypeAndNameOfFileRule;
use App\Rules\ValidateDataOfFileRule;
use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
{
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
            'uploaded_file' => [
                'bail',
                'required',
                'file',
                'min:0',
                'not_in:0',
                'max:4096',
                new CheckTypeAndNameOfFileRule(
                    ['csv','tsv','xls','xlsx'],
                    config('constants.validate.file_name.max') // 100
                ),
                new ValidateDataOfFileRule(),
            ],
        ];
    }
}
