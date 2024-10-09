<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Link;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{

    // Display the dashboard with all links of the user
    public function index()
    {
        $links = auth()->user()->links; // Get all links for the authenticated user
        return view('dashboard', compact('links')); // Return the dashboard view with the user's links
    }

    // Display a form for creating new link
    public function create() {
        return view('create');
    }

    // Store a new link and redirect back to the dashboard
    public function store(Request $request)
    {

        // Validate the incoming request data
        [$validation_result, $validator] = $this->create_link_validation($request);

        if ($validation_result === 'fail') { // If validation fails
            return back()
                ->withErrors($validator) // return errors
                ->withInput(); // also return user inputs to refill the form
        }

        $data = $validator->validated(); // Get validated data
        $link = new Link($data); // Create a new Link model instance

        // set an unique slug for the link (take from user input, or generate a random slug)
        $link->slug = $this->generateSlug($request->slug);
        $link->user_id = auth()->id(); // set the current user's id

        $link->save();

        // Redirect back with a success message
        return redirect()->route('dashboard')->with('message', ['success', 'Link shortened successfully!']);
    }

    // Show edit form for a specific link. Link ID is specified in URL.
    public function edit(Link $link)
    {

        // Format the expiration date if it exists
        if ($link->expires_at != null) {
            $link->expires_at = Carbon::createFromFormat('Y-m-d H:i:s', $link->expires_at)->format('Y-m-d');;
        }

        // Return the edit view with the link data
        return view('edit', compact('link'));
    }

    // handle updating a link. Link ID is specified in URL.
    public function update(Request $request, Link $link)
    {
        // Validate the incoming request data
        [$validation_result, $validator] = $this->create_link_validation($request, $link);

        if ($validation_result === 'fail') { // If validation fails
            return back()
                ->withErrors($validator) // return errors
                ->withInput(); // also return user inputs to refill the form
        }

        $link->update($validator->validated()); // Update the link with validated data

        // Redirect back with a success message
        return redirect()->route('dashboard')->with('message', ['success', 'Link updated successfully!']);
    }

    // Delete a specific link. Link ID is specified in URL.
    public function destroy(Link $link)
    {
        $link->delete(); // Remove the link from the database

        // Redirect back with a success message
        return redirect()->route('dashboard')->with('message', ['success', 'Link deleted!']);
    }

    // Generate a unique slug for the link
    private function generateSlug($customSlug = null)
    {
        // If a custom slug is provided, use it, otherwise generate a random one.
        if ($customSlug)
            return $customSlug;

        do {
            // Generate a random string for the slug
            $slug = Str::random(5);
        } while (Link::where('slug', $slug)->exists());  // Check if the slug already exists

        return $slug;
    }

    // Validate link creation and updating requests
    private function create_link_validation(Request $request, Link $link = null)
    {
        // Get all defined routes to check for disallowed slugs
        $disallowedSlugs = collect(Route::getRoutes())->filter(function ($route) {
            return $route->methods[0] === 'GET'; // Filter for GET routes
        })->pluck('uri')->map(function ($uri) {
            return explode('/', trim($uri, '/'))[0]; // Get the first part of the URI
        })->unique()->toArray(); // Get unique slugs as an array

        $disallowedSlugs = array_merge($disallowedSlugs, ['logout']); // Add static items for disallowed slugs here

        // Define validation rules
        $rules = [
            'destination' => [
                'required',
                'max:2048',
                'regex:/[(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&\/=]*)/i' // source : https://regexr.com/39nr7
            ],
            'slug' => [
                'nullable',
                'string',
                'min:2',
                'max:20',
                'regex:/^[a-zA-z0-9]+(?:(?:-|_)+[a-zA-Z0-9]+)*$/',
                Rule::unique('links', 'slug')->ignore($link->id ?? null), // Ensure slug is unique and ignoring current link if updating
                Rule::notIn($disallowedSlugs), // Ensure selected slug is not in application routes
            ],
            'title' => ['nullable', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:255'],
            'visits_limit' => ['nullable', 'numeric', 'integer', 'min:1', 'max:100000000'],
            'expires_at' => ['nullable', 'date'],
        ];
        // Custom validation messages
        $messages = [
            // 'destination.regex' => '',
            'slug.not_in' => __('validation.unique'), // same message as 'uniqe' rule
            // 'slug.regex' => '',

        ];
        // Custom attribute names for validation errors
        $attributes = [
            'destination' => __('Destination URL'),
            'slug' => __('Custom link'),
            'title' => __('Title'),
            'description' => __('Description'),
            'visits_limit' => __('Clicks limit'),
            'expires_at' => __('Expire date')
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes); // create the validator

        if ($validator->fails())
            return ['fail', $validator];

        return ['pass', $validator];
    }
}
