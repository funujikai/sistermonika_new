<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Session;
use Illuminate\Contracts\Auth\Guard;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */     
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        if(Session::has('SIPP_Username')){
			// return redirect('/logout');
        }else{
            //return view('auth.pilihlogin');


            $server_name=$_SERVER['SERVER_NAME'];
			if($server_name=='appserverapache02.pnm.co.id'){
				return redirect('http://sistermonika.pnm.co.id');
			}
			if($server_name=="sistermonika.pnm.co.id"){
                return redirect('http://192.168.10.188/SSO_WebService/login.php?source=http://sistermonika.pnm.co.id/login_sso&app_code=SILUMAN');
            }else if($server_name=="10.61.3.247"){
                return redirect('http://192.168.10.188/SSO_WebService/login.php?source=http://10.61.3.247/siluman_new/public/login_sso&app_code=SILUMAN');
            }else if($server_name=="27.50.31.76"){
                return redirect('http://182.23.52.249/SSO_WebService/login.php?source=http://27.50.31.76:9495/siluman/public/login_sso&app_code=SILUMAN');
            }else{
				$redirect_url='http://ssowebservice.pnm.co.id/login.php?source=http://'.$_SERVER['HTTP_HOST'].'/login_sso&app_code=SILUMAN';	 
            }
            return redirect($redirect_url);
			

        }

        return $next($request);
    }

}
