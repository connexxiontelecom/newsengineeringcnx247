<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
/*         if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::ACTIVITY_STREAM);
        } */
        switch ($guard) {
            case 'supplier':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('supplier-account');
              }
            break;
            case 'logistic':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('logistics-account');
              }
            break;
            default:
              if (Auth::guard($guard)->check()) {
                  return redirect()->route('activity-stream');
              }
              break;
          }

        return $next($request);
    }
}
