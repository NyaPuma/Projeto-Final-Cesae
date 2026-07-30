<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class SendResetLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Normalize the email before running validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('email')) {
            $this->merge([
                'email' => strtolower(trim((string) $this->email)),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            // Recommended: Don't use 'exists' here to prevent account enumeration
            'email' => ['required', 'string', 'lowercase', 'email'],
        ];
    }
}
