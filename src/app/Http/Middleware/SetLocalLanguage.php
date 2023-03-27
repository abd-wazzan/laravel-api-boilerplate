<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocalLanguage
{
    public function handle($request, Closure $next)
    {
        $language = $request->header('Accept-Language');

        if ($language) {
            App::setLocale($language);
        } else {
            App::setLocale('en'); // Default language if Accept-Language header is missing
        }

        return $next($request);
    }
}
