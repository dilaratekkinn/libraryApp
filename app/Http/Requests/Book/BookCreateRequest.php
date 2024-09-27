<?php

namespace App\Http\Requests\Book;

use App\Http\ApiResponses\FailResponse;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\LibraryResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookCreateRequest extends FormRequest
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
            'name' => 'required|unique:books,name|max:50',
            'subtitle'=>'required|unique:books,subtitle|max:100',
            'author_id'=>'required|numeric|exists:authors,id',
            'summary'=>'required|unique:books,summary|max:255',
            'published_year'=>'required|date',
            'category_ids'=>"required|array|min:1",
            "category_ids.*"  => "required|exists:categories,id",
            'library_ids'=>"required|array|min:1",
            "library_ids.*"  => "required|exists:libraries,id",

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
