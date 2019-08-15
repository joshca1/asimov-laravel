<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\isWeekend;

class StoreNewBookingRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'bail|required|email',
            'date' => ['required', 'date', new isWeekend],
            'hour' => 'bail|required|numeric|between:9,17'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'An Email is required to book a dance with the death',
            'email.email' => 'The email you provided is invalid',
            'date.required'  => 'Nice try Asimov tester but valid db date format is necesary, use the following YY/MM/DD,',
            'date.date'  => 'Nice try Asimov tester but valid db date format is necesary, use the following YY/MM/DD,',
            'hour.required'  => 'An specific hour is required, between 9 and 17',
            'hour.numeric'  => 'Hour field must be a number between 9 and 17 representing 9:00 am and 6:00pm',
            'hour.between'  =>  'You can book an hour with the death, only between 9:00 am and 6:00 PM'
        ];
    }
}
