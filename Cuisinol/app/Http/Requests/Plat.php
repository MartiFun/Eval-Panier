<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Plat extends FormRequest
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
          'nom' => ['required', 'string', 'max:100'],
          'prix' => ['required', 'numeric', 'min:0', 'max:500'],
          'type_id' => ['required'],
          'vegetarien_id' => ['required'],
          'origine' => ['required', 'string', 'max:100'],
          'poid' => ['required', 'string', 'max:100'],
          'ingrs[]' => [''],
        ];
    }
}
