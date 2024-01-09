<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;

class Localization
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('Accept-Language')
            && Language::where('prefix', '=', $request->header('Accept-Language'))->exists()) {
            app()->setLocale($request->header('Accept-Language'));
        }

        return $next($request);
    }
}
