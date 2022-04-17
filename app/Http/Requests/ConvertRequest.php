<?php

namespace App\Http\Requests;

use App\CurrencyEnum;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ConvertRequest extends FormRequest
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
        $currencies = implode(',', array_map(fn ($case) => $case->value, CurrencyEnum::cases()));

        return [
            'from_currency' => "required|in:{$currencies}",
            'amount' => 'required|numeric|min:0',
            'to_currency' => "required|in:{$currencies}",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException(
            $validator,
            new Response(['errors' => $validator->errors()], 422)
        );
    }
}
