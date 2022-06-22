<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriesRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('update', $this->categories);
    }
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:40'
        ];
    }
}
