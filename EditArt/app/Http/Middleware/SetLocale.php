<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;



class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response

    {
        //Filtra e faz a lógina sobre o request

        if(session()->has('locale')){
            app()->setLocale(session('locale'));

        }else{
           App::setLocale('pt');
            session()->put('locale', 'pt');

        }

        return $next($request);
    }
}
