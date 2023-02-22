<?php

namespace App\Http\Requests;

use App\Constants\Gender;
use App\Utils\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    use Response;
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
        return request()->isMethod('PUT') ? $this->fieldInfo() : $this->fieldFile();
    }

    public function fieldInfo()
    {
        return [
            'first_name' => 'required',
            'age' => 'numeric|min:1|max:100|nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'gender' => ['nullable', Rule::in([Gender::FEMALE, Gender::MALE, Gender::OTHER])]
        ];
    }

    public function fieldFile()
    {
        return [
            'file' => 'nullable|mimes:jpeg,png,jpg,gif|max:8129|file'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(
            $this->responseErrorWithData($errors->toArray(), 422)
        );
    }
}
