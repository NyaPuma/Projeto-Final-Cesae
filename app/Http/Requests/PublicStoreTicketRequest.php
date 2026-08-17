<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\PublicTicketProblemTypeEnum;
use App\Models\Equipment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

final class PublicStoreTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'equipment_id' => ['required', 'integer', Rule::exists(Equipment::class, 'id')],
            'problem_type' => ['required', Rule::in(PublicTicketProblemTypeEnum::values())],
            'description' => ['required', 'string', 'max:5000'],
            'reporter_name' => ['nullable', 'string', 'max:150'],
            'reporter_contact' => ['nullable', 'string', 'max:150'],
            'photo' => ['nullable', File::image()->max(4096)],
        ];
    }

    public function attributes(): array
    {
        return [
            'equipment_id' => 'equipamento',
            'problem_type' => 'tipo de problema',
            'description' => 'descrição',
            'reporter_name' => 'nome do reportante',
            'reporter_contact' => 'contacto',
            'photo' => 'fotografia',
        ];
    }
}
