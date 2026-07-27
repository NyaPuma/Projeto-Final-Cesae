<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UploadPhotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'photo' => ['required', 'file', 'image', 'max:2048'],
        ];
    }
}
