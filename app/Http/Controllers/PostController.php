<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::with('translation')->paginate());
    }

    public function store(PostRequest $request): PostResource
    {
        return new PostResource(Post::create($request->validated()));
    }

    public function show(Post $post): PostResource
    {
        return new PostResource($post->load('translation'));
    }

    public function update(PostRequest $request, Post $post): PostResource
    {
        $post->update($request->validated());

        return new PostResource($post->loadMissing('translation'));
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json();
    }
}
