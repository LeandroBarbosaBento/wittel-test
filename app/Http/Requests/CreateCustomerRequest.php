<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|size:11|unique:customers,cpf',
            'birth_date' => 'required|date',
            'household_income' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'cpf.required' => 'CPF is required.',
            'cpf.size' => 'CPF must be 11 characters.',
            'cpf.unique' => 'This CPF is already registered.',
            'birth_date.required' => 'Birth date is required.',
            'household_income.required' => 'Household income is required.',
            'household_income.numeric' => 'Household income must be a number.',
            'household_income.min' => 'Household income cannot be negative.',
        ];
    }
}
