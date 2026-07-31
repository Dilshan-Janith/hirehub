<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProviderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $profile = $this->route('provider');
        $userId = $profile?->user_id;

        return [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150', Rule::unique('users')->ignore($userId)],
            'phone' => ['required', 'string', 'max:30'],
            'provider_type' => ['required', 'in:worker,equipment_owner'],
            'nic_or_registration_no' => ['nullable', 'string', 'max:100'],
            'district' => ['required', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'verification_status' => ['required', 'in:pending,verified,rejected'],
            'availability_status' => ['required', 'in:available,busy,unavailable'],
        ];
    }
}
