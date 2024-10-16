<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RedirectController extends Controller
{
    // Handle the redirection for a given slug
    public function index($slug)
    {
        // Find the link associated with the given slug
        $link = Link::where('slug', $slug)->first();

        // If no link is found, return a 404 response
        if ($link === null) {
            return response()->view('errors.404', [], 404);
        }

        // if the visits limit has been reached, return a proper response.
        if (($link->visits_limit) !== null && $link->visits_count >= $link->visits_limit) {
            return view('errors.inactive-link');
        }

        // if the link has expired, return a proper response.
        if ($link->expires_at !== null) {
            $expiration = Carbon::createFromFormat('Y-m-d H:i:s', $link->expires_at);
            if ($expiration->lessThanOrEqualTo(now())) {
                return view('errors.inactive-link');
            }
        }

        // if there is no error, update link information and redirect the user to destination url
        $link->visits_count++;
        $link->last_visited_at = now();
        $link->save();

        return redirect()->away($link->destination);
    }
}
