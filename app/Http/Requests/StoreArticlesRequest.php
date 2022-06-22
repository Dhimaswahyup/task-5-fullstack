<?php

namespace App\Http\Requests;

use App\Models\Articles;
use Illuminate\Foundation\Http\FormRequest;

class StoreArticlesRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->user()->can('create', Articles::class);
    }

    public function rules()
    {
        return [
            'category' => 'exists:categories,id',
            'title' => 'required|string|min:2|max:64',
            'content' => 'required|string|min:2|max:1024',
            'image' => 'file|mimetypes:image/jpg,image/png',
        ];
    }
}
