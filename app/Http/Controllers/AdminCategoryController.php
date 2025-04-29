<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
        // Implementation pending
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
        // Implementation pending
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
        // Implementation pending
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
        // Implementation pending
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
        // Implementation pending
    }
}
