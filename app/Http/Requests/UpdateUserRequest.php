<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FailedValidation;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:6', 'max:255'],
            'password' => ['required', 'string', 'min:8', new MatchOldPassword],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'staff_code' => ['required', 'string', 'min:6', 'unique:users,email'],
        ];
    }
}
