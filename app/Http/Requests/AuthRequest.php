<?php

namespace App\Http\Requests;

use App\Utils\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class AuthRequest extends FormRequest
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
        return Request::url()  == route('login') ? $this->login() : $this->register();
    }

    public function login()
    {
        return [
            'username' => 'required|min:10',
            'password' => 'required'
        ];
    }

    public function register()
    {
        return [
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|required_with:password_confirm|same:password_confirm',
            'password_confirm' => 'required|min:6',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
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
