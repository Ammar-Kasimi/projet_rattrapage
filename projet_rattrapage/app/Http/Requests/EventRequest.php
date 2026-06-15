<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'          => 'required|string|max:255',
            'desc'           => 'required|string',
            'date'           => 'required|date',
            'max_volunteers' => 'required|integer|min:1',
            'picture'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category_id'    => 'required|exists:categories,id',

            'location'       => 'required|string|max:255',
            'city'           => 'required|string|max:100',
            'country'        => 'required|string|max:100',
            'postal_code'    => 'required|string|max:20'
        ];
    }
}
