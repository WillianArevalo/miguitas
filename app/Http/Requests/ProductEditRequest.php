<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
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
            "name" => "required|string",
            "short_description" => "required|string",
            "long_description" => "nullable|string",
            "main_image" => "nullable|image",
            "price" => "required|numeric",
            "max_price" => "nullable|numeric",
            "offer_price" => "nullable|numeric",
            "offer_start_date" => "nullable|date",
            "offer_end_date" => "nullable|date",
            "offer_active" => "nullable|boolean",
            "sku" => "required|string",
            "stock" => "required|numeric",
            "barcode" => "required|string",
            "weight" => "nullable|numeric",
            "categorie_id" => "required|numeric",
            "is_active" => "nullable|boolean",
            "is_top" => "nullable|boolean",
        ];
    }
}