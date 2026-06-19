<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            $user=$this->route('user');

        return [
            'username' => 'required|string|max:255',
            'email'    => 'required|string|email|max:40|unique:users,email,' . $user->id,
            'age'      => 'nullable|integer|min:1',
            'gender'   => 'nullable|in:male,female',
            'pic'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
