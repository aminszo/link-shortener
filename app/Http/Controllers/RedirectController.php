<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RedirectController extends Controller
{
    public function index($slug)
    {
        $link = Link::where('slug', $slug)->first();

        if ($link === null) {
            return '404';
        }

        if (($link->visits_limit) !== null && $link->visits_count >= $link->visits_limit) {
            return "limit reached";
        }
        if ($link->expires_at !== null) {
            $expiration = Carbon::createFromFormat('Y-m-d H:i:s', $link->expires_at);
            if ($expiration->lessThanOrEqualTo(now())) {
                return "expired";
            }
        }

        $link->visits_count++;
        $link->last_visited_at = now();
        $link->save();

        return redirect()->away($link->destination);
    }
}
