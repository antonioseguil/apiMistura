<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class HeaderJson
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
        if(!$request->isJson()){
            return response()->json(['rpta' => '0','msg'=>'La petición tiene que ser de tipo JSON'],403);
        }
        return $next($request);
    }
}
