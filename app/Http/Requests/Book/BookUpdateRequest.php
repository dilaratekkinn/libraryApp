<?php

namespace App\Http\Requests\Book;

use App\Http\ApiResponses\FailResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookUpdateRequest extends FormRequest
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
            'name' => 'required|max:50|unique:books,name,' . $this->id,
            'subtitle' => 'required|max:100|unique:books,subtitle,'. $this->id,
            'author_id' => 'required|numeric|exists:authors,id',
            'summary' => 'required|max:255|unique:books,summary,'. $this->id,
            'published_year' => 'required|date',
            'category_ids' => "required|array|min:1",
            "category_ids.*" => "required|exists:categories,id",
            'library_ids' => "required|array|min:1",
            "library_ids.*" => "required|exists:libraries,id",

        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            (new FailResponse())->setMessages($validator->errors()->toArray())->send()
        );
    }
}
