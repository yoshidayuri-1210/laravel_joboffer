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
            'title' => ['required'],
            'type' => ['required'],
            'area_id' => ['required'],
            'category_id' => ['required'],
            'payment_min' => ['integer', 'min:0'],
            'payment_max' => ['integer', 'min:0'],
            'holiday' => ['integer', 'min:0'],
            'image' => [
                'file', 'image', 'mimes:jpeg,jpg,png', 'dimensions:min_width=50, max_wodth=1000, max_height=1000'
                ],
        ];
    }
}
