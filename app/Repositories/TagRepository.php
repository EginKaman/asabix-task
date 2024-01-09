<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Data\TagData;
use App\Models\Tag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TagRepository
{
    public function getAllWithPagination(): LengthAwarePaginator
    {
        return Tag::latest()->paginate();
    }

    public function create(TagData $data): Tag
    {
        $tag = new Tag($data->toArray());

        $tag->save();

        return $tag;
    }

    public function update(Tag $tag, TagData $data): Tag
    {
        $tag->fill($data->toArray());

        $tag->save();

        return $tag;
    }
}
