<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|min:2",
            "price" => "required|numeric|gte:0.0",
            "stock" => "required|integer|gte:0",

            "authors" => "array",
            "authors.*" => "required|uuid|exists:authors,id",

            "genres" => "array",
            "genres.*" => "required|uuid|exists:genres,id",
        ];
    }
}
