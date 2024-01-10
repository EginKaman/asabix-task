<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Data\PostData;
use App\Data\PostTranslationData;
use App\Models\Language;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'translations' => [
                'required',
                'array',
                'min:1',
                'max:' . Language::count(),
            ],
            'translations.*.language_id' => [
                'required',
                'uuid',
                Rule::exists(Language::getModel()->getTable(), 'id'),
            ],
            'translations.*.title' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'translations.*.description' => [
                'required',
                'string',
                'min:3',
                'max:65535',
            ],
            'translations.*.content' => [
                'required',
                'string',
                'min:3',
                'max:16777215',
            ],
            'tags' => [
                'nullable',
                'array',
                'max:10',
            ],
            'tags.*' => [
                'required',
                'uuid',
                Rule::exists(Tag::getModel()->getTable(), 'id'),
            ],
        ];
    }

    public function toData(): PostData
    {
        $translations = [];

        foreach ($this->validated('translations') as $translation) {
            $translations[] = PostTranslationData::from($translation);
        }

        return PostData::from([
            ...$this->validated(),
            'translations' => $translations,
        ]);
    }
}
