<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{

    // Display the dashboard with all links for the authenticated user
    public function index()
    {
        $links = auth()->user()->links; // Get all links for the authenticated user
        return view('dashboard', compact('links'));
    }

    // Store a new link and redirect back to the dashboard
    public function store(Request $request)
    {

        $validation = $this->create_link_validator($request);

        if ($validation['result'] === false) { // means validation is failed
            return back()
                ->withErrors($validation['validator'])
                ->withInput();
        }

        $data = $validation['validator']->validated();

        $link = new Link($data);

        $link->slug = $this->generateSlug($data['slug']);
        $link->user_id = auth()->id();

        $link->save();

        return redirect()->route('dashboard')->with('message', ['success', 'Link shortened successfully!']);
    }

    private function generateSlug($customSlug = null)
    {
        // If a custom slug is provided, use it
        if ($customSlug)
            return $customSlug;

        do {
            // Generate a random string for the slug
            $slug = Str::random(5); // Adjust the length as needed

        } while (Link::where('slug', $slug)->exists());  // Check if the slug already exists

        return $slug;
    }

    private function create_link_validator(Request $request)
    {

        $rules = [
            'destination' => ['required', 'url', 'max:2048'],
            'slug' => ['nullable', 'string', 'min:2', 'max:20', 'unique:links,slug'],
            'title' => ['nullable', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:255'],
            'clicks_limit' => ['nullable', 'numeric', 'integer', 'min:1', 'max:100000000'],
            'expires_at' => ['nullable', 'date'],
        ];
        $messages = [];
        $attributes = [
            'destination' => __('Destination URL'),
            'slug' => __('Custom link'),
            'title' => __('Title'),
            'description' => __('Description'),
            'clicks_limit' => __('Clicks limit'),
            'expires_at' => __('Expire date')
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails())
            return ['result' => false, 'validator' => $validator];

        return ['result' => true, 'validator' => $validator];
    }
}
