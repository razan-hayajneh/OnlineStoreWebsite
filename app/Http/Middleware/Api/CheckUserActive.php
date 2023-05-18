<?php

namespace App\Http\Middleware\Api;

use App\Traits\ResponseTrait;
use Closure;

class CheckUserActive
{
    use ResponseTrait;
    public function handle($request, Closure $next)
    {
        if(auth('api')->check()){
            $user = auth()->user();
            if ($user->user_status != 'active'){
                return response()->json([
                    'key' => 'banned',
                    'value' => 2,
                    'msg' =>'You are deactivated by admin'
                ]);
            }
        }
        return $next($request);
    }
}
