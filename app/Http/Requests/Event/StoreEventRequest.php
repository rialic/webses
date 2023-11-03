<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'bireme_code' => ['required'],
            'start_at' => ['required'],
            'start_minutes_additions' => ['required'],
            'end_at' => ['required'],
            'end_minutes_additions' => ['required'],
            'description' => ['required'],
            'room_link' => ['required']
        ];
    }

    public function messages()
    {
     return [
        'name.required' => 'O campo Web é obrigatório.',
        'start_at.required' => 'O campo Início evento é obrigatório.',
        'start_minutes_additions.required' => 'O campo Antecipar evento em é obrigatório.',
        'end_minutes_additions.required' => 'O campo Fechar evento após é obrigatório.',
        'end_at.required' => 'O campo Fim evento é obrigatório.'
     ];
    }
}
