<?php


namespace App\Http\Requests;

use App\Commercial;
use Pearl\RequestValidate\RequestAbstract;

class CommercialPostRequest extends RequestAbstract
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
            Commercial::TITLE       => ['required', 'max:200', 'min:3',],
            'photos.*'              => ['required', 'max:1000'],
            Commercial::PRICE       => ['required', 'regex:/^\d+(\.\d{1,2})?$/']
        ];
    }


    public function messages(): array
    {
        return [
            'price.regex' => trans('api.commercial.price_regex'),
        ];
    }

}
