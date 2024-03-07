<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Config;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows(Config::get('constants.PERMISSIONS.ROLE_CREATE'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules =  Role::VALIDATION_RULES;

        if($this->getMethod() == 'POST'){ //store
            //$rules += ['title' => 'unique:roles,title'];
        } else{ //update 
            $rules['role_name'][1] = Rule::unique('roles')->ignore($this->role->id);
        }

        return $rules;
    }
}
