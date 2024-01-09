<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Data\TagData;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
        ];
    }

    public function toData(): TagData
    {
        return TagData::from($this->validated());
    }
}
