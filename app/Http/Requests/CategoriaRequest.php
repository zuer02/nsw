<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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
            'icone' => 'required|image|mimes:svg,png,ico|max:512',
            'nome' => 'required|max:30|min:5',
            'descricao' => 'required|max:255'
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
            'icone.image' => 'O arquivo do ícone deve ser uma imagem.',
            'icone.mimes' => 'O ícone deve ser um arquivo do tipo: svg, png, ico',
            'icone.max' => 'O tamanho máximo do ícone é de 2MB.',
            'nome.max' => 'O campo nome não pode ter mais de :max caracteres.',
            'nome.min' => 'O campo nome deve ter pelo menos :min caracteres.',
            'descricao.max' => 'O campo descrição não pode ter mais de :max caracteres.'
        ];
    }
}
