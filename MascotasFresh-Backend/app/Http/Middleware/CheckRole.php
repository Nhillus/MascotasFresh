<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        $userRole = $request->user()->rol()->first();

        if($userRole) 
        {
            //Seteamos el scope en base al admin/Medico/Asistente Producto
            $request->request->add([
                'scope' => $userRole->role
            ]);
        } 

        return $next($request);
    }
}
