<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

        [$validation_result, $validator] = $this->create_link_validation($request);

        if ($validation_result === 'fail') { // means validation is failed
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
        $link = new Link($data);

        $link->slug = $this->generateSlug($request->slug);
        $link->user_id = auth()->id();

        $link->save();

        return redirect()->route('dashboard')->with('message', ['success', 'Link shortened successfully!']);
    }

    // Show edit form for a specific link
    public function edit(Link $link)
    {
        if ($link->expires_at != null) {
            $link->expires_at = Carbon::createFromFormat('Y-m-d H:i:s', $link->expires_at)->format('Y-m-d');;
        }

        return view('edit', compact('link'));
    }

    // Method to handle updating a link 
    public function update(Request $request, Link $link)
    {
        [$validation_result, $validator] = $this->create_link_validation($request);

        if ($validation_result === 'fail') { // means validation is failed
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $link->update($validator->validated());

        return redirect()->route('dashboard')->with('message', ['success', 'Link updated successfully!']);
    }

    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()->route('dashboard')->with('message', ['success', 'Link deleted!']);
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

    private function create_link_validation(Request $request)
    {

        $rules = [
            'destination' => ['required', 'url', 'max:2048'],
            'slug' => ['nullable', 'string', 'min:2', 'max:20', 'unique:links,id'],
            'title' => ['nullable', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:255'],
            'visits_limit' => ['nullable', 'numeric', 'integer', 'min:1', 'max:100000000'],
            'expires_at' => ['nullable', 'date'],
        ];
        $messages = [];
        $attributes = [
            'destination' => __('Destination URL'),
            'slug' => __('Custom link'),
            'title' => __('Title'),
            'description' => __('Description'),
            'visits_limit' => __('Clicks limit'),
            'expires_at' => __('Expire date')
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails())
            return ['fail', $validator];

        return ['pass', $validator];
    }
}
