<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTypeNumberRangeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $type = $request->type;
        $number = (int) $request->number;

        if ($type == '1' && ($number < 1 || $number > 604)) {
            abort(404);
        }

        if ($type == '2' && ($number < 1 || $number > 114)) {
            abort(404);
        }

        return $next($request);
    }
}
