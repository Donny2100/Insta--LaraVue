<?php

namespace App\Http\Middleware;

use Closure;

class AppConfig
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        /**
         * Config Social Auth
         */
        $config_facebook = [
            'client_id' => setting('facebook_app_id'),
            'client_secret' => setting('facebook_app_secret'),
            'redirect' => route('login_social_callback', 'facebook'),
        ];
        $config_google = [
            'client_id' => setting('google_app_id'),
            'client_secret' => setting('google_app_secret'),
            'redirect' => route('login_social_callback', 'google'),
        ];
        config(['services.facebook' => $config_facebook]);
        config(['services.google' => $config_google]);

        return $next($request);
    }
}
