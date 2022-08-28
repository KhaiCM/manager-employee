<?php

namespace App\Http\Requests;

use App\Rules\FileName;
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
                'required',
                'file',
                'mimes:csv,tsv,xls,xlsx',
                'max:4096',
                new FileName(100),
            ],
        ];
    }
}
