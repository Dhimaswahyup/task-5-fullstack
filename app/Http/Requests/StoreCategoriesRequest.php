<?php

namespace App\Http\Requests;

use App\Models\Categories;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriesRequest extends FormRequest
{
  
    public function authorize()
    {
        return auth()->user()->can('create', Categories::class);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:40'
        ];
    }
}
