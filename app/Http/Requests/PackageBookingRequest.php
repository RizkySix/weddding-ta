<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageBookingRequest extends FormRequest
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
        $tomorrow = now()->addDay()->format('Y-m-d');

        return [
            'package_id' => 'required',
             'package_name' => 'required|string',
             'start_date' => 'required|date|after_or_equal:' . $tomorrow,
             'end_date' => 'required|date|after_or_equal:start_date',
             'package' => 'required|string',
             'amount' => 'required',
             'phone' => 'required|min:11|max:13',
             'discount' => 'required|numeric',
             'address' => 'required|string'
        ];
    }
}
