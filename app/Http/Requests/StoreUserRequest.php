<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Validation\Rule;
use Config;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  User::VALIDATION_RULES;

        if($this->getMethod() == 'POST'){ //store
             $rules += ['password' => 'required|confirmed|min:3|max:200'];
        } else{ //update
            //$rules['email'] = Rule::unique('users')->ignore($this->user);
            $rules += ['email' => 'required'];
        }

        return $rules;
    }
}
