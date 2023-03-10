<?php

namespace App\Http\Requests;

use App\Utils\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class InformationRequest extends FormRequest
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
        return [
            'title' => 'required',
            // max 8 MB
            'image' => 'mimes:png,jpg|max:8129|file',
            'description' => 'required',
            'country_id' => 'exists:countries,id',
            'owner_id' => 'required|exists:users,id'
            // 'video' => 'required'
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
