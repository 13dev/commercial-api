<?php


namespace App\Http\Requests;

use App\Commercial;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CommercialRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            Commercial::DESCRIPTION => ['required', 'max:1000', 'min:3',],
            Commercial::TITLE => ['required', 'max:200', 'min:3',],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {

    }

    protected function failedValidation(Validator $validator): void
    {
        die("111");
        //throw (new ValidationException(response()->json($validator->errors(), 422)));
        throw new HttpResponseException(response()->json("ERROR!", 422));
    }
}
