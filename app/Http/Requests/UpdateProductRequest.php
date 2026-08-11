<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'base_price' => ['sometimes', 'required', 'numeric', 'min:0', 'max:999.99'],
            'badge_tag' => ['nullable', 'in:best_seller,seasonal,new'],
            'stock_quantity' => ['sometimes', 'required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
