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
            'photo' => [
                'required',
                'file',
                'image',
                'mimes:'.implode(',', config('services.custom.upload.allowed_photo_mimes')),
                'max:'.config('services.custom.upload.max_photo_size_kb'),
                'dimensions:max_width='.config('services.custom.upload.max_photo_width').',max_height='.config('services.custom.upload.max_photo_height'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'photo.required' => 'É necessário enviar uma fotografia.',
            'photo.image' => 'O ficheiro deve ser uma imagem válida.',
            'photo.mimes' => 'A imagem deve ser do tipo JPEG, PNG, JPG, GIF ou WebP.',
            'photo.max' => 'A imagem não pode exceder 2MB.',
            'photo.dimensions' => 'A imagem não pode exceder 4096x4096 pixels.',
        ];
    }
}
