<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255', // Име на настанот е задолжително
            'description' => 'required|string|min:20', // Опис мин. 20 карактери
            'type' => 'required|string|max:100', // Тип на настанот е задолжителен
            // Датумот е валиден датум, после или еднаков на сегашноста (не во минатото)
            'date_time' => 'required|date|after_or_equal:now',
            'organizer_id' => 'required|exists:organizers,id', // Потребно е да се избере организатор
        ];
    }
}
