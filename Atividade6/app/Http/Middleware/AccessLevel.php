<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class AccessLevel
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
        $nivel = 0;

        $rota = $request->route()->getName();

        if($rota != "restrito") {

            if ($nivel == 0) {
                if($rota != "home"){
                    return redirect('restrito');
                }
            }
            elseif ($nivel == 1) {
                if ($rota == "professor.index" || $rota == "aluno.index") {
                    return redirect('restrito');
                }
            }
        }
        return $next($request);
    }
}
