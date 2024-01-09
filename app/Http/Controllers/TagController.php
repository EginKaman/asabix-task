<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TagController extends Controller
{
    public function index(TagRepository $repository): AnonymousResourceCollection
    {
        return TagResource::collection($repository->getAllWithPagination());
    }

    public function store(TagRequest $request, TagRepository $repository): TagResource
    {
        return new TagResource($repository->create($request->toData()));
    }

    public function show(Tag $tag): TagResource
    {
        return new TagResource($tag);
    }

    public function update(TagRequest $request, Tag $tag, TagRepository $repository): TagResource
    {
        $repository->update($tag, $request->toData());

        return new TagResource($tag);
    }

    public function destroy(Tag $tag): Response
    {
        $tag->delete();

        return response()->noContent();
    }
}
