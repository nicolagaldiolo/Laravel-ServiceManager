<?php

namespace App\CustomLibs;

use Closure;
use Illuminate\Http\Request;
use Spatie\Honeypot\SpamResponder\SpamResponder;

class SpamResponderResponse implements SpamResponder
{
    public function respond(Request $request, Closure $next)
    {
        abort(403);
    }
}