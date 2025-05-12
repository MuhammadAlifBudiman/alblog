<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * This method retrieves all categories from the database and passes them
     * to the 'dashboard.categories.index' view for display.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * This method returns a view to create a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * This method validates and saves a new category to the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories',
        ]);

        Category::create($validatedData);

        return redirect('/dashboard/categories')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * This method retrieves and displays a specific category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // Implementation pending
    }

    /**
     * Show the form for editing the specified resource.
     *
     * This method returns a view to edit an existing category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * This method validates and updates an existing category in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories,slug,' . $category->id,
        ]);

        $category->update($validatedData);

        return redirect('/dashboard/categories')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * This method deletes a specific category from the database.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/dashboard/categories')->with('success', 'Category deleted successfully!');
    }

    /**
     * Generate a slug dynamically for a category name.
     *
     * This method uses the SlugService to create a slug based on the category name.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
