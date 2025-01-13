<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Symfony\Component\HttpFoundation\Response;

class AdminSession extends StartSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $this->manager->setDefaultDriver('file');

        if (! $this->sessionConfigured()) {
            return $next($request);
        }

        $session = $this->getSession($request);
        $session->setName('admin_session');

        return $this->handleStatefulRequest($request, $session, $next);
    }
}
