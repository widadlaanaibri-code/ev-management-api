<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'title' => 'nullable|required|string|max:255',
            'location' => 'nullable|required|string|max:255',
            'description' => 'nullable|required|string',
            'price' => 'nullable|required|numeric',
            'total-seats' => 'nullable|required|integer',
            'date' => 'nullable|required|date',
            'category' => 'nullable|required',
            'autostatus' => 'nullable|in:automatic,manual',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
