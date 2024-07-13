<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageUpdateRequest extends FormRequest
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
            'name' => 'required|string|unique:packages,name,' . $this->route('package')->id,
            'price' => 'required',
            'discount' => 'nullable|numeric',
            'stock' => 'required|numeric',
            'decoration' => 'nullable|array'
        ];
    }
}
