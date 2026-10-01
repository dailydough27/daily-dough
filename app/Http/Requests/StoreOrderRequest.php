<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:120',
            'phone' => ['required', 'string', 'max:40', 'regex:/^[0-9+()\s-]{8,20}$/'],
            'area' => 'required|string|max:120',
            'address' => 'required|string|max:500',
            'apartment' => 'nullable|string|max:120',
            'notes' => 'nullable|string|max:500',
            'payment_method' => 'required|in:cod',
            'coupon_code' => 'nullable|string|max:40',
            'delivery_zone_id' => 'required|exists:delivery_zones,id',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'Please enter your full name.',
            'phone.required' => 'Please enter your phone number.',
            'phone.regex' => 'Please enter a valid phone number.',
            'area.required' => 'Please enter your area / neighborhood.',
            'address.required' => 'Please enter your full address.',
            'delivery_zone_id.required' => 'Please select a delivery zone.',
            'delivery_zone_id.exists' => 'Please select a valid delivery zone.',
        ];
    }
}
