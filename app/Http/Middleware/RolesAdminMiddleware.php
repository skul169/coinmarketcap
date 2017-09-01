<?php

namespace App\Http\Middleware;
use Closure;
use Auth;

class RolesAdminMiddleware {

    /* Get Key trong bang config */

    public function getConfigByKey($key) {
        $config = \App\Config::where('key', '=', $key)->first();
        if ($config == null) {
            return null;
        }
        return $config->value;
    }
    public function handle($request, Closure $next) {
        // Perform Action
        if (!Auth::user()->hasRole('admin')) {
            return response()->view('errors.403');
        }

        return $next($request);
    }

}
