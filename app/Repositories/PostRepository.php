<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Data\PostData;
use App\Data\PostTranslationData;
use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostRepository
{
    public function getAllWithPagination(): LengthAwarePaginator
    {
        return Post::with(['translation', 'tags'])->latest()->paginate();
    }

    public function create(PostData $postData): Post
    {
        $post = new Post($postData->except('translations', 'tags')->toArray());

        $post->save();

        foreach ($postData->translations as $translation) {
            $post->translations()->save(new PostTranslation($translation->toArray()));
        }

        $post->tags()->sync($postData->tags);

        return $post->loadMissing(['translation', 'translations', 'translations.language', 'tags']);
    }

    public function update(Post $post, PostData $postData): Post
    {
        $post->fill($postData->except('translations', 'tags')->toArray());

        $post->save();
        /** @var PostTranslationData $translation */
        foreach ($postData->translations as $translation) {
            $update = $post->translations()->firstOrNew(['language_id' => $translation->language_id]);

            $update->fill($translation->toArray());
            $update->save();
        }

        $post->tags()->sync($postData->tags);

        return $post->load(['translation', 'translations', 'translations.language', 'tags']);
    }
}
