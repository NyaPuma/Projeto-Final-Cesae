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
        $allowedMimes = config('services.upload.allowed_photo_mimes');
        $allowedMimes = is_array($allowedMimes) && $allowedMimes !== []
            ? $allowedMimes
            : ['jpeg', 'jpg', 'png', 'gif', 'webp'];

        $maxPhotoSizeKb = (int) config('services.upload.max_photo_size_kb', 2048);
        return [
            'photo' => [
                'required',
                'file',
                'image',
                'mimes:'.implode(',', $allowedMimes),
                'max:'.$maxPhotoSizeKb,
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
