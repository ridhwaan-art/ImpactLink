<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return in_array($this->user()?->role, ['super_admin', 'organization_admin', 'coordinator'], true);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date'],
            'start_time' => ['nullable', 'string', 'max:255'],
            'end_time' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'maximum_volunteers' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:Scheduled,Completed,Cancelled'],
        ];
    }
}
