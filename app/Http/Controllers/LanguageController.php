<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\LanguageResource;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LanguageController extends Controller
{
    public function __invoke(LanguageRepository $repository): AnonymousResourceCollection
    {
        return LanguageResource::collection($repository->getAll());
    }
}
