<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class jsonNotNull
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
        //recuperando datos enviados
        $data = $request->all();
        if($data == null ){
            return response()->json(['rpta' => '0','msg'=>'La petición esta vacia'],204);
        }
        return $next($request);
    }
}
