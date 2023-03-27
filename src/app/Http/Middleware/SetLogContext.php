<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SetLogContext
{
    public function handle($request, Closure $next)
    {
        $requestId = (string) Str::uuid();

        Log::withContext([
            'request-id' => $requestId,
            'user_id' => auth()?->user()?->getAuthIdentifier(),
            'url' => $request->url(),
            'body' => $request->input(),
            'query' => $request->query(),
            'ip' => $request->ip(),
        ]);

        $request->headers->set('Request-Id', $requestId);
        return $next($request);
    }
}
