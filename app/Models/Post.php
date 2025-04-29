<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * This property defines the attributes that can be mass-assigned.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The relationships that should always be loaded.
     *
     * This property specifies the relationships to eager load by default.
     *
     * @var array<int, string>
     */
    protected $with = ['category', 'author'];

    /**
     * Scope a query to filter posts based on various criteria.
     *
     * This method applies filters for search, category, and author.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $filters
     * @return void
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when(
            $filters['author'] ?? false,
            fn($query, $author) =>
            $query->whereHas(
                'author',
                fn($query) =>
                $query->where('username', $author)
            )
        );
    }

    /**
     * Get the category that owns the post.
     *
     * This method defines a many-to-one relationship between Post and Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the author of the post.
     *
     * This method defines a many-to-one relationship between Post and User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the route key name for the model.
     *
     * This method specifies the column to use for route model binding.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the configuration array for sluggable behavior.
     *
     * This method defines the source attribute for generating slugs.
     *
     * @return array<string, array<string, string>>
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
