<?php

namespace App\Http\Middleware;

use Closure;


class favicon
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
        ?>
            <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
        <?php
        return $next($request);
    }
}
