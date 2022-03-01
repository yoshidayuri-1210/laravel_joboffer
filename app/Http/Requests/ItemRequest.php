<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_name' => ['required', 'max:255'],
            'type' => ['required'],
            'area_id' => ['required'],
            'category_id' => ['required'],
        ];
    }
}
