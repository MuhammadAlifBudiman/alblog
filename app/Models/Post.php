<?php

namespace App\Models; // Defines the namespace for the Post model, ensuring it is organized and can be autoloaded.

use App\Models\Category; // Imports the Category model to establish relationships and use its methods.
use Illuminate\Database\Eloquent\Model; // Extends the base Eloquent Model class to inherit ORM functionality.
use Illuminate\Database\Eloquent\Factories\HasFactory; // Enables the use of factories for creating model instances in tests or seeding.
use Cviebrock\EloquentSluggable\Sluggable; // Adds slug generation functionality to the model.

class Post extends Model
{
    use HasFactory, Sluggable; // Includes traits for factory support and slug generation.

    /**
     * The attributes that are mass assignable.
     *
     * Prevents mass assignment of the 'id' field to maintain data integrity.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id']; // Prevents mass assignment of the 'id' field to maintain data integrity.

    /**
     * The relationships that should always be loaded.
     *
     * Ensures related models are always loaded to reduce query overhead later.
     *
     * @var array<int, string>
     */
    protected $with = ['category', 'author']; // Ensures related models are always loaded to reduce query overhead later.

    /**
     * Scope a query to filter posts based on various criteria.
     *
     * Adds a query scope for filtering posts based on criteria.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $filters
     * @return void
     */
    public function scopeFilter($query, array $filters) // Adds a query scope for filtering posts based on criteria.
    {
        $query->when($filters['search'] ?? false, function ($query, $search) { // Filters posts by search term if provided.
            return $query->where(function ($query) use ($search) { // Groups search conditions to match title or body.
                $query->where('title', 'like', '%' . $search . '%') // Matches posts with titles containing the search term.
                    ->orWhere('body', 'like', '%' . $search . '%'); // Matches posts with bodies containing the search term.
            });
        });

        $query->when($filters['category'] ?? false, function ($query, $category) { // Filters posts by category if provided.
            return $query->whereHas('category', function ($query) use ($category) { // Ensures the category exists and matches the slug.
                $query->where('slug', $category); // Matches the category slug to the provided value.
            });
        });

        $query->when(
            $filters['author'] ?? false, // Filters posts by author if provided.
            fn($query, $author) =>
            $query->whereHas(
                'author', // Ensures the author relationship exists.
                fn($query) =>
                $query->where('username', $author) // Matches the author's username to the provided value.
            )
        );
    }

    /**
     * Get the category that owns the post.
     *
     * Defines the relationship to the Category model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() // Defines the relationship to the Category model.
    {
        return $this->belongsTo(Category::class); // Links each post to a single category.
    }

    /**
     * Get the author of the post.
     *
     * Defines the relationship to the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author() // Defines the relationship to the User model.
    {
        return $this->belongsTo(User::class, 'user_id'); // Links each post to a single user as the author.
    }

    /**
     * Get the route key name for the model.
     *
     * Customizes the route model binding key.
     *
     * @return string
     */
    public function getRouteKeyName() // Customizes the route model binding key.
    {
        return 'slug'; // Uses the 'slug' field for route model binding instead of the default 'id'.
    }

    /**
     * Get the configuration array for sluggable behavior.
     *
     * Configures the slug generation behavior.
     *
     * @return array<string, array<string, string>>
     */
    public function sluggable(): array // Configures the slug generation behavior.
    {
        return [
            'slug' => [
                'source' => 'title' // Specifies the 'title' field as the source for generating slugs.
            ]
        ];
    }
}
