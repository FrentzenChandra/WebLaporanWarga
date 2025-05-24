<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportStatusRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required|in:delivered,in_process,completed,rejected',
            'description' => '',
            'image' => 'file|mimes:png,jpg,jpeg|max:2048',
            'old-image' => 'required|string',
        ];
    }
}
