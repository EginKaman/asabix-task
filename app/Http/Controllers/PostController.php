<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index(PostRepository $repository): AnonymousResourceCollection
    {
        return PostResource::collection($repository->getAllWithPagination());
    }

    public function store(PostRequest $request, PostRepository $repository): PostResource
    {
        return new PostResource($repository->create($request->toData()));
    }

    public function show(Post $post): PostResource
    {
        return new PostResource($post->load(['translation', 'tags']));
    }

    public function update(PostRequest $request, Post $post, PostRepository $repository): PostResource
    {
        return new PostResource($repository->update($post, $request->toData()));
    }

    public function destroy(Post $post): Response
    {
        $post->delete();

        return response()->noContent();
    }
}
