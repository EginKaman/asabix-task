<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Post */
class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'title'               => $this->translation->title,
            'description'         => $this->translation->description,
            'content'             => $this->translation->content,
            'created_at'          => $this->created_at,
            'updated_at'          => $this->updated_at,
            'tags'                => TagResource::collection($this->whenLoaded('tags')),
            'translations'        => PostTranslationResource::collection($this->whenLoaded('translations')),
        ];
    }
}
