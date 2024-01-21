<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailTemplateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'title' => 'required|string',
            'subject' => 'required|string',
            'body' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'É necessário ter um nome identificado da template.',
            'title.required' => 'O título é obrigatório.',
            'subject.required' => 'O assunto é obrigatório.',
            'body.required' => 'O html da template é obrigatório ter algum texto.',
        ];
    }
}
