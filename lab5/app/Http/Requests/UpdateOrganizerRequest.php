<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrganizerRequest extends FormRequest
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
        // 1. Прво, добијте ја инстанцата на моделот од рутата
        $organizer = $this->route('organizer');

        // 2. Потоа, добијте го ID-то од инстанцата
        $organizerId = $organizer->id;

        return [
            'full_name' => ['required', 'string', 'max:255'],

            // Користиме ->ignore() со експлицитно ID
            'email' => [
                'required',
                'email',
                Rule::unique('organizers')->ignore($organizerId), // <--- Поправено
                'max:255'
            ],

            'phone_number' => ['required', 'string', 'max:50'],
        ];
    }
}
