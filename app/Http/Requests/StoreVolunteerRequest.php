<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVolunteerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return in_array($this->user()?->role, ['super_admin', 'organization_admin', 'coordinator'], true);
    }

    public function rules(): array
    {
        return [
            'organization_id' => ['nullable', 'exists:organizations,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'age_range' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'location' => ['nullable', 'string', 'max:255'],
            'volunteer_type' => ['required', 'in:Student,Community Member'],
            'institution_name' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:Active,Inactive,Suspended'],
        ];
    }
}
