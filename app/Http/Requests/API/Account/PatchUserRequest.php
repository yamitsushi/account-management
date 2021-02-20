<?php

namespace App\Http\Requests\API\Account;

use Illuminate\Foundation\Http\FormRequest;

class PatchUserRequest extends FormRequest
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
            'username' => 'required',
            'deactivate' => 'required|boolean',
            'password' => 'confirmed|nullable',
            'roles.*' => 'exists:App\Models\Role,name',
        ];
    }
}
