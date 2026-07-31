<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'provider_id' => ['nullable', 'exists:provider_profiles,id'],
            'status' => ['required', 'in:pending,confirmed,assigned,in_progress,completed,cancelled,rejected'],
            'payment_status' => ['required', 'in:unpaid,partially_paid,paid,refunded'],
            'admin_note' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
