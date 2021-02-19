<?php

namespace App\Http\Requests\API\Account;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Permission;

class PostRoleRequest extends FormRequest
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
            'name' => 'required|unique:App\Models\Role',
            'permissions.*.action' => ['array',
                function($attribute, $value, $fail)
                {
                    if(Permission::where('action', strtolower(implode('.', $value)))->get()->isEmpty())
                        $fail('Permission is not valid.');
                }
            ]
        ];
    }
}
