<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * This property defines the attributes that can be mass-assigned.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * Get the posts for the category.
     *
     * This method defines a one-to-many relationship between Category and Post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
