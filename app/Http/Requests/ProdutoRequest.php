<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
            'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'nome' => 'required|max:30|min:2',
            'valor' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'categoria_id' => 'required',
            'quantidade' => 'required|numeric',
        ];
    }
    /**
     * Get the messages array.
     *
     */
    public function messages(): array
    {
        return [
            'icone.required' => 'O campo ícone é obrigatório.',
            'foto.image' => 'O arquivo deve ser uma imagem.',
            'foto.mimes' => 'A foto deve estar no formato JPG, PNG ou JPEG.',
            'foto.max' => 'A foto não pode ter mais de 2MB.',
            'nome.max' => 'O nome não pode ter mais de :max caracteres.',
            'nome.min' => 'O nome deve ter pelo menos :min caracteres.',
            'valor.required' => 'O valor é obrigatório.',
            'valor.numeric' => 'O valor deve ser um número.',
            'quantidade.numeric' => 'A quantidade deve ser um número.',
        ];
    }
}
