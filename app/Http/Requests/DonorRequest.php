<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Donor;
use Config;

class DonorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('product_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  Donor::VALIDATION_RULES;

        if($this->getMethod() == 'POST'){ //store
            $rules += ['project_id' => 'required|numeric'];
        } else{ //update
            //
        }

        return $rules;
    }
}
