<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'resident_id' => 'required|exists:residents,id',
            'category_id' => 'required|exists:report_categories,id',
            'title' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'longitude' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'image' => 'file|mimes:png,jpg,jpeg|max:2048',
            'old-image' => 'required|string',
            'description' => '',
        ];
    }
}
