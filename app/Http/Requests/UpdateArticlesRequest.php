<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticlesRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->user()->can('update', $this->articles);
    }

    public function rules()
    {
        return [
            'title' => 'required|string|min:2|max:64',
            'content' => 'required|string|min:2|max:1024',
            'image' => 'file|mimetypes:image/jpg,image/png',
        ];
    }
}
