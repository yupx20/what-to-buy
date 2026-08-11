<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:10'],
            'ice_level_id' => ['nullable', 'integer', 'exists:customization_options,id'],
            'sugar_level_id' => ['nullable', 'integer', 'exists:customization_options,id'],
            'topping_ids' => ['nullable', 'array', 'max:3'],
            'topping_ids.*' => ['integer', 'exists:customization_options,id'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'topping_ids.max' => 'You can select a maximum of 3 toppings.',
        ];
    }
}
