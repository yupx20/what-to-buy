<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
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
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:20'],
            'fulfillment_type' => ['required', 'in:delivery,pickup'],
            'delivery_address' => ['required_if:fulfillment_type,delivery', 'nullable', 'string', 'max:500'],
            'pickup_time' => ['required_if:fulfillment_type,pickup', 'nullable', 'date', 'after:now'],
            'payment_method' => ['required', 'in:card,apple_pay,google_pay'],
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'delivery_address.required_if' => 'A delivery address is required for local delivery orders.',
            'pickup_time.required_if' => 'Please select a pickup time for store pickup orders.',
            'pickup_time.after' => 'The pickup time must be in the future.',
        ];
    }
}
