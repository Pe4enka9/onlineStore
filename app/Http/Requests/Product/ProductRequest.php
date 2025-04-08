<?php

namespace App\Http\Requests\Product;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'min:11'],
            'image' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png'],
            'category_id' => ['required', 'numeric', Rule::exists(Category::class, 'id')],
        ];
    }
}
