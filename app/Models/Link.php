<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{

        // Specify which attributes are mass assignable
        protected $fillable = [
            'slug',         // Shortened link
            'destination',  // Full destination URL
            'title',        // Title of the link
            'description',  // Description of the link
            'visits_count', // Number of visits
            'visits_limit', // limit of visits count
            'user_id',      // ID of the user who created the link
            'expires_at',   // Expiration date for the link
            'last_visited_at', // Track the last time the link was visited
        ];
    
    
        // Define the relationship to the User model
        // A link belongs to a single user
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
