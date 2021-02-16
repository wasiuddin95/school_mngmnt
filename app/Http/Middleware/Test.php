<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Test
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
        if(Auth::check()){
            if(Auth::user()->usertype=='Admin'){
                // dd('Yes I Am The Admin Man!!');
                return redirect()->route(users.view);
            }elseif(Auth::user()->usertype=='User'){
                return redirect()->route('profiles.view');
            }
        }else{
            return redirect('/login');
            // return redirect()->back();
        }
    }
}
