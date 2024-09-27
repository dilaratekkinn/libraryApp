<?php

namespace App\Http\Requests\Author;

use App\Http\ApiResponses\FailResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthorUpdateRequest extends FormRequest
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
            'name' => 'required|max:50|unique:authors,name,' . $this->id,
            'bio' => 'required|max:255|unique:authors,bio,'. $this->id
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
