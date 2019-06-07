<?php

namespace App\Http\Middleware;

use Closure;

class ProcessTurbolinksHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (session()->has('header-url')) {
            return $response
                ->header('Turbolinks-Location', session()->get('header-url'));
        }

        return $response;
    }
}
