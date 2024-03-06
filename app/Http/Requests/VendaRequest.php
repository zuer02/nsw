<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(auth()->guard('admin')->check()){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'produto_id' => 'required',
            'quantidade_produto' => 'required|min:0',
            'valor_total' => 'nullable|numeric|min:0',
            'quantidade_total' => 'nullable|numeric',
        ];
    }
    /**
     * Get the messages array.
     *
     */
    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido.',
            'numeric' => 'O campo :attribute deve ser do tipo número.',
            'quantidade_produto.min' => 'A quantidade do produto deve ser pelo menos :min.',
            'valor_total.min' => 'O valor total da compra deve ser no mínimo :min.',
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        dd($validator->errors());
    }
}
