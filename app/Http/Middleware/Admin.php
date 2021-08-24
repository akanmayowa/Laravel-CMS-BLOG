<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\User;

class Admin
{




    public function handle(Request $request, Closure $next)
    {

        if(!Auth::User()->admin)
        {

            toastr()->info('you dont have permission rights');
            return redirect()->back();
        }


        return $next($request);
    }
}
