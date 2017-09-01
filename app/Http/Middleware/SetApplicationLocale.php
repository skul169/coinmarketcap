<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
//use Torann\GeoIP\GeoIPFacade as GeoIP;
// use Torann\GeoIP;
// use Illuminate\Routing\Redirector;
// use Illuminate\Foundation\Application;

class SetApplicationLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd(GeoIP::getLocation());
        $locale = config('app.locale');
        if(Session::has('locale')){
            $locale = Session::get('locale');
        }else if(!Session::has('locale')){
          // $loca = strtolower(GeoIP::getLocation()['isoCode']);
           
          $loca = 'vn';
            $locale = $loca;
        }
//        dd($locale);
        App::setLocale($locale);

        return $next($request);
    }
}
