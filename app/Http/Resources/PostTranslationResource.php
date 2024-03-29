<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\PostTranslation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin PostTranslation */
class PostTranslationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'language'    => new LanguageResource($this->whenLoaded('language')),
            'language_id' => $this->language_id,
            'title'       => $this->title,
            'description' => $this->description,
            'content'     => $this->content,
        ];
    }
}
