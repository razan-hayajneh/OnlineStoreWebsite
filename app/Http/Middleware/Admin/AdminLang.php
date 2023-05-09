<?php

namespace App\Http\Middleware\Admin;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class AdminLang
{
    public function handle($request, Closure $next)
    {
        if (Session::has('applocale') AND in_array(Session::get('applocale'), ['ar','en','ur'])) {
            App::setLocale(Session::get('applocale'));
            Carbon::setLocale(Session::get('applocale'));
        }
        else {
            App::setLocale('en');
            Carbon::setLocale('en');
        }
        return $next($request);
    }
}
