<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class BlockExecutionStatus
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
        if (auth()->check()) {
            $user = auth()->user();
            if (!$user->block_execution_status  && $user->ev  && $user->sv  && $user->tv) {
                return $next($request);
            } else {
                //return to_route('user.authorization');

                //auth()->logout();
                return abort(403, 'Your account is blocked by Admin for execution of job. For further details please contact Admin');
            }
        }
        return $next($request);
    }
}