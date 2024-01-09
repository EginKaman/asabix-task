<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Language */
class LanguageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'locale'     => $this->locale,
            'prefix'     => $this->prefix,
        ];
    }
}
