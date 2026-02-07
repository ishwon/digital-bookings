<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReservationRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'agency_id' => ['nullable', 'exists:agencies,id'],
            'salesperson_id' => ['nullable', 'exists:salespeople,id'],
            'product' => ['required', 'string', 'max:255'],
            'placement_id' => ['required', 'exists:placements,id'],
            'channel' => ['required', Rule::in(['Run of site', 'Home & multimedia'])],
            'scope' => ['required', Rule::in(['Mauritius only', 'Worldwide'])],
            'dates_booked' => ['required', 'json'],
            'amount' => ['required', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'commission' => ['nullable', 'numeric', 'min:0'],
            'cost_of_artwork' => ['nullable', 'numeric', 'min:0'],
            'vat' => ['nullable', 'numeric', 'min:0'],
            'vat_exempt' => ['boolean'],
            'purchase_order_no' => ['nullable', 'string', 'max:255'],
            'invoice_no' => ['nullable', 'string', 'max:255'],
            'remark' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'client_id.required' => 'Please select a client.',
            'client_id.exists' => 'The selected client is invalid.',
            'product.required' => 'The product name is required.',
            'placement_id.required' => 'Please select a placement.',
            'placement_id.exists' => 'The selected placement is invalid.',
            'channel.required' => 'Please select a channel.',
            'channel.in' => 'The selected channel is invalid.',
            'scope.required' => 'Please select a scope.',
            'scope.in' => 'The selected scope is invalid.',
            'dates_booked.required' => 'Please select at least one date.',
            'dates_booked.json' => 'The dates format is invalid.',
            'amount.required' => 'The amount is required.',
            'amount.numeric' => 'The amount must be a valid number.',
            'amount.min' => 'The amount cannot be negative.',
        ];
    }
}
