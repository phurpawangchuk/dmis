<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use Illuminate\Validation\Rule;
use Config;

class StorePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows(Config::get('constants.PERMISSIONS.PERMISSION_CREATE'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  Permission::VALIDATION_RULES;
        if($this->getMethod() == 'POST'){ //store
        } else{ //update 
            $rules['name'][2] = Rule::unique('permissions')->ignore($this->permission->id);
        }
        return $rules;
    }
}

