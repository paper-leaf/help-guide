<?php

namespace PaperLeaf\HelpGuide\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PaperLeaf\HelpGuide\HelpGuidePlugin;
use Symfony\Component\HttpFoundation\Response;

class RedirectGuests
{
    public function handle(Request $request, Closure $next): Response
    {
        // If the user isn't logged into the main web session, send them to the admin login
        if (! Auth::guard('web')->check()) {
            $plugin = filament()->getPanel('admin')->getPlugin(HelpGuidePlugin::ID);
            $login = Str::start($plugin->getLoginUrl(), '/');

            return redirect($login);
        }

        return $next($request);
    }
}
