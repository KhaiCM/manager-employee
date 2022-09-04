<?php

namespace App\Http\Requests;

use App\Rules\CheckDataImportDiffEmptyRule;
use App\Rules\CheckFileNameWhenImportRule;
use App\Rules\CheckFileTypeWhenImportRule;
use App\Rules\CheckHeaderOfFileWhenImportRule;
use App\Rules\CheckNoColumnBetweenFileAndFormsTableRule;
use App\Rules\ValidateEveryCellFileImportRule;
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
                new CheckFileTypeWhenImportRule(['csv','tsv','xls','xlsx']),
                new CheckFileNameWhenImportRule(100),
                new CheckHeaderOfFileWhenImportRule(),
                new CheckDataImportDiffEmptyRule(),
                new CheckNoColumnBetweenFileAndFormsTableRule(),
                new ValidateEveryCellFileImportRule(),
            ],
        ];
    }
}
