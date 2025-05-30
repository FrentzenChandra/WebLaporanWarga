<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResidentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'avatar' => 'file|mimes:png,jpg,jpeg|max:2048',
            'old-avatar' => 'required|string',
        ];
    }
}
