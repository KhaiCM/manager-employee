<?php

namespace App\Http\Requests;

use App\Rules\CheckFileWhenImportRule;
use App\Rules\ValidateDataWhenImportRule;
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
                new CheckFileWhenImportRule(
                    ['csv','tsv','xls','xlsx'],
                    config('constants.validate.file_name.max')
                ),
                new ValidateDataWhenImportRule(),
            ],
        ];
    }
}
