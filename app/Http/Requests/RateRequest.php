<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
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
            "department" => "required|string",
            "municipality" => "nullable|string",
            "district" => "nullable|string",
            "cost" => "required|numeric",
            "description" => "nullable|string",
            "active" => "nullable|boolean"
        ];
    }
}