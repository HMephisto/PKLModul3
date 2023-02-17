<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => [
                "required",
                "string",
                "max:255"
            ],
            "price" => [
                "required",
                "integer",
                "min:1000",
                "numeric",
                "max:2147483647"
            ],
            "brand_id" => [
                "nullable",
                "exists:brands,id",
            ],
            "image" => [
                "nullable",
                "file",
                "image",
                "mimes:jpg,png"
            ],

        ];
    }

    public function messages()
    {
        return [
            'price.min' => 'the minimal price is Rp 1000',
            'price.max' => 'the price is too high'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ],422 ));
    }
}
